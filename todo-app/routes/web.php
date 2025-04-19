<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', [TodoController::class, 'index']);
Route::post('/add', [TodoController::class, 'add']);
Route::post('/delete/{id}', [TodoController::class, 'delete']);
Route::post('/update/{id}', [TodoController::class, 'update']);
Route::post('/toggle/{id}', [TodoController::class, 'toggle']);