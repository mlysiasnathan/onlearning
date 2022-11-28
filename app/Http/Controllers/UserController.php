<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\User;

class UserController extends Controller
{
    //
    public function users(Type $var = null)
    {
        # code...
        $users = User::all();
        return view('index', $users);
    }
}
