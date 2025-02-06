<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('client-login', [LoginController::class, 'login'])->name('client-login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('profile', [LoginController::class, 'showProfile'])->name('profile');

Route::resource('authors', AuthorController::class);

Route::resource('books', BookController::class);


