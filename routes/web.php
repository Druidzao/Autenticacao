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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('categorias', \App\Http\Controllers\CategoriaController::class)->middleware('auth');

Route::get('login/github', [\App\Http\Controllers\LoginSocialController::class, 'redirectToGithub'])->name('login.github');
Route::get('login/github/callback', [\App\Http\Controllers\LoginSocialController::class, 'handleGithubCallback'])->name('login.github.callback');

Route::get('login/google', [\App\Http\Controllers\LoginSocialController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [\App\Http\Controllers\LoginSocialController::class, 'handleGoogleCallback'])->name('login.google.callback');

require __DIR__.'/auth.php';
