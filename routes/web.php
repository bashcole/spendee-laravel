<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => '{locale}', 'middleware' => ['setLocale', 'auth'], 'where' => ['locale' => '[a-zA-Z]{2}']], function() {

    Route::get('/', [IndexController::class, 'index'])
        ->name('home');

    Route::controller(WalletController::class)->name('wallet.')->group(function () {
        Route::get('/wallet/{wallet}', 'show')->name('view')->can('view', 'wallet');
        Route::post('/wallet/{id}/edit', 'update')->name('update');
        Route::post('/wallet/create', 'create')->name('create');
        Route::delete('/wallet/{id}/delete', 'destroy')->name('destroy');
    });

    Route::controller(TransactionController::class)->name('transaction.')->group(function () {
        Route::post('/transaction/{transaction}/edit', 'update')->name('update')->can('update', 'transaction');
        Route::post('/transaction/create', 'store')->name('store');
        Route::delete('/transaction/{transaction}/delete', 'destroy')->name('destroy')->can('update', 'transaction');
    });

});

require __DIR__.'/auth.php';

Route::get('/', function () {
    return redirect(app()->getLocale());
});
