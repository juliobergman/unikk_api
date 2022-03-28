<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
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

        if (Auth::guard('web')->attempt($credentials, $request->remember)) {
            // Authorized
            $data = (new UserController)->index($request);
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

    public function logout(Request $request)
    {   
        $user = $request->user();
        $user->tokens()->where('id', '!=', 1)->delete();
    }

    public function set_password(Request $request)
    {
       $user = $request->user();

        $credentials = $request->validate([
            'old_password' => ['required'],
            'password' => 'required|min:8|confirmed',
        ]);

       if (Auth::check()) {
        if (Auth::guard('web')->attempt(['email' => $user->email, 'password' => $request->old_password])) {
            // Authorized
            $new_password = Hash::make($request->password);

            $userPass = User::where('id', $user->id)->first();
            $userPass->forceFill([
                'password' => $new_password,
            ]);
            $userPass->save();
            return new JsonResponse([
                'title' => 'Success',
                'message' => 'Password Change Succesfully',
                'auth' => true
            ], 200);
        }
        return new JsonResponse([
            'message' => 'Unauthenticated',
            'errors' => [
                'password' => ["The old password you entered is incorrect. Please try again."]
            ],
            'auth' => false
        ], 401);
        
       }
    }
}
