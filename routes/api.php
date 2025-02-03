<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ReservationController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::post('/login', [AuthenticatedSessionController::class, 'store']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth:sanctum');
Route::post('/register', [RegisteredUserController::class, 'store']);

Route::apiResource('cars', CarController::class);
Route::apiResource('users', UserController::class);
Route::apiResource('reservations', ReservationController::class);
Route::post('reservations/{id}/update-status', [ReservationController::class, 'approve']);

