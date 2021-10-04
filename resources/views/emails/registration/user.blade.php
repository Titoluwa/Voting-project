@component('mail::message')
# Welcome to this Votingg app

<p>Hi, {{ $user['last_name'] }} {{ $user['first_name'] }}</p>

<p>Your email (<em>{{ $user['email'] }}</em>) was used to register into this platform. Verify your account to complete registration.</p>

@component('mail::button', ['url' => ''])
Verify your account
@endcomponent

Thanks,<br>
Votingg App
@endcomponent
