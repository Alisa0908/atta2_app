<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

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

Route::get('/', [ItemController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::resource('items', ItemController::class)
    ->only(['index', 'show','create', 'store', 'edit', 'update', 'destroy']);

Route::resource('items', ItemController::class)
    ->middleware(['auth:sanctum', 'verified'])
    ->only(['create', 'store', 'edit', 'update', 'destroy']);



