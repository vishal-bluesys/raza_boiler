<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('users')->middleware(['jwt.auth'])->group(function () {
    Route::get('/', [UserController::class, 'index']); // Get users list
    Route::get('/{id}', [UserController::class, 'show']); // Get user details
    Route::post('/', [UserController::class, 'store']); // Add user
    Route::put('/{id}', [UserController::class, 'update']); // Update user
    Route::get('/{id}/edit', [UserController::class, 'edit']); // Edit user (get for edit form)
    Route::delete('/{id}', [UserController::class, 'destroy']); // Soft delete user
    Route::patch('/{id}/status', [UserController::class, 'setStatus']); // Set user status
});

Route::prefix('company-master')->middleware(['jwt.auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\CompanyMasterController::class, 'index']);
    Route::get('/{id}', [App\Http\Controllers\CompanyMasterController::class, 'show']);
    Route::post('/', [App\Http\Controllers\CompanyMasterController::class, 'store']);
    Route::put('/{id}', [App\Http\Controllers\CompanyMasterController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\CompanyMasterController::class, 'destroy']);
    Route::patch('/{id}/status', [App\Http\Controllers\CompanyMasterController::class, 'updateStatus']);
});

Route::prefix('customers')->middleware(['jwt.auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\CustomerController::class, 'index']); // List customers
    Route::get('/{id}', [App\Http\Controllers\CustomerController::class, 'show']); // Show customer
    Route::post('/', [App\Http\Controllers\CustomerController::class, 'store']); // Create customer
    Route::put('/{id}', [App\Http\Controllers\CustomerController::class, 'update']); // Update customer
    Route::delete('/{id}', [App\Http\Controllers\CustomerController::class, 'destroy']); // Delete customer
    Route::get('/types/all', [App\Http\Controllers\CustomerController::class, 'customerTypes']); // Get customer types
    Route::patch('/{id}/status', [App\Http\Controllers\CustomerController::class, 'updateStatus']); // Update customer status
    });

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware(['jwt.auth'])->get('me', [AuthController::class, 'me']);
});
