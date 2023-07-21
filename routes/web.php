<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use Illuminate\Auth\Events\Login;
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



Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/login', [AuthController::class, 'authenticate']);
});    
    

Route::middleware('auth')->group(function() {
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::get('/user/dashboard', [DashboardController::class, 'dashboard']); 
Route::resource('/user/users', UsersController::class);