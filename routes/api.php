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


Route::prefix('purchasemaster')->middleware(['jwt.auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\PurchasemasterController::class, 'index']);
    Route::get('/{id}', [App\Http\Controllers\PurchasemasterController::class, 'show']);
    Route::post('/', [App\Http\Controllers\PurchasemasterController::class, 'store']);
    Route::put('/{id}', [App\Http\Controllers\PurchasemasterController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\PurchasemasterController::class, 'destroy']);
});

Route::prefix('orders')->middleware(['jwt.auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\OrderController::class, 'index']);
    Route::get('/{id}', [App\Http\Controllers\OrderController::class, 'show']);
    Route::post('/', [App\Http\Controllers\OrderController::class, 'store']);
    Route::put('/{id}', [App\Http\Controllers\OrderController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\OrderController::class, 'destroy']);
    Route::patch('/{id}/status', [App\Http\Controllers\OrderController::class, 'updateStatus']);
});
    
Route::prefix('orderitems')->middleware(['jwt.auth'])->group(function () {
    Route::get('/index/{id}', [App\Http\Controllers\OrderitemController::class, 'index']);
    Route::get('/{id}', [App\Http\Controllers\OrderitemController::class, 'show']);
    Route::post('/', [App\Http\Controllers\OrderitemController::class, 'store']);
    Route::put('/{id}', [App\Http\Controllers\OrderitemController::class, 'update']);
    Route::delete('/{id}', [App\Http\Controllers\OrderitemController::class, 'destroy']);
    Route::patch('/{id}/status', [App\Http\Controllers\OrderitemController::class, 'updateStatus']);
});
    // VehicleMaster CRUD
    Route::prefix('vehicles')->middleware(['jwt.auth'])->group(function () {
        Route::get('/', [App\Http\Controllers\VehicleMasterController::class, 'index']);
        Route::get('/{id}', [App\Http\Controllers\VehicleMasterController::class, 'show']);
        Route::post('/add', [App\Http\Controllers\VehicleMasterController::class, 'store']);
        Route::put('/{id}', [App\Http\Controllers\VehicleMasterController::class, 'update']);
        Route::delete('/{id}', [App\Http\Controllers\VehicleMasterController::class, 'destroy']);
    });

    // VehicleTypeMaster CRUD
    Route::prefix('vehicle-types')->middleware(['jwt.auth'])->group(function () {
        Route::get('/', [App\Http\Controllers\VehicleTypeMasterController::class, 'index']);
        Route::get('/{id}', [App\Http\Controllers\VehicleTypeMasterController::class, 'show']);
        Route::post('/', [App\Http\Controllers\VehicleTypeMasterController::class, 'store']);
        Route::put('/{id}', [App\Http\Controllers\VehicleTypeMasterController::class, 'update']);
        Route::delete('/{id}', [App\Http\Controllers\VehicleTypeMasterController::class, 'destroy']);
    });
    
        // ItemMaster CRUD
        Route::prefix('items')->middleware(['jwt.auth'])->group(function () {
            Route::get('/', [App\Http\Controllers\ItemMasterController::class, 'index']);
            Route::get('/{id}', [App\Http\Controllers\ItemMasterController::class, 'show']);
            Route::post('/', [App\Http\Controllers\ItemMasterController::class, 'store']);
            Route::put('/{id}', [App\Http\Controllers\ItemMasterController::class, 'update']);
            Route::delete('/{id}', [App\Http\Controllers\ItemMasterController::class, 'destroy']);
        });
    
        // Maintanance CRUD
        Route::prefix('maintanance')->middleware(['jwt.auth'])->group(function () {
            Route::get('/', [App\Http\Controllers\MaintananceController::class, 'index']);
            Route::get('/{id}', [App\Http\Controllers\MaintananceController::class, 'show']);
            Route::post('/', [App\Http\Controllers\MaintananceController::class, 'store']);
            Route::put('/{id}', [App\Http\Controllers\MaintananceController::class, 'update']);
            Route::delete('/{id}', [App\Http\Controllers\MaintananceController::class, 'destroy']);
        });
    
        // MaitainanceType CRUD
        Route::prefix('maintanance-types')->middleware(['jwt.auth'])->group(function () {
            Route::get('/', [App\Http\Controllers\MaitainanceTypeController::class, 'index']);
            Route::get('/{id}', [App\Http\Controllers\MaitainanceTypeController::class, 'show']);
            Route::post('/', [App\Http\Controllers\MaitainanceTypeController::class, 'store']);
            Route::put('/{id}', [App\Http\Controllers\MaitainanceTypeController::class, 'update']);
            Route::delete('/{id}', [App\Http\Controllers\MaitainanceTypeController::class, 'destroy']);
        });

        Route::prefix('route-builder')->middleware(['jwt.auth'])->group(function () {
              Route::get('/', [App\Http\Controllers\RouteBuilderController::class, 'index']);
              Route::get('/filter', [App\Http\Controllers\RouteBuilderController::class, 'filter']);
              Route::get('/{id}', [App\Http\Controllers\RouteBuilderController::class, 'show']);
              Route::post('/', [App\Http\Controllers\RouteBuilderController::class, 'store']);
              Route::put('/{id}', [App\Http\Controllers\RouteBuilderController::class, 'update']);
              Route::delete('/{id}', [App\Http\Controllers\RouteBuilderController::class, 'destroy']);
              Route::patch('/{id}/status', [App\Http\Controllers\RouteBuilderController::class, 'updateStatus']);
        });

        Route::prefix('route-stops')->middleware(['jwt.auth'])->group(function () {
            Route::get('/index/{id}', [App\Http\Controllers\RouteStopController::class, 'index']);
            Route::get('/{id}', [App\Http\Controllers\RouteStopController::class, 'show']);
            Route::post('/', [App\Http\Controllers\RouteStopController::class, 'store']);
            Route::put('/{id}', [App\Http\Controllers\RouteStopController::class, 'update']);
            Route::delete('/{id}', [App\Http\Controllers\RouteStopController::class, 'destroy']);
            Route::patch('/{id}/status', [App\Http\Controllers\RouteStopController::class, 'updateStatus']);
        });

    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::middleware(['jwt.auth'])->get('me', [AuthController::class, 'me']);
    });

    // SaleMaster CRUD
        Route::prefix('sales')->middleware(['jwt.auth'])->group(function () {
            Route::get('/', [App\Http\Controllers\SaleMasterController::class, 'index']);
            Route::get('/{id}', [App\Http\Controllers\SaleMasterController::class, 'show']);
            Route::post('/', [App\Http\Controllers\SaleMasterController::class, 'store']);
            Route::put('/{id}', [App\Http\Controllers\SaleMasterController::class, 'update']);
            Route::delete('/{id}', [App\Http\Controllers\SaleMasterController::class, 'destroy']);
        });

        // SaleItem CRUD
        Route::prefix('saleitems')->middleware(['jwt.auth'])->group(function () {
            Route::get('/', [App\Http\Controllers\SaleItemController::class, 'index']);
            Route::get('/{id}', [App\Http\Controllers\SaleItemController::class, 'show']);
            Route::post('/', [App\Http\Controllers\SaleItemController::class, 'store']);
            Route::put('/{id}', [App\Http\Controllers\SaleItemController::class, 'update']);
            Route::delete('/{id}', [App\Http\Controllers\SaleItemController::class, 'destroy']);
        });
