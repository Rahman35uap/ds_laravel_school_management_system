<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Http\Middleware\Admin\OnlyAdmin;
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
    return view('welcome');
});

Route::get('/dashboard', [AdminDashboardController::class,'index'])->middleware(['auth'])->name('dashboard');
// Route::prefix('/admin')->middleware(['auth',OnlyAdmin::class])->group(function(){

//     Route::get('/dashboard',[AdminDashboardController::class,'index']);
// });
// Route::prefix('/teacher')->middleware(['auth',OnlyTeacher::class])->group(function(){

//     Route::get('/dashboard',[TeacherDashboardController::class,'index']);
// });

Route::get('/mail',[UserController::class,'mailSending']);

require __DIR__.'/auth.php';
