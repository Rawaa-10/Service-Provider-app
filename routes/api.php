<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Monolog\Handler\RotatingFileHandler;
use App\Http\Controllers\Client\AuthController;
use App\Http\Controllers\Admin\CategoryController;

Route::prefix("client")->group(function () {
    Route::post("register",[AuthController::class , "register"]);
    Route::post("login",[AuthController::class , "login"]);
    
    Route::middleware("auth:api")->group(function () {
    Route::get("profile",[AuthController::class , "profile"]);
    });

});

Route::prefix('admin')->group(function () {
    Route::apiResource('categories', CategoryController::class);
});


// Route::post('register', function (\Illuminate\Http\Request $request) {
//     return response()->json([
//         'status' => 'ok',
//         'data' => $request->all(),
//     ]);
// });