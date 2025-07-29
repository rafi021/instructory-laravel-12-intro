<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::patch('tasks/{task}/status', [TaskController::class, 'statusUpdate'])->name('tasks.status');
Route::resource('tasks', TaskController::class);
