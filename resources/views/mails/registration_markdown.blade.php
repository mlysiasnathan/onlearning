<x-mail::message>
Good morning {{ $user->user_name }}!

<h6>Welcome to our Official Website</h6>
<p>You have been successfully registered to our system</p>
<p>Take a look to our courses link below</p>

<x-mail::button :url="$url">
Courses
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
