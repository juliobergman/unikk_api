<?php

namespace App\Providers;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Config;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //
        ResetPassword::createUrlUsing(function ($user, string $token) {
            return env('APP_URL').'/reset-password/'.urlencode($user->email).'/'.$token;
        });
        // /email/verify/id/hash/expires/signature
        VerifyEmail::createUrlUsing(function ($notifiable) {
            $verifyUrl = URL::temporarySignedRoute(
                'verification.verify',
                Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
                [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification()),
                ]
            );

            $url = urldecode($verifyUrl);
            $url_parse = parse_url($url);
            $url_queries = explode('&', $url_parse['query']);
            foreach ($url_queries as $qry) {
                $exp = explode('=', $qry);
                $url_qry[$exp[0]] = $exp[1];
            }
            $url = $url_parse['path'].'/'.$url_qry['expires'].'/'.$url_qry['signature'];
            return env('APP_URL').str_replace('/jokili_api/public/api', '', $url);
        });
    }
}
