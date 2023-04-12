<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules\Password;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        // return view('auth.register');
        return view('index');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'username_reg' => ['required', 'string', 'max:255'],
            'email_reg' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password_reg' => ['required', 'min:3'],
            // 'password_reg' => ['required', Password::defaults()],
            'password_confirmation' => ['required', 'same:password_reg',],
        ]);

        $user = User::create([
            'user_name' => $request->username_reg,
            'email' => $request->email_reg,
            'password' => Hash::make($request->password_reg),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
