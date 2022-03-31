<?php


use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CheckController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ManageTeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ManageStudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ImportController;
use Illuminate\Http\Request;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\StudentExamController;

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
     
    return redirect(route('login.student'));
});
Auth::routes();


Route::get("/login",[LoginController::class,"showStudentLoginForm"])->name("login");
Route::get("/login/teacher",[LoginController::class,"showTeacherLoginForm"])->name("login.teacher");
Route::get("/login/admin",[LoginController::class,"showAdminLoginForm"])->name("login.admin");


Route::post("/login",[LoginController::class,"studentLogin"])->name("login.student");
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

    /*============================= Exports and Imports ==============================*/

    Route::get("/import/teacher",[ImportController::class,"uploadTeacherExcell"])->name("import.teacher");
    Route::post("/import/teacher",[ImportController::class,"importTeachers"])->name("import.teacher");

    Route::get("/import/student",[ImportController::class,"uploadStudentExcell"])->name("import.student");
    Route::post("/import/student",[ImportController::class,"importStudents"])->name("import.student");


});

/*=============================Student Routes==============================*/
Route::group(["middleware"=>["auth:student"],"as"=>"student.","prefix"=>"/student"],function(){
    Route::get("/profile",[StudentController::class,"showProfile"])->name("profile");
    Route::post("/profile/update",[StudentController::class,"updateProfile"])->name("update-profile");
    Route::post("/profile/change-profile-image",[StudentController::class,"changeProfileImage"])->name("change-profile-image");
    Route::get("/profile/change-password",[StudentController::class,"showChangePasswordForm"])->name("change-password");
    Route::post("/profile/change-password",[StudentController::class,"changePassword"])->name("change-password");
    
    Route::get("/courses",[CourseController::class,"showMyCourses"])->name("course.index");

    Route::get("/exam/{course_id}",[StudentExamController::class,"index"])->name("exam.index");
    Route::get("/exam/participate/{exam_id}",[StudentExamController::class,"participate"])->name("exam.participate")->middleware("exam");
    Route::post("/exam/submit",[StudentExamController::class,"submit"])->name("exam.submit");
    Route::get("/exam/result/{exam_id}",[StudentExamController::class,"result"])->name("exam.result");

    Route::post("/another-tab-open", [CheckController::class,"check"])->name("another-tab-open");
});





/*=============================Teacher Routes==============================*/
Route::group(["middleware"=>["auth:teacher"],"as"=>"teacher.","prefix"=>"/teacher"],function(){
    Route::get("/profile",[TeacherController::class,"showProfile"])->name("profile");
    Route::post("/profile/update",[TeacherController::class,"updateProfile"])->name("update-profile");
    Route::post("/profile/change-profile-image",[TeacherController::class,"changeProfileImage"])->name("change-profile-image");
    Route::get("/profile/change-password",[TeacherController::class,"showChangePasswordForm"])->name("change-password");
    Route::post("/profile/change-password",[TeacherController::class,"changePassword"])->name("change-password");

    /*=============================Course CRUD==============================*/
    Route::get("/courses",[CourseController::class,"index"])->name("course.index");
    Route::get("/course/create",[CourseController::class,"create"])->name("course.create");
    Route::post("/course/store",[CourseController::class,"store"])->name("course.store");
    Route::get("/course/edit/{id}",[CourseController::class,"edit"])->name("course.edit");
    Route::post("/course/update",[CourseController::class,"update"])->name("course.update");
    Route::get("/course/delete/{id}",[CourseController::class,"delete"])->name("course.delete");
    Route::get("/course/student/add/{course_id}",[CourseController::class,"addStudentForm"])->name("course.add-students");
    Route::post("/course/add-all-students/",[CourseController::class,"addCheckedStudents"])->name("course.add-all-students");
    Route::get("/course/enrolled-students/{course_id}",[CourseController::class,"showEnrolledStudents"])->name("course.enrolled-students");
    Route::get("/course/remove-enrollment/{course_id}/{student_id}",[CourseController::class,"removeEnrollment"])->name("course.remove-enrollment");
    Route::get("/course/remove-all-enrollment/{course_id}/",[CourseController::class,"removeAllEnrollment"])->name("course.remove-all-enrollment");

    /*=============================Exam CRUDs by teacher==============================*/
    Route::get("/exams",[ExamController::class,"index"])->name("exam.index");
    Route::get("/exam/create",[ExamController::class,"create"])->name("exam.create");
    Route::post("/exam/store",[ExamController::class,"store"])->name("exam.store");
    Route::get("/exam/edit/{exam_id}",[ExamController::class,"edit"])->name("exam.edit");
    Route::post("/exam/update",[ExamController::class,"update"])->name("exam.update");
    Route::get("/exam/delete/{id}",[ExamController::class,"delete"])->name("exam.delete");

    /*=============================Question Related CRUDs by teacher==============================*/
    Route::get("/exam/questions/create/{exam_id}",[ExamController::class,"createQuestion"])->name("exam.create-questions");
    Route::get("/exam/questions/import/{exam_id}",[ExamController::class,"importQuestion"])->name("exam.import-questions");

    Route::post("/import/questions",[ImportController::class,"uploadQuestion"])->name("import.questions");

});
