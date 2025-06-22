<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;

Route::resource('laporans', LaporanController::class);