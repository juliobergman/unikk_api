<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\UserData;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function index(Request $request)
    {
        // Authorized
        $user = Auth::user();
        $data_select = [
            // Users
            'users.id',
            'users.name',
            'users.email',
            'users.email_verified_at',
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

        $uq = User::query();
        // Where
        $uq->where('users.id', $user->id);
        // Selects
        $uq->select($data_select);
        // Join
        $uq->join('user_data', 'users.id', '=', 'user_data.user_id');
        $uq->join('countries', 'user_data.country', '=', 'countries.iso2');
        $user = $uq->first();

        $mq = Membership::query();
        $mq->where('user_id', $user->id);
        $mq->orderByDesc('default');
        $memberships = $mq->get();

        $data_select_company = [
            // Companies
            'companies.id',
            'companies.name',
            'companies.type',
            // CompanyData
            'company_data.address',
            'company_data.city',
            'company_data.sector',
            'company_data.country',
            'company_data.currency_id',
            'company_data.phone',
            'company_data.email',
            'company_data.website',
            'company_data.info',
            'company_data.logo',
            'company_data.shares',
            'company_data.taxrate',
            // Currency
            'currencies.name as currency_name',
            'currencies.symbol as currency_symbol',
            'currencies.code as currency_code',
            // Country
            'countries.name as country_name',
            'countries.region as country_region',
            'countries.subregion as country_subregion',
            'countries.latitude as country_latitude',
            'countries.longitude as country_longitude',
        ];

        $cq = Company::query();
        // Where
        $cq->where('companies.id', $memberships[0]->id);
        // Selects
        $cq->select($data_select_company);
        // Join
        $cq->join('company_data', 'companies.id', '=', 'company_data.company_id');
        $cq->join('currencies', 'company_data.currency_id', '=', 'currencies.id');
        $cq->join('countries', 'company_data.country', '=', 'countries.iso2');
        $company = $cq->first();

        $tk = explode(' ', $request->header('Authorization'));

        return new JsonResponse([
            'message' => 'Authenticated', 
            'auth' => true,
            'token' => $tk[1],
            'user' => $user, 
            'company' => $company, 
            'currentMembership' => $memberships[0],
            'userMemberships' => $memberships
        ], 200);
    }



    public function store(Request $request)
    {
        return $request;
    }

    public function show(User $user)
    {
        $data_select = [
            // Users
            'users.id',
            'users.name',
            'users.email',
            'users.email_verified_at',
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

        $uq = User::query();
        // Where
        $uq->where('users.id', $user->id);
        // Selects
        $uq->select($data_select);
        // Join
        $uq->join('user_data', 'users.id', '=', 'user_data.user_id');
        $uq->join('countries', 'user_data.country', '=', 'countries.iso2');
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


}
