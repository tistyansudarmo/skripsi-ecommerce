<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

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

        $user = User::updateOrCreate([
            'google_id' => $googleUser->id,
            'name' => $googleUser->name,
            'email' => $googleUser->email,
        ]);

        Auth::login($user);
        return redirect('/');
    }

    public function auth(Request $request) {
        $credentials = $request->validate([
            'email' => 'required|email:dns,rfc',
            'password' => 'required|min:8|max:16',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('error', 'Email atau Password anda salah')->withInput();
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

}
