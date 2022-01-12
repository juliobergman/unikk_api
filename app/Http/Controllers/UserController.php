<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $memberships = $mq->get();

        $tk = explode(' ',$request->header('Authorization'));

        return new JsonResponse([
            'message' => 'Authenticated', 
            'auth' => true,
            'token' => $tk[1],
            'user' => $user, 
            'currentMembership' => $memberships[0],
            'userMemberships' => $memberships
        ], 200);
    }
}
