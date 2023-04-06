<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class UsersController extends Controller
{
    //
    public function users()
    {
        # code...
        $users = User::all();
      
        return view('users',[
            'users' => $users,
        ]);
    }
}
