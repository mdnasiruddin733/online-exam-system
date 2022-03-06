@component('mail::message')
# Introduction

<p>Your Email: <strong>{{$data['email']}}</strong></p>
<p>Your Password: <strong>{{$data['password']}}</strong></p>
@component('mail::button', ['url' =>$data['url']])
Login to Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
