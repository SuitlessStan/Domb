<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PostController;
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
})->name('home');

Route::get('/tasks',[TaskController::class,'index'])->name('tasks');
Route::get('/allTasks',[TaskController::class,'allTasks'])->name('getTasks');
Route::post('/tasks',[TaskController::class,'store']);

Route::get('/appointments',[AppointmentController::class,'index'])->name('appointments');
Route::get('/allAppointments',[AppointmentController::class,'allAppointments'])->name('getAppointments');
Route::post('/appointments',[AppointmentController::class,'store']);


Route::get('/activities',[ActivityController::class,'index'])->name('activities');
Route::get('/allActivities',[ActivityController::class,'allActivity'])->name('getActivities');
Route::post('/activities',[ActivityController::class,'store']);


Route::get('/media',[MediaController::class,'index'])->name('media');
Route::post('/media',[PostController::class,'store']);
Route::get('/allPosts',[MediaController::class,'allPosts'])->name('getPosts');
Route::post('/comments/{postID}',[CommentController::class,'store'])->name('addComment');


Route::get('/calendar',[CalendarController::class,'index'])->name('calendar');
// Route::post('/calendar/action',[FullCalendarController::class,'action']);


Route::get('/fullCalendar', function(){
    return view('fullCalendar');
});

