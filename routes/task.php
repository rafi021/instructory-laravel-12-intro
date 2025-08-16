<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::patch('tasks/{task}/status', [TaskController::class, 'statusUpdate'])->name('tasks.status');
Route::post('upload', [TaskController::class, 'upload'])->name('upload');
Route::delete('revert', [TaskController::class, 'revert'])->name('revert');
Route::resource('tasks', TaskController::class);
