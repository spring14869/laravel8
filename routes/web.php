<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\AboutController;
use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\SigninController;
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


Route::get('/', [SigninController::class, 'show'])->name('signin.show');
Route::post('/login', [SigninController::class, 'login'])->name('signin.login');
Route::get('/logout', [SigninController::class, 'logout'])->name('signin.logout');

Route::get('/about', [AboutController::class, 'index'])->name('about.index');

Route::resource('user', UserController::class)->middleware('admin.auth');
