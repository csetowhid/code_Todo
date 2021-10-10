<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoController;
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

Route::get('/', HomeController::class)->name('home');

Route::get('/dashboard', [TodoController::class, 'index'])
->middleware(['auth'])
->name('dashboard');

require __DIR__.'/auth.php';


Route::resource('todos', TodoController::class)->except('show');
Route::resource('categories', CategoryController::class)->except('show');
Route::put('todos/{todo}/complete', [TodoController::class,'complete'])->name('todos.complete');