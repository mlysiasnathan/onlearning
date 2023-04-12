<h1>Users--------------------</h1>

@foreach ($users as $user)
    <h3>Names :{{ $user->user_name }}</h3><code>Email: {{ $user->email }}</code>
    <p>Role: <code>{{ $user->admin ? $user->admin->role : 'not assigned role' }}</code></p>
@endforeach
<br/>
<br/>
<h1>Admins--------------------</h1>
@forelse (App\Models\Admin::all() as $admin)
<br/>
<h3>Names :{{ ($admin->user->user_name) }}</h3><code>Email: {{ $user->email }}</code>
@empty
    <h6>no admin</h6>
@endforelse