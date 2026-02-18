<?php

use App\Http\Controllers\ServiceController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Traditional Laravel MVC routes using Blade views
*/

// Guest routes
Route::get('/', function () {
    return redirect()->route('services.index');
});

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    
    // Dashboard (Client Dashboard)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Services resource
    Route::resource('services', ServiceController::class);
    
    // Jobs resource (no show page)
    Route::resource('jobs', JobController::class)->except(['show']);
    
    // Orders
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/services/{service}/order', [OrderController::class, 'store'])->name('orders.store');
    Route::post('/services/{service}/request', [OrderController::class, 'store'])->name('services.request');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

require __DIR__.'/auth.php';
