<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

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

Auth::routes();

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/userinfo', [UserController::class, 'index']);
Route::get('/account', function () {
        return view('users.index');
    })->name('account');


Route::put('/account', [UserController::class, 'update']);


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
