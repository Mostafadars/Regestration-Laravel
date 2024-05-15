<x-mail::message>
# New User Registration

A new user {{$fullName}} is registered to the system.

<x-mail::button :url="'http://127.0.0.1:8000/register/'">
Register User
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
