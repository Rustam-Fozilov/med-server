<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::resources([
    'doctors' => DoctorController::class,
    'services' => ServiceController::class,
    'applications' => ApplicationController::class,
]);
