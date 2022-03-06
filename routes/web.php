<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ManageTeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ManageStudentController;
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

/*=============================Admin Routes==============================*/
Route::group(["middleware"=>["auth:admin"],"as"=>"admin.","prefix"=>"/admin"],function(){
    Route::get("/profile",[AdminController::class,"showProfile"])->name("profile");
    Route::post("/profile/update",[AdminController::class,"updateProfile"])->name("update-profile");
    Route::post("/profile/change-profile-image",[AdminController::class,"changeProfileImage"])->name("change-profile-image");
    Route::get("/profile/change-password",[AdminController::class,"showChangePasswordForm"])->name("change-password");
    Route::post("/profile/change-password",[AdminController::class,"changePassword"])->name("change-password");
  
    /*=============================Departments CRUD==============================*/
    Route::get("/departments",[DepartmentController::class,"index"])->name("department.index");
    Route::get("/department/create",[DepartmentController::class,"create"])->name("department.create");
    Route::post("/department/store",[DepartmentController::class,"store"])->name("department.store");
    Route::get("/department/edit/{id}",[DepartmentController::class,"edit"])->name("department.edit");
    Route::post("/department/update",[DepartmentController::class,"update"])->name("department.update");
    Route::get("/department/delete/{id}",[DepartmentController::class,"delete"])->name("department.delete");

    /*=============================Teacher CRUD==============================*/
    Route::get("/teachers",[ManageTeacherController::class,"index"])->name("teacher.index");
    Route::get("/teacher/create",[ManageTeacherController::class,"create"])->name("teacher.create");
    Route::post("/teacher/store",[ManageTeacherController::class,"store"])->name("teacher.store");
    Route::get("/teacher/edit/{id}",[ManageTeacherController::class,"edit"])->name("teacher.edit");
    Route::post("/teacher/update",[ManageTeacherController::class,"update"])->name("teacher.update");
    Route::get("/teacher/delete/{id}",[ManageTeacherController::class,"delete"])->name("teacher.delete");


    /*=============================Student CRUD==============================*/
    Route::get("/students",[ManageStudentController::class,"index"])->name("student.index");
    Route::get("/student/create",[ManageStudentController::class,"create"])->name("student.create");
    Route::post("/student/store",[ManageStudentController::class,"store"])->name("student.store");
    Route::get("/student/edit/{id}",[ManageStudentController::class,"edit"])->name("student.edit");
    Route::post("/student/update",[ManageStudentController::class,"update"])->name("student.update");
    Route::get("/student/delete/{id}",[ManageStudentController::class,"delete"])->name("student.delete");
});

/*=============================Student Routes==============================*/
Route::group(["middleware"=>["auth:student"],"as"=>"student.","prefix"=>"/student"],function(){
    Route::get("/profile",[StudentController::class,"showProfile"])->name("profile");
    Route::post("/profile/update",[StudentController::class,"updateProfile"])->name("update-profile");
    Route::post("/profile/change-profile-image",[StudentController::class,"changeProfileImage"])->name("change-profile-image");
    Route::get("/profile/change-password",[StudentController::class,"showChangePasswordForm"])->name("change-password");
    Route::post("/profile/change-password",[StudentController::class,"changePassword"])->name("change-password");
});





/*=============================Teacher Routes==============================*/
Route::group(["middleware"=>["auth:teacher"],"as"=>"teacher.","prefix"=>"/teacher"],function(){
    Route::get("/profile",[TeacherController::class,"showProfile"])->name("profile");
    Route::post("/profile/update",[TeacherController::class,"updateProfile"])->name("update-profile");
    Route::post("/profile/change-profile-image",[TeacherController::class,"changeProfileImage"])->name("change-profile-image");
    Route::get("/profile/change-password",[TeacherController::class,"showChangePasswordForm"])->name("change-password");
    Route::post("/profile/change-password",[TeacherController::class,"changePassword"])->name("change-password");
});
