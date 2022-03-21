<?php

namespace App\Http\Controllers;

use App\Models\Pat;
use App\Models\User;
use App\Models\Membership;
use App\Mail\UserInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;
use Illuminate\Database\Eloquent\Builder;

class TestController extends Controller
{
    public function index(Request $request)
    {
        return 'Test Controller Index';
    }

    public function email(Request $request)
    {
        
        $membership = Membership::where('id', 2)->with('user', 'company')->first();
        $sender = User::where('id', 1)->first();
        $token = '2|x48XhQNPcFj9v7KWntyTClc9URikWxsJR5Oz59fZ';        

        $create_url = URL::route('password.create', [
            'user' => $membership->user,
            'token' => $token
        ]);

        $replace_url = Config::get('app.url');
        $input_url = url('/');

        $url = str_replace($input_url, $replace_url, $create_url);

        return new UserInvitation($membership, $sender, $url);
        
    }

    public function membership()
    {
        
        
        // return Pat::all();
        
        $membership = Membership::query();
        $membership->whereHas('pat', function (Builder $query) {
            $query->where('name', '=', 'invitation_token');
        });
        
        return $membership->get();
    }

}
