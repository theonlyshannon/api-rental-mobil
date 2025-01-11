<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ReservationController;

Route::apiResource('cars', CarController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('reservations', ReservationController::class);
Route::post('reservations/{id}/update-status', [ReservationController::class, 'approve']);


