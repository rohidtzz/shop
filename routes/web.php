<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\TripayCallbackController;

use App\Http\Controllers\ShippingController;

use App\Http\Controllers\ProductController;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[WelcomeController::class,'index']);

Route::get('/stock',[ProductController::class,'stock']);



route::post ('/loginn', [AuthController::class,'login']);

Route::post('login', [AuthController::class,'login'])->name('login');
Route::post('/register', [AuthController::class,'register'])->name('register');

Route::get('/logout', [AuthController::class,'logout']);

Route::group(['middleware' => ['role:admin']], function () {

    Route::get('/cart',[CartController::class,'index']);
    Route::get('/transaction/all',[TransactionController::class,'show_all']);

    Route::get('/admin/product',[ProductController::class,'index']);
    Route::get('/admin/product/delete/{id}', [ProductController::class,'destroyproduct']);
    Route::post('/admin/product/create/', [ProductController::class,'create']);
    Route::post('/admin/product/edit', [ProductController::class,'edit']);

});

Route::group(['middleware' => ['role:staff,admin']], function () {

    Route::get('/cart',[CartController::class,'index']);
    Route::get('/transaction/all',[TransactionController::class,'show_all']);

    Route::get('/admin/product',[ProductController::class,'index']);
    Route::get('/admin/product/delete/{id}', [ProductController::class,'destroyproduct']);
    Route::post('/admin/product/create/', [ProductController::class,'create']);
    Route::post('/admin/product/edit', [ProductController::class,'edit']);



});

Route::group(['middleware' => ['role:user,staff,admin']], function () {

    Route::get('/cart',[CartController::class,'index']);
    Route::get('/cart/delete/{id}',[CartController::class,'delete']);
    // Route::get('/cart/plus/{id}',[CartController::class,'plus']);
    // Route::get('/cart/minus/{id}',[CartController::class,'minus']);
    Route::get('/cart/{id}/create',[CartController::class,'create']);

    Route::get('checkout/',[CheckoutController::class,'index']);

    Route::post('/transaction/store/',[TransactionController::class,'store']);
    Route::get('/transaction/daftar',[TransactionController::class,'show']);
    Route::get('/transaction/{references}',[TransactionController::class,'detail']);





    // route::get('alamat',function(){
    //     return view('alamat');
    // });

    // route::post('alamat/store',function(Request $request){
    //     // return view('alamat');
    //     dd($request->city);
    // });




});
route::get('/city',[ShippingController::class,'city']);
route::get('/city/{id}',[ShippingController::class,'city_id']);

route::get('/cost',[ShippingController::class,'cost']);



route::post('/callback', [TripayCallbackController::class,'handle']);

