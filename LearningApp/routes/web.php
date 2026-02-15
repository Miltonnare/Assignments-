<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
})->name('home');

Route::get('/job', function () {
    return view('app');
})->name('job.index');

Route::get('/login', fn () => view('app'))->name('login');
Route::get('/register', fn () => view('app'))->name('register');