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

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns,rfc|unique:users',
            'password' => 'required|min:8|max:16',
            'no_telepon' => 'required',
            'alamat' => 'required',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect('/login');
    }
}
