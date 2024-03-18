<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class register extends Controller
{
    public function view() {
        return view('register.register');
    }

    public function store(Request $request) {
        $regist = new User;
        $regist->username = $request->username;
        $regist->full_name = $request->full_name;
        $regist->password = $request->password;
        $regist->no_telepon = $request->no_telepon;
        $regist->alamat = $request->alamat;
        $regist->email = $request->email;

        $regist->save();
        return redirect('/login');
    }
}
