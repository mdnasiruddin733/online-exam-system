<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseControllerForStudent extends Controller
{
    public function index(){
        return view("student.courses.index");
    }

    public function addCourses(Request $req){
        $course_ids=$req->course_ids;
        $student=Student::find(Auth::id());
        $student->courses()->attach($course_ids);
       return redirect(route("student.course.enrolled-course"))->with([
           "type"=>"success",
           "message"=>"Courses are added successfully"
       ]);
        
    }

    public function enrolledCourses(){
        return view("student.courses.enrolled-courses");
    }

    public function show($id){
        if(Student::findOrFail(Auth::id())->hasCourse($id)){
            $course=Course::findOrFail($id);
             return view("student.courses.show",compact("course"));
        }else{
            abort(404,"Course is not found");
        }
       
    }
}
