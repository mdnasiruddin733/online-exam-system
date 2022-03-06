@component('mail::message')
# Introduction
<h3 style="text-align: center">Your student account is created successfully.</h3>
<p>Your Email: <strong>{{$data['email']}}</strong></p>
<p>Your Password: <strong>{{$data['password']}}</strong></p>
@component('mail::button', ['url' =>$data['url']])
Login to Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
