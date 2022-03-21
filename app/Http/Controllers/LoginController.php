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
            $data = (new UserController)->index($request);
            if($data === 'no_memberships'){
                return new JsonResponse([
                    'message' => 'Unauthenticated',
                    'errors' => [
                        'user' => ["It seems this account doesn't have access to this site anymore.", "We're sorry for the inconvenience..."]
                    ],
                    'auth' => false
                ], 403);
            }
            return $data;
        }

        // Not Authorized
        return new JsonResponse([
            'message' => 'Unauthenticated',
            'errors' => [
                'email' => ["It seems the email password combination you entered is incorrect. Please try again."]
            ],
            'auth' => false
        ], 401);
    }
}
