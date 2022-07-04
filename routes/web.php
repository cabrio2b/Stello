<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;

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
    return view('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('projects', ProjectController::class)->middleware('auth');

Route::resource('categories', CategoryController::class)->middleware('auth');
//Route::resource('projects/{id}/categories', CategorieController::class)->middleware('auth');

Route::resource('tasks', TaskController::class)->middleware('auth');
//Route::resource('projects/{id}/categories/{id}/tasks', TaskController::class)->middleware('auth');
