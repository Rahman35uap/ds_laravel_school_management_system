<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\Admin\ClassWithSectionController;
use App\Http\Controllers\Admin\dummy;
use App\Http\Controllers\Admin\ExamController;
use App\Http\Controllers\Admin\RoutineController;
use App\Http\Controllers\Admin\SecController;
use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Http\Middleware\Admin\OnlyAdmin;
use App\Http\Middleware\Student\OnlyStudent;
use App\Http\Middleware\Teacher\NotFirstTimeLogin;
use App\Http\Middleware\Teacher\OnlyTeacher;
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
    return view('site.index');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');
Route::prefix('/admin')->middleware(['auth',OnlyAdmin::class])->group(function(){
    Route::get('/dashboard',[AdminDashboardController::class,'index']);
    Route::resource('users', UserController::class);
    Route::get('/allSec/{id}',[UserController::class, 'allSec']);
    Route::resource('subjects', SubjectController::class);
    Route::resource('class', ClassController::class);
    Route::resource('section', SecController::class);
    Route::resource('routine', RoutineController::class);
    Route::resource('exam', ExamController::class);
});
Route::prefix('/teacher')->middleware(['auth',OnlyTeacher::class,NotFirstTimeLogin::class])->group(function(){

    Route::get('/dashboard',[TeacherDashboardController::class,'index']);
});
Route::prefix('/teacher')->middleware(['auth', OnlyTeacher::class])->group(function () {
    Route::get('/firstTimeLogin', [TeacherDashboardController::class, 'firstTimeLogin']);
    Route::post('/firstTimeLogin/passwordUpdate', [TeacherDashboardController::class, 'passwordUpdate']);
});
Route::prefix('/student')->middleware(['auth',OnlyStudent::class,NotFirstTimeLogin::class])->group(function(){

    Route::get('/dashboard',[StudentDashboardController::class,'index']);
});
Route::prefix('/student')->middleware(['auth', OnlyStudent::class])->group(function () {
    Route::get('/firstTimeLogin', [StudentDashboardController::class, 'firstTimeLogin']);
    Route::post('/firstTimeLogin/passwordUpdate', [StudentDashboardController::class, 'passwordUpdate']);
});

Route::get('/mail',[UserController::class,'mailSending']);
Route::get('/hash',[UserController::class,'hash']);

require __DIR__.'/auth.php';
