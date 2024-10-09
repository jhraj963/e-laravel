<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AddProductController;
use App\Http\Controllers\Api\DiscountController;
use App\Http\Controllers\Api\salesEventController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\AllcustomerController;
use App\Http\Controllers\Api\InventoryController;
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
    Route::get('addproduct','index');
    Route::post('addproduct/create','store');
    Route::get('addproduct/{addproduct}','show');
    Route::post('addproduct/edit/{id}','update');
    Route::delete('addproduct/{addproduct}','destroy');
});

Route::controller(DiscountController::class)->group(function(){
    Route::get('discount','index');
    Route::post('discount/create','store');
    Route::get('discount/{discount}','show');
    Route::post('discount/edit/{id}','update');
    Route::delete('discount/{discount}','destroy');
});

Route::controller(salesEventController::class)->group(function(){
    Route::get('salesevent','index');
    Route::post('salesevent/create','store');
    Route::get('salesevent/{salesevent}','show');
    Route::post('salesevent/edit/{id}','update');
    Route::delete('salesevent/{salesevent}','destroy');
});

Route::controller(BlogController::class)->group(function(){
    Route::get('blog','index');
    Route::post('blog/create','store');
    Route::get('blog/{blog}','show');
    Route::post('blog/edit/{id}','update');
    Route::delete('blog/{blog}','destroy');
});

Route::controller(AllcustomerController::class)->group(function(){
    Route::get('allcustomer','index');
    Route::post('allcustomer/create','store');
    Route::get('allcustomer/{allcustomer}','show');
    Route::post('allcustomer/edit/{id}','update');
    Route::delete('allcustomer/{allcustomer}','destroy');
});

Route::controller(InventoryController::class)->group(function(){
    Route::get('inventory','index');
    Route::post('inventory/create','store');
    Route::get('inventory/{inventory}','show');
    Route::post('inventory/edit/{id}','update');
    Route::delete('inventory/{inventory}','destroy');
});
