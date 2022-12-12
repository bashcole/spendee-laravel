<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\WalletController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::controller(AuthController::class)->prefix('auth')->group(function (){
    Route::post('register', 'createUser');
    Route::post('login','loginUser');
});

Route::controller(WalletController::class)->middleware('auth:sanctum')->name('wallet.')->group(function () {
    Route::get('/wallets', 'list')->name('list');
    Route::get('/wallets/{wallet}', 'show')->name('show')->can('view', 'wallet');
});

Route::controller(TransactionController::class)->middleware('auth:sanctum')->name('transaction.')->group(function () {
    Route::post('/transaction/{transaction}/edit', 'update')->name('update')->can('update', 'transaction');
    Route::post('/transaction/create', 'store')->name('store');
    Route::delete('/transaction/{transaction}/delete', 'destroy')->name('destroy')->can('update', 'transaction');
});
