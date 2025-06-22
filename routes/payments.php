<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::resource('payments', PaymentController::class);