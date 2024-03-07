<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ScheduleController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/distinctTimes', [ExamController::class, 'distinctTimes'])->name('distinctTimes');
Route::post('/distinctTimesView', [ExamController::class, 'distinctTimesView'])->name('distinctTimesView');

Route::post('/distinctDays', [ExamController::class, 'distinctDays'])->name('distinctDays');

Route::get('/departments', [App\Http\Controllers\DepartmentController::class, 'index'])->name('departments');
Route::get('/departments/show/{id}', [App\Http\Controllers\DepartmentController::class, 'show'])->name('department');

Route::get('/classes', [App\Http\Controllers\ClassesController::class, 'index'])->name('classes');
Route::get('/classes/show/{department_id}', [App\Http\Controllers\ClassesController::class, 'show'])->name('classe');

Route::get('/classrooms', [App\Http\Controllers\ClassroomController::class, 'index'])->name('classrooms');
Route::get('/classrooms/show/{department_id}/{class_id}', [App\Http\Controllers\ClassroomController::class, 'show'])->name('classroom');

Route::get('/schedules', [App\Http\Controllers\ScheduleController::class, 'index'])->name('schedules');
Route::get('/schedules/show/{id}', [App\Http\Controllers\ScheduleController::class, 'show'])->name('schedule');
Route::get('/schedules/show/department/{department_id}', [App\Http\Controllers\ScheduleController::class, 'showSchedulesByDepartment'])->name('schedulesByDepartment');
Route::get('/schedules/show/department/{department_id}/classes/{class_id}', [App\Http\Controllers\ScheduleController::class, 'showSchedulesByDepartmentClasses'])->name('schedulesByDepartmentClasses');
Route::get('/schedules/show/department/{department_id}/classes/{class_id}/year/{year_id}', [App\Http\Controllers\ScheduleController::class, 'showSchedulesByYearByDepartmentClasses'])->name('showSchedulesByYearByDepartmentClasses');

Route::get('/schedules/show/department/{department_id}/classes/{class_id}/year/{year_id}/group/{group_id}', [App\Http\Controllers\ScheduleController::class, 'showSchedulesByYearByDepartmentClassesGroup'])->name('showSchedulesByYearByDepartmentClassesGroup');

Route::post('/schedules/create', [App\Http\Controllers\ScheduleController::class, 'store'])->name('createSchedules');
Route::get('/classes/{class}/modules', [App\Http\Controllers\ModuleController::class, 'modules'])->name('classes.modules');
Route::get('/semestre', [App\Http\Controllers\SemesterController::class, 'index'])->name('semestre');
Route::get('/teacher_types', [App\Http\Controllers\TeacherTypeController::class, 'index'])->name('teacher_types');
Route::get('/teachers/{teacherTypeId}', [App\Http\Controllers\TeacherController::class, 'show'])->name('teachers.show');
Route::get('/years', [App\Http\Controllers\YearController::class, 'index'])->name('years.index');
Route::get('/groups', [App\Http\Controllers\GroupController::class, 'index'])->name('groups');
Route::get('/years/show/{year}', [App\Http\Controllers\YearController::class, 'show'])->name('years.show');
Route::get('/schedules/week', [App\Http\Controllers\ScheduleController::class, 'getSchedulesForWeek'])->name('schedules.week');
Route::post('/schedules/changeDayOfWeek', 'ScheduleController@changeDayOfWeek');
Route::post('/schedules/changeEverything', 'ScheduleController@changeEverything');
Route::post('/schedules/{schedule}', [ScheduleController::class, 'update']);