<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

if (!function_exists('checkSession')) {
    function checkSession() {
        if (!session('user_id')) {
            redirect()->route('login')->send();
        }
    }
}

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard route 
Route::get('/dashboard', function () {
    checkSession();
    return (new DashboardController())->index(); 
})->name('dashboard');

require __DIR__.'/members.php';
require __DIR__.'/visitors.php';
require __DIR__.'/payments.php';
require __DIR__.'/laporans.php';
require __DIR__.'/profile.php';

// Pengaturan 
Route::get('/info', function () {
    checkSession();
    return view('info.index');
})->name('info.index');