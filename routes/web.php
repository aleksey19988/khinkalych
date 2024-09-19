<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SealController;
use App\Http\Controllers\UtilityController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::resource('seals', SealController::class);
Route::resource('profiles', ProfileController::class);
Route::resource('utilities', UtilityController::class);

//Route::controller(SealController::class)->group(function () {
//    Route::get('/seals', 'index')->name('seals.index');
//    Route::get('/seals/create', 'create')->name('seals.create');
//    Route::post('/seals', 'store')->name('seals.store');
//    Route::get('/seals/{id}', 'show')->name('seals.show');
//    Route::get('/seals/{id}/edit', 'edit')->name('seals.edit');
//    Route::put('/seals/{id}', 'update')->name('seals.update');
//    Route::delete('/seals/{id}', 'destroy')->name('seals.destroy');
//});
