<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class login extends Controller
{
    //
    public function view() {
        return view('login.login');
    }

    public function googleRedirect() {
        return Socialite::driver('google')->redirect();
    }

    public function loginGoogle() {

        $googleUser = Socialite::driver('google')->user();

        $user = Customer::updateOrCreate([
            'google_id' => $googleUser->id,
            'name' => $googleUser->name,
            'email' => $googleUser->email,
        ]);

        Auth::guard('customers')->login($user);
        if(Auth::guard('customers')->check()) {
            return redirect('/');
        }
    }

    public function auth(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email:dns,rfc',
            'password' => 'required|min:8|max:16',
        ]);

        if (Auth::guard('customers')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        if (Auth::guard('users')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/admin');
        }

        return back()->with('error', 'Email atau Password anda salah')->withInput();
    }

    public function logout(Request $request) {

        // Logout untuk admin (guard 'users')
        if (Auth::guard('users')->check()) {
            Auth::guard('users')->logout();  // Logout admin
            $request->session()->invalidate();  // Menghapus seluruh session
            $request->session()->regenerateToken();  // Regenerasi CSRF token
            return redirect('/login');  // Redirect ke halaman login admin
        }

        // Logout untuk customer (guard 'customers')
        if (Auth::guard('customers')->check()) {
            Auth::guard('customers')->logout();  // Logout customer
            $request->session()->invalidate();  // Menghapus seluruh session
            $request->session()->regenerateToken();  // Regenerasi CSRF token
            return redirect('/login');  // Redirect ke halaman login customer
        }
    }
}
