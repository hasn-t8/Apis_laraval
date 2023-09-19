<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\signupController;

Route::post('/signup', [signupController::class, 'signup'])->name('signup');
 Route::post('/login', [signupController::class, 'login'])->name('login');
//Route::get('/login', [signupController::class, 'getItems']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
