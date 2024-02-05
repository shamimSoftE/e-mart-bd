<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;



Route::controller(RegisterController::class)->group(function(){
    Route::post('lol/register', 'register');
    Route::post('auth/login', 'login');
});

// Route::post('login',[UserController::class,'loginUser']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group( function () {
    Route::get('product_get', [ProductController::class, 'index']);

    Route::get('user',[UserController::class,'userDetails']);
    Route::get('logout',[UserController::class,'logout']);
});


// Route::group(['middleware' => ['auth:sanctum']], function(){
//     Route::get('product_get', [ProductController::class, 'index']);
//     Route::get('user',[UserController::class,'userDetails']);
//     Route::get('logout',[UserController::class,'logout']);
// });

