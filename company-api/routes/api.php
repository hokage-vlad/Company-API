<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
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

Route::middleware('auth:api')->get('/user', [AuthController::class , 'get']);

Route::post('/login', [AuthController::class , 'login']);
Route::post('/logout', [AuthController::class , 'logout']);
Route::post('/register', [AuthController::class , 'register']);



Route::resource('books', BooksController::class);
