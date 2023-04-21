<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class ApiUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function index()
    {
        if (Gate::denies('isAdmin')) {
            return response([
                'message' => 'Admin Permissions needed',
            ], 403);
        }
        $users = User::all();
        return view('users')->with('users' , $users);;
    }
    
    public function show()
    {
        return response([
            'user' => auth()->user()
        ], 200);
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
            return response([
                'message' => 'Admin Permissions needed',
            ], 403);
        }
        $user = User::findOrFail($user_id)->delete();
        if (! $user) {
            return response([
                'message' => 'User not found'
            ], 404);
        }
        $user->delete();
        return response([
            'message' => "User's account deleted successfully",
        ], 200);
    }
}
