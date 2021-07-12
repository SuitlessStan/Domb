<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AppointmentController;
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



Route::get('/', function () {
    return view('welcome');
});

Route::get('/tasks',[TaskController::class,'index'])->name('tasks');
Route::post('/tasks',[TaskController::class,'store']);

Route::get('/appointments',[AppointmentController::class,'index'])->name('appointments');
Route::post('/appointments',[AppointmentController::class,'store']);


Route::get('/activities',[ActivityController::class,'index'])->name('activities');
Route::post('/activities',[ActivityController::class,'store']);
