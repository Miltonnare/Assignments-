<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
})->name('home');


Route::get("/job",[JobController::class,'index']
)->name('job.index');