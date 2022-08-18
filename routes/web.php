<?php

use App\Http\Controllers\CourseController;
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

//route to Course list, kinda redundant and probably not needed anymore
Route::resource('/course', 'App\Http\Controllers\CourseController');

// idk what these are for, ignore them
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});
// end

//Course
Route::group([ 'prefix' => 'course'], function() {
    Route::get('',[App\Http\Controllers\CourseController::class, 'index'])->name('course.index');
    Route::post('/store',[App\Http\Controllers\CourseController::class, 'store'])->name('course.store');
    Route::delete('/destroy/{id}',[App\Http\Controllers\CourseController::class, 'destroy'])->name('course.destroy');
    Route::put('/update/{id}',[App\Http\Controllers\CourseController::class, 'update'])->name('course.update');
});

//Curriculum
Route::group([ 'prefix' => 'curriculum'], function() {
    Route::get('',[App\Http\Controllers\CurriculumController::class, 'index'])->name('curriculum.index');
    Route::post('/store',[App\Http\Controllers\CurriculumController::class, 'store'])->name('curriculum.store');
    Route::delete('/destroy/{id}',[App\Http\Controllers\CurriculumController::class, 'destroy'])->name('curriculum.destroy');
    Route::put('/update/{id}',[App\Http\Controllers\CurriculumController::class, 'update'])->name('curriculum.update');
});

//Subject
Route::group([ 'prefix' => 'subject'], function() {
    Route::get('',[App\Http\Controllers\SubjectController::class, 'index'])->name('subject.index');
    Route::post('/store',[App\Http\Controllers\SubjectController::class, 'store'])->name('subject.store');
    Route::delete('/destroy/{id}',[App\Http\Controllers\SubjectController::class, 'destroy'])->name('subject.destroy');
    Route::put('/update/{id}',[App\Http\Controllers\SubjectController::class, 'update'])->name('subject.update');
});