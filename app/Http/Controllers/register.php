<?php

namespace App\Http\Controllers;

use App\Models\Cities;
use App\Models\Customer;
use App\Models\Province;
use Illuminate\Http\Request;

class register extends Controller
{
    public function view() {
        $provinsi = Province::all();
        $city = Cities::all();
        return view('register.register', ['province' => $provinsi, 'city' => $city]);
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
