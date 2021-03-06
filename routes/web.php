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
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseControllerForStudent;
use App\Http\Controllers\CQController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamControllerForStudent;
use App\Http\Controllers\QuestionController;

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

    /*=============================Course CRUD by Teacher==============================*/
    Route::get("/courses",[CourseControllerForStudent::class,"index"])->name("course.index");
    Route::post("/course/add",[CourseControllerForStudent::class,"addCourses"])->name("courses.add");
    Route::get("/course/enrolled-course",[CourseControllerForStudent::class,"enrolledCourses"])->name("course.enrolled-course");
    Route::get("/course/show/{id}",[CourseControllerForStudent::class,"show"])->name("course.show");

    Route::get("/exam/participate/{id}",[ExamControllerForStudent::class,"participate"])->name("exam.participate")->middleware("examGiven");
    Route::post("/exam/submit",[ExamControllerForStudent::class,"submit"])->name("exam.submit");
    Route::get("/exam/view-result/{exam_id}",[ExamControllerForStudent::class,"viewResult"])->name("exam.view-result")->middleware("resultMiddleware");
    
});





/*=============================Teacher Routes==============================*/
Route::group(["middleware"=>["auth:teacher"],"as"=>"teacher.","prefix"=>"/teacher"],function(){
    Route::get("/profile",[TeacherController::class,"showProfile"])->name("profile");
    Route::post("/profile/update",[TeacherController::class,"updateProfile"])->name("update-profile");
    Route::post("/profile/change-profile-image",[TeacherController::class,"changeProfileImage"])->name("change-profile-image");
    Route::get("/profile/change-password",[TeacherController::class,"showChangePasswordForm"])->name("change-password");
    Route::post("/profile/change-password",[TeacherController::class,"changePassword"])->name("change-password");

    /*=============================Course CRUD by Teacher==============================*/
    Route::get("/courses",[CourseController::class,"index"])->name("course.index");
    Route::get("/course/create",[CourseController::class,"create"])->name("course.create");
    Route::post("/course/store",[CourseController::class,"store"])->name("course.store");
    Route::get("/course/edit/{id}",[CourseController::class,"edit"])->name("course.edit");
    Route::post("/course/update",[CourseController::class,"update"])->name("course.update");
    Route::get("/course/delete/{id}",[CourseController::class,"delete"])->name("course.delete");

    /*=============================Exam CRUD==============================*/
    Route::get("/exams/{course_id}",[ExamController::class,"index"])->name("exam.index");
    Route::get("/exam/create/{id}",[ExamController::class,"create"])->name("exam.create");
    Route::post("/exam/store",[ExamController::class,"store"])->name("exam.store");
    Route::get("/exam/edit/{id}",[ExamController::class,"edit"])->name("exam.edit");
    Route::post("/exam/update",[ExamController::class,"update"])->name("exam.update");
    Route::get("/exam/delete/{id}",[ExamController::class,"delete"])->name("exam.delete");

    /*=============================Questions CRUD==============================*/
    Route::get("/questions/{exam_id}",[ExamController::class,"showQuestions"])->name("questions");
    Route::get("/setquestions/{exam_id}",[QuestionController::class,"index"])->name("setquestions");
    Route::get("/question/create/{id}",[QuestionController::class,"create"])->name("question.create");
    Route::post("/question/store",[QuestionController::class,"store"])->name("question.store");
    Route::get("/question/edit/{id}",[QuestionController::class,"edit"])->name("question.edit");
    Route::post("/question/update",[QuestionController::class,"update"])->name("question.update");
    Route::get("/question/delete/{id}",[QuestionController::class,"delete"])->name("question.delete");

    Route::post("/cq/store/",[CQController::class,"store"])->name("cq.store");
    Route::get("/cq/edit/{exam_id}",[CQController::class,"edit"])->name("cq.edit");
    Route::post("/cq/update/",[CQController::class,"update"])->name("cq.update");
    Route::get("/cq/delete/{exam_id}",[CQController::class,"delete"])->name("cq.delete");

    Route::get("exam/result/{exam_id}",[ExamController::class,"showResult"])->name("exam.result");
});
