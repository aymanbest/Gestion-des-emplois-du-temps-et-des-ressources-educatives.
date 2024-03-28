<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);
    
});

Route::middleware(['auth'])->group(function () {
    
});

Route::get('/timetable', function() {
    return view('timetable.index');
})->name('timetable');

Route::view('/reserve', 'timetable.reserve')->name('reserve');

Route::view('/raport', 'timetable.raport')->name('raport');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::view('/classerooms', 'timetable.classrooms')->name('classrooms');

Route::view('/attendence', 'attendence.index')->name('attendence');
