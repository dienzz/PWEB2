<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user1;

class ProfileController extends Controller
{
    private function checkSession()
    {
        if (!session()->has('user_email') && !session()->has('user_id')) {
            return redirect()->route('login')->send();
        }
        return null; 
    }

    public function index()
    {
        $user = user1::find(session('user_id'));

        // Jika user tidak ditemukan (mungkin sesi usang atau ID tidak valid)
        if (!$user) {
            session()->flush(); 
            session()->regenerate();
            return redirect()->route('login')->with('error', 'Sesi tidak valid. Silakan login kembali.');
        }

        return view('profile.index', compact('user'));
    }
}