<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();
Route::get("/register/student",[RegisterController::class,"showStudentRegisterForm"]);
Route::get("/register/teacher",[RegisterController::class,"showTeacherRegisterForm"]);
Route::get("/register/admin",[RegisterController::class,"showAdminRegisterForm"]);

Route::post("/register/student",[RegisterController::class,"createStudent"])->name("register.student");
Route::post("/register/teacher",[RegisterController::class,"createTeacher"])->name("register.teacher");
Route::post("/register/admin",[RegisterController::class,"createAdmin"])->name("register.admin");


Route::get("/login/student",[LoginController::class,"showStudentLoginForm"])->name("login.student");
Route::get("/login/teacher",[LoginController::class,"showTeacherLoginForm"])->name("login.teacher");
Route::get("/login/admin",[LoginController::class,"showAdminLoginForm"])->name("login.admin");


Route::post("/login/student",[LoginController::class,"studentLogin"])->name("login.student");
Route::post("/login/teacher",[LoginController::class,"teacherLogin"])->name("login.teacher");
Route::post("/login/admin",[LoginController::class,"adminLogin"])->name("login.admin");



Route::get("/dashboard/student",[StudentController::class,"index"])->name("dashboard.student");
Route::get("/dashboard/teacher",[TeacherController::class,"index"])->name("dashboard.teacher");
Route::get("/dashboard/admin",[AdminController::class,"index"])->name("dashboard.admin");
