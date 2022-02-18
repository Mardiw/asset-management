<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth']], function () {
    Route::resources([
        'asset' => App\Http\Controllers\AssetController::class,
        'pinjam' => App\Http\Controllers\PinjamController::class
    ]);
    Route::get('qrcode/{id}', [App\Http\Controllers\AssetController::class, 'generate'])->name('asset.generate');
    Route::post('pinjam/input/{id}' , [App\Http\Controllers\PinjamController::class, 'store'])->name('store.pinjam');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
