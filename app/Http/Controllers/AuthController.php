<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;


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

        // 'password' => 'current_password:api'

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

    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        
        $status = Password::sendResetLink(
            $request->only('email')
        );
        
        if($status === Password::RESET_LINK_SENT){
            return new JsonResponse(['message' => __($status)], 200);
        } else {
            return new JsonResponse(['message' => __($status)], 400);
        }
        return new JsonResponse(['message' => 'Request Failed to Complete'], 422);
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ]);

        $retUser = User::where('email', $request->email)->first();
     
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
     
                $user->save();
     
                event(new PasswordReset($user));
            }
        );
     
        return $status === Password::PASSWORD_RESET
                    ? new JsonResponse(['message' => __($status), 'user' => $retUser], 200)
                    : new JsonResponse(['message' => __($status)], 400);
    }
}
