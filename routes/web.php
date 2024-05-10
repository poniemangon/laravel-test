<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\User;


Route::get('/', [User::class, 'list'])->name('list');

Route::get('register', [User::class, 'register'])->name('register');

Route::post('register-user', [User::class, 'registerUser'])->name('register-user');

Route::get('edicion-user/{userId}', [User::class, 'edit'])->name('edicion-user');

Route::post('edit-user/{userId}', [User::class, 'editUser'])->name('edit-user');

Route::delete('delete-user/{userId}', [User::class, 'deleteUser'])->name('delete-user');

Route::get('login', [User::class, 'login'])->name('login');

Route::post('login-user', [User::class, 'loginUser'])->name('login-user');

Route::get('logout', [User::class, 'logoutUser'])->name('logout');

Route::get('/home', function () {return view('/users/home');});