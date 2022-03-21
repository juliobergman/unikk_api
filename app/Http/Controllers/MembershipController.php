<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class MembershipController extends Controller
{
    
    
    public $data_select = [
        // Membership
        'memberships.id',
        'memberships.user_id',
        'memberships.company_id',
        'memberships.job_title',
        'memberships.role',
        'memberships.selected',
        // Company
        'companies.name as company_name',
    ];

    
    public function index(Request $request)
    {
        $user = $request->user();

        // Memberships
        $memberships = collect($this->user($request));
        $current_membership = $memberships->where('selected', true)->first();
        if(!$current_membership){
            $current_membership = $memberships->first();
        }
        $company_id = $current_membership->company_id;

        // return $company_id;

        // Handling Sort
        if($request->sort){$sort = explode('-', $request->sort); } else {$sort = ['id', 'asc']; }

        $wg = Membership::query();
        // Where
        $wg->where('memberships.user_id', '!=',$user->id);
        $wg->where('memberships.company_id', $company_id);
        $wg->whereDoesntHave('pat', function (Builder $query) {
            $query->where('name', '=', 'invitation_token');
        });


        // Search
        if(!empty($request->search)){
            $searchFields = ['users.name','memberships.job_title','countries.name','countries.region'];
            $wg->where(function($query) use($request, $searchFields){
                $searchWildcard = '%' . $request->search . '%';
                foreach($searchFields as $field){
                $query->orWhere($field, 'LIKE', $searchWildcard);
                }
            });
        }

        $data_select = (new UserController)->data_select;

        $user_select = array_merge($data_select, [
            'memberships.id as membership_id',
            'memberships.job_title',
            'memberships.role'
        ]);

        $wg->select($user_select);
        // Join
        $wg->join('users', 'memberships.user_id', '=', 'users.id');
        $wg->join('user_data', 'users.id', '=', 'user_data.user_id');
        $wg->leftJoin('countries', 'user_data.country', '=', 'countries.iso2');
        // Sort
        $wg->orderBy($sort[0], $sort[1]);

        $workgroup = $wg->paginate(12);
        
        $implode_sort = implode('-', $sort);
        $workgroup->appends(['search' => $request->search]);
        $workgroup->appends(['sort' => $implode_sort]);

        return $workgroup;

    }

    public function user(Request $request)
    {
        $user = $request->user();
        
        $mq = Membership::query();
        // Where
        $mq->where('memberships.user_id', $user->id);
        $mq->where('companies.type', 'active');
        // Selects
        $mq->select($this->data_select);
        // Join
        $mq->join('companies', 'memberships.company_id', '=', 'companies.id');
        // Order
        $memberships = $mq->get();
        return $memberships;
    }

    public function set(Membership $membership)
    {
        $user = Auth::user();
        $memberships = Membership::where('user_id', $user->id)->update(['selected' => false]);
        if($memberships){
            $set_membership = Membership::where('id', $membership->id)->update(['selected' => true]);
            if ($set_membership) {
                $ret_membership = $this->show($membership);
                return new JsonResponse(['message' => 'Membership Successfully set', 'membership' => $ret_membership], 200);
            }
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    
    public function store(Request $request)
    {   
        $request->validate([
            'id' => 'required',
            'company_id' => 'required',
            'job_title' => 'required',
        ]);

        $exists = Membership::withTrashed()
                    ->where('user_id', $request->id)
                    ->where('company_id', $request->company_id)
                    ->first();

        if(isset($exists)){
            return $this->restore($exists->id, $request);
        }
        
        $create = [
            'user_id' => $request->id,
            'company_id' => $request->company_id,
            'job_title' => $request->job_title,
            'role' => $request->role ? $request->role : 'user',
        ];

        $membership = Membership::create($create);

        return new JsonResponse(['message' => 'Membership Successfully Created', 'membership' => $membership], 200);
    }

    public function show(Membership $membership)
    {
       
        $mq = Membership::query();
        // Where
        $mq->where('memberships.id', $membership->id);
        // Selects
        $mq->select($this->data_select);
        // Join
        $mq->join('companies', 'memberships.company_id', '=', 'companies.id');
        
        return $mq->first();
    }

    public function update(Request $request, Membership $membership)
    {
        $request->validate([
            'job_title' => ['required'],
            'role' => ['required'],
        ]);

        $update = [
            'job_title' => $request->job_title,
            'role' => $request->role,
        ];

        $updated = Membership::where('id', $membership->id)->update($update);

        if($updated){
            $rmembership = Membership::where('id', $membership->id)->first();
            return new JsonResponse(['message' => 'Membership Successfully Updated', 'membership' => $rmembership], 200);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    public function destroy(Membership $membership)
    {
        
        $deleted = $membership->delete();
        if($deleted){
            // $memberships_count = Membership::where('user_id', $membership->user_id)->count();
            // if($memberships_count < 1){
            //     $deleted_user = (new UserController)->destroy(User::where('id', $membership->user_id)->first());
            // }
            return new JsonResponse(['message' => 'Membership Successfully Deleted'], 200);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    public function restore($id, Request $request)
    {

        $membership = Membership::withTrashed()
        ->where('id', $id)
        ->first();

        if($request->role){
            $membership->role = $request->role;
        }
        if($request->job_title){
            $membership->job_title = $request->job_title;
        }
        $membership->save();
        
        $restored = $membership->restore();
        
        if($restored){
            return new JsonResponse(['message' => 'Membership Successfully Restored'], 200);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    public function destroy_forever(Request $request)
    {
        $membership = Membership::withTrashed()
        ->where('id', $request->id)
        ->first();

        $deleted = $membership->forceDelete();
        if($deleted){
            return new JsonResponse(['message' => 'Membership Permanently Deleted'], 200);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    public function invitations(Request $request, Company $company)
    {
        $invitations = Membership::query();
        $invitations->where('memberships.company_id', $company->id);
        $invitations->whereHas('pat', function (Builder $query) {
            $query->where('name', '=', 'invitation_token');
        });
        
        // Select
        $data_select = (new UserController)->data_select;

        $user_select = array_merge($data_select, [
            'memberships.id as membership_id',
            'users.id as user_id',
            'memberships.company_id as company_id',
            'memberships.job_title',
            'memberships.role'
        ]);

        $invitations->select($user_select);
        $invitations->join('users', 'memberships.user_id', '=', 'users.id');
        $invitations->join('user_data', 'users.id', '=', 'user_data.user_id');
        $invitations->leftJoin('countries', 'user_data.country', '=', 'countries.iso2');

        return $invitations->get();
    }
    public function deleted(Request $request, Company $company)
    {
        $invitations = Membership::query();
        $invitations->onlyTrashed();
        $invitations->where('memberships.company_id', $company->id);
        // $invitations->makeVisible('deleted_at');

        $data_select = (new UserController)->data_select;
        
        $user_select = array_merge($data_select, [
            'memberships.id as membership_id',
            'users.id as user_id',
            'memberships.company_id as company_id',
            'memberships.job_title',
            'memberships.role',
            'memberships.deleted_at',
        ]);
        
        $invitations->select($user_select);
        $invitations->join('users', 'memberships.user_id', '=', 'users.id');
        $invitations->join('user_data', 'users.id', '=', 'user_data.user_id');
        $invitations->leftJoin('countries', 'user_data.country', '=', 'countries.iso2');

        return $invitations->get();
    }
}
