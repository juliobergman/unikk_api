@component('mail::message')
# Welcome to {{ $company->name }}
## New Front Account

@component('mail::panel')
## <strong>{{ $sender->name }}</strong>
Has invited you to form part of his team as <strong>{{ $membership->job_title }}</strong> of <strong>{{ $company->name }}</strong>.
@endcomponent

Click the following button to finish setup your account...

@component('mail::button', ['url' => $url])
Setup Account
@endcomponent

### Thanks,<br /> {{ config('app.name') }} Team.
@endcomponent
