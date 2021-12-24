@component('mail::message')
# Forgot Password

Kindly click on below link to change or re-new your password!

@component('mail::button', ['url' => 'http://localhost:8000/forgot-password?email='.$email])
Redirect
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
