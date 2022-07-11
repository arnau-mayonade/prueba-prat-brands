<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TiempoController;

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

Route::get('/',[TiempoController::class, 'index']);
Route::post('/getTiempoAemet',[TiempoController::class, 'getTiempoAemet']);
