<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home');

Auth::routes([
    'reset' => false,
    'confirm' => false,
]);

Route::view('/home', 'home')
    ->name('home')
    ->middleware('auth');

Route::resource('todos', TodoController::class);
