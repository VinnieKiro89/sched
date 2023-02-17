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

// route to Course list, kinda redundant and probably not needed anymore
// Route::resource('/course', 'App\Http\Controllers\CourseController');

// idk what these are for, ignore them
Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

Route::get('/home', function () {
    return view('home');
});
// end lol

//Login?
Route::group([ 'prefix' => 'auth'], function() {
    Route::get('/login',[App\Http\Controllers\MainController::class, 'login'])->name('auth.login');
    Route::get('/register',[App\Http\Controllers\MainController::class, 'register'])->name('auth.register');
    Route::post('/save',[App\Http\Controllers\MainController::class, 'save'])->name('auth.save');
    Route::post('/check',[App\Http\Controllers\MainController::class, 'check'])->name('auth.check');
    Route::get('/logout',[App\Http\Controllers\MainController::class, 'logout'])->name('auth.logout');
});

//Settings
Route::group(['middleware' =>['AuthCheck'], 'prefix' => 'settings'], function() {
    Route::get('', [App\Http\Controllers\SettingController::class, 'index'])->name('settings.index');
    Route::put('/updatepass/{id}', [App\Http\Controllers\SettingController::class, 'updatePass'])->name('settings.pass');
    Route::put('/updateuser/{id}', [App\Http\Controllers\SettingController::class, 'updateUser'])->name('settings.user');
});

//Settings without the AuthCheck because im a big dumdum
Route::group(['prefix' => 'settings'], function(){
    Route::get('/backup', [App\Http\Controllers\SettingController::class, 'backup'])->name('settings.backup');
    Route::post('/restore', [App\Http\Controllers\SettingController::class, 'restore'])->name('settings.restore');
    Route::get('/reset', [App\Http\Controllers\SettingController::class, 'nuke'])->name('settings.nuke');
});

//dashboard
Route::group(['middleware' =>['AuthCheck'], 'prefix' => 'dashboard'], function() {
    Route::get('',[App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
});

//Approval
Route::group(['middleware' =>['AuthCheck'], 'prefix' => 'approval'], function() {
    Route::get('',[App\Http\Controllers\AssignmentApprovalsController::class, 'index'])->name('approval.index');
    Route::get('/recall',[App\Http\Controllers\AssignmentApprovalsController::class, 'recall'])->name('approval.recall');
    Route::put('/approve',[App\Http\Controllers\AssignmentApprovalsController::class, 'approve'])->name('approval.approve');
    Route::put('/decline',[App\Http\Controllers\AssignmentApprovalsController::class, 'decline'])->name('approval.decline');
    Route::post('/store',[App\Http\Controllers\AssignmentApprovalsController::class, 'store'])->name('approval.store');
});

//User Management
Route::group(['middleware' =>['AuthCheck'], 'prefix' => 'usermanage'], function() {
    Route::get('',[App\Http\Controllers\UserController::class, 'index'])->name('usermanage.index');
    Route::post('/store',[App\Http\Controllers\UserController::class, 'store'])->name('usermanage.store');
    Route::post('/storefaculty',[App\Http\Controllers\UserController::class, 'storefaculty'])->name('usermanage.storefaculty');
    Route::delete('/destroy/{id}',[App\Http\Controllers\UserController::class, 'destroy'])->name('usermanage.destroy');
    Route::put('/update/{id}',[App\Http\Controllers\UserController::class, 'update'])->name('usermanage.update');
});

//Course
Route::group(['middleware' =>['AuthCheck'], 'prefix' => 'course'], function() {
    Route::get('',[App\Http\Controllers\CourseController::class, 'index'])->name('course.index');
    Route::post('/store',[App\Http\Controllers\CourseController::class, 'store'])->name('course.store');
    Route::delete('/destroy/{id}',[App\Http\Controllers\CourseController::class, 'destroy'])->name('course.destroy');
    Route::put('/update/{id}',[App\Http\Controllers\CourseController::class, 'update'])->name('course.update');
});

//Curriculum
Route::group(['middleware' =>['AuthCheck'], 'prefix' => 'curriculum'], function() {
    Route::get('',[App\Http\Controllers\CurriculumController::class, 'index'])->name('curriculum.index'); // deprecated
    Route::get('/{id}',[App\Http\Controllers\CurriculumController::class, 'view'])->name('curriculum.view');
    Route::post('/store',[App\Http\Controllers\CurriculumController::class, 'store'])->name('curriculum.store');
    Route::delete('/destroy/{id}',[App\Http\Controllers\CurriculumController::class, 'destroy'])->name('curriculum.destroy');
    Route::put('/update/{id}',[App\Http\Controllers\CurriculumController::class, 'update'])->name('curriculum.update');
});

//Subject
Route::group(['middleware' =>['AuthCheck'], 'prefix' => 'subject'], function() {
    Route::get('',[App\Http\Controllers\SubjectController::class, 'index'])->name('subject.index');
    Route::get('/{curriculum}',[App\Http\Controllers\SubjectController::class, 'selectsubject'])->name('subject.selectsubject');
    Route::post('/store',[App\Http\Controllers\SubjectController::class, 'store'])->name('subject.store');
    Route::delete('/destroy/{id}',[App\Http\Controllers\SubjectController::class, 'destroy'])->name('subject.destroy');
    Route::put('/update/{id}',[App\Http\Controllers\SubjectController::class, 'update'])->name('subject.update');
    Route::put('/updateFaculty/{id}',[App\Http\Controllers\SubjectController::class, 'updateFaculty'])->name('subject.updateFaculty');
    Route::get('/oldCurriculum/{curriculum}',[App\Http\Controllers\SubjectController::class, 'oldCurriculum'])->name('subject.oldCurriculum');
});

//Subject without the auth because im a dumdum
Route::group(['prefix' => 'subject'], function() {
    Route::post('/importSubject', [App\Http\Controllers\SubjectController::class, 'importSubject'])->name('subject.importSubject');
});

//Faculty (not done)
Route::group(['middleware' =>['AuthCheck'], 'prefix' => 'faculty'], function() {
    Route::get('',[App\Http\Controllers\FacultyController::class, 'index'])->name('faculty.index');
    Route::get('/view/{id}',[App\Http\Controllers\FacultyController::class, 'view'])->name('faculty.view');
    Route::get('/viewonly/{user_id}',[App\Http\Controllers\FacultyController::class, 'viewonly'])->name('faculty.viewonly');
    Route::get('/edit/{id}',[App\Http\Controllers\FacultyController::class, 'edit'])->name('faculty.edit');
    Route::get('/add',[App\Http\Controllers\FacultyController::class, 'add'])->name('faculty.add');
    Route::post('/store',[App\Http\Controllers\FacultyController::class, 'store'])->name('faculty.store');
    Route::delete('/destroy/{id}',[App\Http\Controllers\FacultyController::class, 'destroy'])->name('faculty.destroy');
    Route::PUT('/update/{id}',[App\Http\Controllers\FacultyController::class, 'update'])->name('faculty.update');
    Route::PUT('/updateSubjTime/{user_id}',[App\Http\Controllers\FacultyController::class, 'updateSubjTime'])->name('faculty.updateSubjTime');
    Route::get('/load',[App\Http\Controllers\FacultyController::class, 'load'])->name('faculty.load');
    Route::get('/facultyLoad',[App\Http\Controllers\FacultyController::class, 'facultyLoad'])->name('faculty.facultyLoad');
    Route::get('/facultyLoadApproval',[App\Http\Controllers\FacultyController::class, 'facultyLoadApproval'])->name('faculty.facultyLoadApproval');
});

//CourseLoading
Route::group(['middleware' =>['AuthCheck'], 'prefix' => 'courseload'], function() {
    Route::get('',[App\Http\Controllers\CourseLoadController::class, 'index'])->name('courseload.index');
    Route::post('/store',[App\Http\Controllers\CourseLoadController::class, 'store'])->name('courseload.store');
    Route::get('/get',[App\Http\Controllers\CourseLoadController::class, 'get_subjects'])->name('courseload.get');
    Route::get('/getev',[App\Http\Controllers\CourseLoadController::class, 'get_event'])->name('courseload.getev');
    Route::get('/getcal',[App\Http\Controllers\CourseLoadController::class, 'get_cal'])->name('courseload.getcal');
    Route::get('/getpref',[App\Http\Controllers\CourseLoadController::class, 'get_pref'])->name('courseload.getpref');
    Route::get('/getprefmodal',[App\Http\Controllers\CourseLoadController::class, 'get_prefmodal'])->name('courseload.getprefmodal');
    Route::get('/getfac',[App\Http\Controllers\CourseLoadController::class, 'get_fac'])->name('courseload.getfac');
    Route::post('/post',[App\Http\Controllers\CourseLoadController::class, 'store_event'])->name('courseload.post');
    Route::delete('/destroy/{id}',[App\Http\Controllers\CourseLoadController::class, 'destroy'])->name('courseload.destroy');
    Route::patch('/update/{id}',[App\Http\Controllers\CourseLoadController::class, 'update'])->name('courseload.update');
    Route::put('/update2/{id}',[App\Http\Controllers\CourseLoadController::class, 'update2'])->name('courseload.update2');
});

//Reports
Route::group(['middleware' =>['AuthCheck'], 'prefix' => 'reports'], function() {
    Route::get('',[App\Http\Controllers\ReportsController::class, 'index'])->name('reports.index');
    Route::get('/show/{id}',[App\Http\Controllers\ReportsController::class, 'show'])->name('reports.show');
    Route::get('/schedule/{id}',[App\Http\Controllers\ReportsController::class, 'schedule'])->name('reports.schedule');
    // Route::post('/file-import', [App\Http\Controllers\ReportsController::class, 'fileImport'])->name('reports.file-import');
    // Route::get('/file-export', [App\Http\Controllers\ReportsController::class, 'fileExport'])->name('reports.file-export');
});

//Reports Excel
Route::group(['prefix' => 'reports'], function() {
    Route::post('/file-import', [App\Http\Controllers\ReportsController::class, 'fileImport'])->name('reports.file-import');
    Route::get('/file-export', [App\Http\Controllers\ReportsController::class, 'fileExport'])->name('reports.file-export');
});

//FacultyLoading Excel
Route::group(['prefix' => 'faculty'], function() {
    Route::post('/file-import', [App\Http\Controllers\FacultyController::class, 'fileImport'])->name('faculty.file-import');
    Route::get('/file-export', [App\Http\Controllers\FacultyController::class, 'fileExport'])->name('faculty.file-export');
    Route::get('/file-export2/{id}', [App\Http\Controllers\FacultyController::class, 'fileExport2'])->name('faculty.file-export2'); // for faculty schedule
});

//CourseLoading Excel
Route::group(['prefix' => 'courseload'], function() {
    Route::post('/file-import', [App\Http\Controllers\CourseLoadController::class, 'fileImport'])->name('courseload.file-import');
    Route::get('/file-export', [App\Http\Controllers\CourseLoadController::class, 'fileExport'])->name('courseload.file-export');
});