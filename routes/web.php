<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});

// Route::prefix('api/users')->group(function () {
//     Route::get('/', [UserController::class, 'index']); // Get users list
//     Route::get('/{id}', [UserController::class, 'show']); // Get user details
//     Route::post('/', [UserController::class, 'store']); // Add user
//     Route::put('/{id}', [UserController::class, 'update']); // Update user
//     Route::get('/{id}/edit', [UserController::class, 'edit']); // Edit user (get for edit form)
//     Route::delete('/{id}', [UserController::class, 'destroy']); // Soft delete user
//     Route::patch('/{id}/status', [UserController::class, 'setStatus']); // Set user status
// });

// Route::prefix('api/auth')->group(function () {
//     Route::post('login', [AuthController::class, 'login']);
//     Route::middleware(['jwt.auth'])->get('me', [AuthController::class, 'me']);
// });
