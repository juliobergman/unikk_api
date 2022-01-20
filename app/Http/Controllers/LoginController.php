<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'device' => ['required'],
        ]);
        
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials)) {
            // Authorized
            $user = Auth::user()->id;

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
            ];
    
            $uq = User::query();
            // Where
            $uq->where('users.id', $request->user()->id);
            // Selects
            $uq->select($data_select);
            // Join
            $uq->join('user_data', 'users.id', '=', 'user_data.user_id');
            $uq->join('countries', 'user_data.country', '=', 'countries.iso2');
            $user = $uq->first();

            $mq = Membership::query();
            $mq->where('user_id', $request->user()->id);
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

            return new JsonResponse([
                'message' => 'Authenticated', 
                'auth' => true,
                'token' => $user->createToken($request->device)->plainTextToken,
                'user' => $user, 
                'company' => $company,
                'currentMembership' => $memberships[0],
                'userMemberships' => $memberships,
            ], 200);
        }
        // Not Authorized
        return new JsonResponse(['message' => 'Unauthenticated', 'auth' => false], 419);


    }
}
