<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
