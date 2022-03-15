@component('mail::message')
# Welcome to {{ $company->name }}
## New Front Account

@component('mail::panel')
## <strong>{{ $sender->name }}</strong>
Has invited you to form part of his team as <strong>{{ $membership->job_title }}</strong> of <strong>{{ $company->name }}</strong>.
@endcomponent

You are ready to setup your new {{ config('app.name') }} account. <br />
Click the button below to...

@component('mail::button', ['url' => $url])
Setup Account
@endcomponent

### Thanks,<br />The {{ config('app.name') }} Team.
@endcomponent
