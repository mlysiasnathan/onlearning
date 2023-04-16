<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('users')->with('users' , $users);;
    }
    
    public function show()
    {
        $user = auth()->user();
        return view('profil')->with('user' , $user);
    }

    public function store(Request $request)
    {
        $request->validate([
            'username_update' => ['required', 'string', 'max:255'],
            'email_update' => ['required', 'string', 'email', 'max:255'],
            // 'email_update' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password_update' => ['required', 'min:3'],
            // 'password_update' => ['required', Password::defaults()],
            'password_confirmation_update' => ['required', 'same:password_update'],
        ]);

        $filename = str_replace(' ', '_',$request->username_update)  . now()->format('_Y_M_d_H\h'). '.' . $request->profil_img->extension();
        $image_path = $request->profil_img->storeAs('img/users', $filename, 'public');

        $user = auth()->user()->update([
            'user_name' => $request->username_update,
            'email' => $request->email_update,
            'password' => Hash::make($request->password_update),
            'path' => $image_path,
            'updated_at' => now(),
        ]);
        dd('Profil Updated successfully');
    }

    public function delete(int $user_id)
    {
        if (Gate::denies('isAdmin')) {
            abort('403');
        }
        User::findOrFail($user_id)->delete();
        dd("User's account deleted successfully");
    }
}
