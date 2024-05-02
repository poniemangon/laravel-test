<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User;


Route::get('', [User::class, 'list']);

// Route::get('/', [User::class, 'index']);
Route::get('register', [User::class, 'register']);

Route::post('register-user', [User::class, 'registerUser'])->name('register-user');

