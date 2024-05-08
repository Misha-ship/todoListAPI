<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Task\TaskReadController;
use App\Http\Controllers\Task\TaskWriteController;
use App\Http\Controllers\Task\TaskSubtasksController;


Route::group(['prefix' => 'tasks'], function () {
    Route::get('/', [TaskReadController::class, 'index']);
    Route::get('/{taskId}', [TaskReadController::class, 'show'])->where(['taskId' => '[0-9]+']);
    Route::post('/', [TaskWriteController::class, 'store']);
    Route::put('/{task}', [TaskWriteController::class, 'update']);
    Route::delete('/{task}', [TaskWriteController::class, 'destroy']);
    Route::patch('/{task}/complete', [TaskWriteController::class, 'markAsComplete']);
});
