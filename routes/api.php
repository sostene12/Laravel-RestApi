<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;


// Route::resource('products',ProductController::class);

// public routes
Route::get("/products",[ProductController::class,'index']);
Route::get("/products/search/{name}",[ProductController::class,'search']);
Route::get("/products/{id}",[ProductController::class,'show']);

Route::post("/register",[AuthController::class,'register']);
Route::post("/login",[AuthController::class,'login']);
 

// protected Routes
Route::group(['middleware'=> ['auth:sanctum']], function () {
    Route::post("/products",[ProductController::class,'store']);
    Route::put("/products/update/{id}",[ProductController::class,'update']);
    Route::delete("/products/delete/{id}",[ProductController::class,'destroy']);

    Route::post("/logout",[AuthController::class,'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

