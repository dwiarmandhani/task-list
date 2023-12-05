<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TasksController;
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

Route::get('/', [HomeController::class, 'index']);
Route::get('/tasks', [TasksController::class, 'index']);
Route::get('/tasks/create', [TasksController::class, 'create']);
Route::get('/tasks/{id}', [TasksController::class, 'show']);
Route::post('/tasks', [TasksController::class, 'store']);
Route::get('/tasks/{id}/edit', [TasksController::class, 'edit']);
Route::patch('/tasks/{id}', [TasksController::class, 'update']);
Route::delete('/tasks/{id}', [TasksController::class, 'destroy']);
