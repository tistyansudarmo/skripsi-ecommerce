<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class register extends Controller
{
    public function view() {
        return view('register.register');
    }

    public function store(Request $request) {

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email:dns,rfc|unique:customers',
            'password' => 'required|min:8|max:16',
            'no_telepon' => 'required',
            'address_street' => 'required',
            'province' => 'required',
            'city' => 'required',
            'postal_code' => 'required'
        ]);

        $validated['password'] = bcrypt($validated['password']);

        Customer::create($validated);

        return redirect('/login');
    }
}
