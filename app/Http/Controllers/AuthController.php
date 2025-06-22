<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user1; 

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = user1::where('email', $request->email)->first();

        // Direct password comparison as requested (NO HASHING)
        if ($user && $request->password === $user->password) {
            session([
                'user_id' => $user->id,
                'user_name' => $user->name
            ]);

            return redirect()->route('dashboard');
        }

        return redirect()->back()->withInput()->with('error', 'Email atau password salah');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();
        return redirect()->route('login');
    }
}