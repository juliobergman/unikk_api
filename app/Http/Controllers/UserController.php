<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\UserData;
use App\Models\Membership;
use Illuminate\Support\Str;
use App\Mail\UserInvitation;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{

    public $data_select = [
        // Users
        'users.id',
        'users.name',
        'users.email',
        'users.email_verified_at',
        'users.created_at',
        // UserData
        'user_data.site',
        'user_data.phone',
        'user_data.country',
        'user_data.city',
        'user_data.address',
        'user_data.gender',
        'user_data.profile_pic',
        // Country
        'countries.name as country_name',
        'countries.region as country_region',
        'countries.subregion as country_subregion',
        'countries.latitude as country_latitude',
        'countries.longitude as country_longitude',
    ];

    public function select(Request $request, User $user)
    {
        return $user;
    }
    
    public function index(Request $request)
    {
        // Authorized
        $user = Auth::user();

        // Memberships
        $memberships = collect((new MembershipController)->user($request));

        if(!$memberships->count()) return new JsonResponse([
            'message' => 'Unauthenticated',
            'errors' => [
                'user' => ["It seems this account doesn't have access to this site anymore.", "We're sorry for the inconvenience..."]
            ],
            'auth' => false
        ], 403);

        $current_membership = $memberships->where('selected', true)->first();
        if(!$current_membership){
            $current_membership = $memberships->first();
        }
        
        // User
        $user_select = array_merge($this->data_select, [
            'memberships.job_title',
            'memberships.role'
        ]);
        
        $uq = User::query();
        // Where
        $uq->where('users.id', $user->id);
        // Selects
        $uq->select($user_select);
        // Join
        $uq->join('user_data', 'users.id', '=', 'user_data.user_id');
        $uq->leftJoin('countries', 'user_data.country', '=', 'countries.iso2');
        $uq->join('memberships', function ($join) use ($current_membership) {
            $join->on('users.id', '=', 'memberships.user_id')
            ->where('memberships.id', '=', $current_membership->id);
        });
        $user = $uq->first();
        
        // Company
        $company = (new CompanyController)->show(Company::where('id', $current_membership->company_id)->first());
        // Token
        $bearer = $request->header('Authorization');
        if($bearer){
            $token = str_replace('Bearer ', '', $bearer);
        } else {
            $token = $user->createToken($request->device)->plainTextToken;
        }
        
        return new JsonResponse([
            'message' => 'Authenticated',
            'auth' => true,
            'token' => $token,
            'user' => $user, 
            'company' => $company, 
            'membership' => $current_membership,
            'memberships' => $memberships
        ], 200);
    }

    public function search_new(Request $request, Company $company)
    {
        $discard = User::query()
                    ->whereHas('membership', function (Builder $query) use ($company, $request){
                        $query->where('id','=', $request->user()->id);
                        $query->orWhere('company_id','=', $company->id);
                    })
                    ->pluck('id')
                    ->toArray();

        $users = User::query();
        // Where
        $users->whereNotIn('users.id', $discard);
        // Search
        if(!empty($request->search)){
            $searchFields = ['users.name','memberships.job_title','countries.name','countries.region'];
            $users->where(function($query) use($request, $searchFields){
                $searchWildcard = '%' . $request->search . '%';
                foreach($searchFields as $field){
                $query->orWhere($field, 'LIKE', $searchWildcard);
                }
            });
        }
        $data_select = (new UserController)->data_select;

        $user_select = array_merge($data_select, [
            'memberships.id as membership_id',
            'users.id as user_id',
            'memberships.company_id as company_id',
            'memberships.job_title',
            'memberships.role'
        ]);

        $users->select($user_select);
        // Join
        $users->join('user_data', 'users.id', '=', 'user_data.user_id');
        $users->leftJoin('memberships', 'users.id', '=', 'memberships.user_id');
        $users->leftJoin('countries', 'user_data.country', '=', 'countries.iso2');

        // Limit Results
        // $users->limit(5);

        $users->orderBy('users.id');

        return $users->get();

    }



    public function store(Request $request)
    {
        $request->validate([
            'company_id' => ['required','integer'],
            'email' => ['email','required','unique:users'],
        ]);

        $hash = Hash::make(Str::random(80));


        $sender = $request->user();

        $company = Company::where('id', $request->company_id)->first();

        $user = new User([
            'email' => $request->email,
            'password' => $hash
        ]);
        $user->save();

        $userdata = new UserData([
            'profile_pic' => '/storage/factory/avatar/misc/avatar-user.jpg'
        ]);
        $userdata->user()->associate($user);
        $userdata->save();


        $membership = new Membership([
            'role' => $request->role,
            'job_title' => $request->job_title
        ]);
        $membership->user()->associate($user);
        $membership->company()->associate($company);
        $membership->save();

        $token = $user->createToken('invitation_token')->plainTextToken;

        // Create URL
        $create_url = URL::signedRoute('password.create', [
            'user' => $membership->user,
            'token' => $token
        ]);
        $replace_url = Config::get('app.url');
        $input_url = url('/');
        $url = str_replace($input_url, $replace_url, $create_url);

        $in_data = [
                'membership' => $membership,
                'sender' => $sender,
                'token' => $token,
                'url' => $url,
        ];

        // Send Invitation
        Mail::to($user)->send(new UserInvitation($membership, $sender, $url));

        return new JsonResponse(['message' => 'Thanks!', 'insert_data' => $in_data], 200);
    }

    public function show(User $user)
    {
        $uq = User::query();
        // Where
        $uq->where('users.id', $user->id);
        // Selects
        $uq->select($this->data_select);
        // Join
        $uq->join('user_data', 'users.id', '=', 'user_data.user_id');
        $uq->leftJoin('countries', 'user_data.country', '=', 'countries.iso2');
        return $uq->first();
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
        ]);

        $update = [
            'user' => [
                'name' => $request->name,
                'email' => $request->email,
            ],
            'userdata' => [
                'site' => $request->site,
                'phone' => $request->phone,
                'country' => $request->country,
                'city' => $request->city,
                'address' => $request->address,
                'gender' => $request->gender,
            ],
        ];

        $updated = User::where('id', $user->id)->update($update['user']);

        if($updated){
            $dataupdated = UserData::where('user_id', $user->id)->update($update['userdata']);
            if ($dataupdated) {

                $ruser = $this->show($user);
                return new JsonResponse(['message' => 'User Successfully Updated', 'user' => $ruser], 200);
            }
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);

    
    }

    public function destroy(User $user)
    {
        $deleted = $user->delete();
        if($deleted){
            return new JsonResponse(['message' => 'User Successfully Deleted'], 200);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    public function new_account(Request $request)
    {   
        
        $request->validate([
            'name' => 'required|min:3',
            'country' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $id = $request->user()->id;
        
        if(!$id) return new JsonResponse(['message' => 'Request Failed to Complete','errors' => ['user' => 'User Not Found']], 422);

        $user = User::where('id', $id)->first();
        $userdata = UserData::where('user_id', $id)->first();

        if(!$user) return new JsonResponse(['message' => 'Request Failed to Complete','errors' => ['user' => 'User Not Found']], 422);
        if(!$userdata) return new JsonResponse(['message' => 'Request Failed to Complete','errors' => ['userdata' => 'User Data Not Found']], 422);

        $user->name = $request->name;
        
        $userdata->country = $request->country;
        $userdata->save();

        $new_password = Hash::make($request->password);
        $user->forceFill([
            'password' => $new_password,
            'email_verified_at' => now()
        ])->setRememberToken(Str::random(60));
        $user->save();
        $request->user()->currentAccessToken()->delete();
        return new JsonResponse(['message' => 'Welcome', 'user' => $user], 200);
    }

}
