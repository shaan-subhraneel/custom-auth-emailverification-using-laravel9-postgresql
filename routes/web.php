<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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
// code developed by Subhraneel Chowdhury

Route::get('/', function () {
    return view('welcome');
});
Route::get('/auth/register', [MainController::class, 'register'])->name('auth.register');
Route::get('/auth/login', [MainController::class, 'login'])->name('auth.login');
Route::get('/homepage', [MainController::class, 'homepage'])->name('homepage');
Route::get('/email/{token}', [MainController::class, 'emailverification'])->name('email');



Route::post('/auth/save', [MainController::class, 'save'])->name('auth.save');
Route::post('/auth/retrieve', [MainController::class, 'retrieve'])->name('auth.retrieve');