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
            'username' => 'required|unique:users',
            'full_name' => 'required',
            'password' => 'required|min:8|max:16',
            'no_telepon' => 'required',
            'alamat' => 'required',
            'email' => 'required|unique:users'
        ]);

        $validated['password'] = bcrypt($validated['password']);

        User::create($validated);

        return redirect('/login');
    }
}
