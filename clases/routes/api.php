<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\ParaleloController;


Route::get('/estudiantes', [EstudianteController::class, 'index']);
Route::post('/estudiantes', [EstudianteController::class, 'store']);
Route::get('/estudiantes/{id}', [EstudianteController::class, 'show']);
Route::put('/estudiantes/{id}', [EstudianteController::class, 'update']);
Route::delete('/estudiantes/{id}', [EstudianteController::class, 'destroy']);

Route::get('/paralelos', [ParaleloController::class, 'index']);
Route::post('/paralelos', [ParaleloController::class, 'store']);
Route::get('/paralelos/{id}', [ParaleloController::class, 'show']);
Route::put('/paralelos/{id}', [ParaleloController::class, 'update']);
Route::delete('/paralelos/{id}', [ParaleloController::class, 'destroy']);
