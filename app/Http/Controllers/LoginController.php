<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            $memberships = $mq->get();

            return new JsonResponse([
                'message' => 'Authenticated', 
                'auth' => true,
                'token' => $user->createToken($request->device)->plainTextToken,
                'user' => $user, 
                'currentMembership' => $memberships[0],
                'userMemberships' => $memberships
            ], 200);
        }
        // Not Authorized
        return new JsonResponse(['message' => 'Unauthenticated', 'auth' => false], 419);


    }
}
