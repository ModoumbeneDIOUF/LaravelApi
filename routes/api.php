<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Middleware\cors;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::controller(UserController::class)->group(function(){

    Route::post('register', 'register');
    Route::post('login', 'login');

});

Route::controller(CategoriesController::class)->group(function(){

    //categories
    Route::post('addCategory','addCategory');
    Route::get('allCategory','allCategory');
    Route::get('getOnCategory/{id}','getOneCategory');
    Route::put('updateCategory/{id}','updateCategory');
    Route::delete('deleteCategory/{id}','deleteCategory');

});

Route::controller(ProductsController::class)->group(function(){

    //products admin part
    Route::get('products','allproduct');
    Route::post('addProduct','addProduct');
    Route::get('getOneProduct/{id}','getOneProduct');
    Route::put('updateProduct/{id}','updateProduct');
    Route::delete('deleteProduct/{id}','deleteProduct');


    //products client part productById
    Route::get('featuredProducts','featuredProducts');
    Route::get('trendingProducts','trendingProducts');
    Route::get('specialOffreProducts','specialOffreProducts');
    Route::get('flashProducts','flashProducts');
    Route::get('productByCategory/{idCat}','productByCategory');
    Route::get('productById/{idProd}','productById');
    Route::get('getOneProduct/{id}','getOneProduct');
    Route::put('updateProduct/{id}','updateProduct');
    Route::delete('deleteProduct/{id}','deleteProduct');

});
