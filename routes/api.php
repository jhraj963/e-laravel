<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AddProductController;
use App\Http\Controllers\Api\DiscountController;
// use App\Http\Controllers\Api\DesignationController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function(){
    Route::post('register','_register');
    Route::post('login','_login');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::controller(DesignationController::class)->group(function(){
//     Route::get('designation','index');
//     Route::get('designation/{designation}','show');
//     Route::put('designation/{designation}','update');
//     Route::delete('designation/{designation}','destroy');
//     Route::post('designation/create','store');
// });


Route::controller(AddProductController::class)->group(function(){
    Route::get('addproduct/index','index');
    Route::post('addproduct/create','store');
    Route::get('addproduct/{addproduct}','show');
    Route::post('addproduct/{id}','update');
    Route::delete('addproduct/{addproduct}','destroy');
});

Route::controller(DiscountController::class)->group(function(){
    Route::get('discount/index','index');
    Route::post('discount/create','store');
    Route::get('discount/{discount}','show');
    Route::post('discount/{id}','update');
    Route::delete('discount/{discount}','destroy');
});
