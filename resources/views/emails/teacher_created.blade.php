@component('mail::message')
<h3>Hi {{$data['name']}},</h3>
<p>Welcome to Online Exam System. Your teacher account created successfully. Here is your credentials.</p>
<p>Your Email: <strong>{{$data['email']}}</strong></p>
<p>Your Password: <strong>{{$data['password']}}</strong></p>
@component('mail::button', ['url' =>$data['url']])
Login to Dashboard
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
