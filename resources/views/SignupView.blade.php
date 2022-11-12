@component('mail::message')

Signup here {{$name}}

@component('mail::button',['url'=>'https://www.google.com/'])
    Click here
@endcomponent
@endcomponent

<!-- php artisan make:controller MailController
php artisan make:mail signup
php artisan vendor:publish --tag=laravel-mail -->