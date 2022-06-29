<?php

use App\Http\Controllers\EspController;
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

Route::get('/', [EspController::class, 'index']);
Route::get('/key', [EspController::class, 'key']);
Route::get('/user',[EspController::class, 'user']);
