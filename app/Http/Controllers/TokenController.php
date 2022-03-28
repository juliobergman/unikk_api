<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class TokenController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:personal_access_tokens|max:255|min:3',
        ]);
        $token = $request->user()->createToken($request->name, $request->token_abilities);

        $tokenString = explode('|', $token->plainTextToken);
        return $tokenString[1];

        return $token;
    }


    public function token_2(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }



        $temp_token = Hash::make($request->email.now());

        return $temp_token;


    }

    public function token(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            // 'device_name' => 'required',
        ]);
    
        $user = User::where('email', $request->email)->first();
    
        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        $ret = [
            'user' => Auth::user(),
            'token' => $user->createToken($request->email)->plainTextToken
        ];
    
        return $ret;
    }

    public function auth(Request $request)
    {
        return new JsonResponse(['message' => 'Authenticated', 'auth' => true], 200);
    }

}
