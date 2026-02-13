<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FreelancerProfileController;
use App\Http\Controllers\API\JobController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ReviewController;
use App\Http\Controllers\API\ServiceController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login',    [AuthController::class, 'login']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('me',      [AuthController::class, 'me']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/freelancer/profile', [FreelancerProfileController::class, 'show'])
        ->middleware('can:create,App\Models\Service');
    Route::post('/freelancer/profile', [FreelancerProfileController::class, 'storeOrUpdate'])
        ->middleware('can:create,App\Models\Service');

    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/services/{service}', [ServiceController::class, 'show']);

    Route::post('/services', [ServiceController::class, 'store'])
        ->middleware('can:create,App\Models\Service');
    Route::put('/services/{service}', [ServiceController::class, 'update'])
        ->middleware('can:update,service');
    Route::delete('/services/{service}', [ServiceController::class, 'destroy'])
        ->middleware('can:delete,service');

    Route::get('/jobs', [JobController::class, 'index']);
    Route::get('/jobs/{job}', [JobController::class, 'show']);

    Route::post('/jobs', [JobController::class, 'store'])
        ->middleware('can:create,App\Models\Job');
    Route::put('/jobs/{job}', [JobController::class, 'update'])
        ->middleware('can:update,job');
    Route::delete('/jobs/{job}', [JobController::class, 'destroy'])
        ->middleware('can:delete,job');

    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/orders/{order}', [OrderController::class, 'show']);

    Route::post('/orders', [OrderController::class, 'store'])
        ->middleware('can:create,App\Models\Order');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])
        ->middleware('can:updateStatus,order');

    Route::post('/reviews', [ReviewController::class, 'store']);
});

