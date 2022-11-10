<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CheckoutController;

use App\Http\Controllers\TransactionController;

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





route::post ('/loginn', [AuthController::class,'login']);

Route::post('login', [AuthController::class,'login'])->name('login');
Route::post('/register', [AuthController::class,'register'])->name('register');

Route::get('/logout', [AuthController::class,'logout']);

Route::group(['middleware' => ['role:admin']], function () {

    Route::get('/cart',[CartController::class,'index']);

});

Route::group(['middleware' => ['role:staff,admin']], function () {

    Route::get('/cart',[CartController::class,'index']);

});

Route::group(['middleware' => ['role:user,staff,admin']], function () {

    Route::get('/cart',[CartController::class,'index']);
    Route::get('/cart/{id}/create',[CartController::class,'create']);

    Route::get('/checkout',[CheckoutController::class,'index']);

    Route::post('/transaction/store/',[TransactionController::class,'store']);

});




