<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get("/products",[ProductController::class,'index']);

// Route::post("/products",[ProductController::class,'store']);
// Route::get("/products/{id}")

Route::resource('products',ProductController::class);
Route::get("/products/search/{name}",[ProductController::class,'search']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
