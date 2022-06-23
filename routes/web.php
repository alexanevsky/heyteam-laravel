<?php

use App\Http\Controllers\TaskController;
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

Route::get('/', [TaskController::class, 'index']);

Route::get('/add', [TaskController::class, 'addForm']);
Route::post('/add', [TaskController::class, 'add']);

Route::get('/{id}', [TaskController::class, 'updateForm']);
Route::post('/{id}', [TaskController::class, 'update']);

Route::post('/{id}/delete', [TaskController::class, 'delete']);
