<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Provider\ServiceController;


    Route::get("login", [AuthController::class,"loginView"])->name("login");
    Route::post("login", [AuthController::class,"login"])->name('login_action');
    Route::post("logout", [AuthController::class, "logout"])->name("logout");


Route::middleware(['auth' , 'role:admin'])->group(function () {
    Route::get("dashboard", [DashboardController::class, "index"])->name("home");
});

// Category Management Routes
    Route::prefix('categories')->name('category.')->middleware(['auth','role:admin'])->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{id}', [CategoryController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{id}/update', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{id}/delete', [CategoryController::class, 'delete'])->name('destroy');
    });

    
// Service Management Routes
Route::prefix('services')->name('services.')->middleware(['auth','role:provider'])->group(function () {
        Route::get('/', [ServiceController::class, 'index'])->name('index');
        Route::get('/create', [ServiceController::class, 'create'])->name('create');
        Route::post('/store', [ServiceController::class, 'store'])->name('store');
        Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('edit');
        Route::put('/{service}/update', [ServiceController::class, 'update'])->name('update');
        Route::delete('/{service}/destroy', [ServiceController::class, 'destroy'])->name('destroy');

        Route::get('/{service}/show', [ServiceController::class, 'show'])->name('show');

    });

    Route::prefix('orders')->middleware(['auth:api'])->group(function () {
        Route::get('/' , [OrderController::class,'index'])->name('index')->middleware(['role:client,admin,provider']);
        Route::get('/create', [OrderController::class, 'create'])->name('create')->middleware(['role:client']);
        Route::post('/store', [OrderController::class, 'store'])->name('store')->middleware(['role:client']);

    });
Route::get('/', function () {
    return view('welcome');
});
