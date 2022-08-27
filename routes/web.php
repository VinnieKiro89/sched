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

//dashboard
Route::group([ 'prefix' => 'dashboard'], function() {
    Route::get('',[App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
});

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
    Route::get('/{curriculum_id}/{curriculum}',[App\Http\Controllers\SubjectController::class, 'selectsubject'])->name('subject.selectsubject');
    Route::post('/store',[App\Http\Controllers\SubjectController::class, 'store'])->name('subject.store');
    Route::delete('/destroy/{id}',[App\Http\Controllers\SubjectController::class, 'destroy'])->name('subject.destroy');
    Route::put('/update/{id}',[App\Http\Controllers\SubjectController::class, 'update'])->name('subject.update');
});

//Faculty (not done)
Route::group([ 'prefix' => 'faculty'], function() {
    Route::get('',[App\Http\Controllers\FacultyController::class, 'index'])->name('faculty.index');
    Route::get('/view/{id}',[App\Http\Controllers\FacultyController::class, 'view'])->name('faculty.view');
    Route::get('/edit/{id}',[App\Http\Controllers\FacultyController::class, 'edit'])->name('faculty.edit');
    Route::get('/add',[App\Http\Controllers\FacultyController::class, 'add'])->name('faculty.add');
    Route::post('/store',[App\Http\Controllers\FacultyController::class, 'store'])->name('faculty.store');
    Route::delete('/destroy/{id}',[App\Http\Controllers\FacultyController::class, 'destroy'])->name('faculty.destroy');
    Route::PUT('/update/{id}',[App\Http\Controllers\FacultyController::class, 'update'])->name('faculty.update');
});