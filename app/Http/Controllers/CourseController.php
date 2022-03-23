<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
   public function index(){
        return view("teacher.courses.index");
    }

    public function create(){
        return view("teacher.courses.create");
    }

    public function store(Request $req){
        $this->validate($req,[
            "name"=>"required|string",
            "code"=>"required|string|max:24",
            
        ]);
        $teacher=Teacher::find(Auth::id());
        $course=new Course();
        $course->name=$req->name;
        $course->code=$req->code;
        $course->teacher_id=$teacher->id;
        $course->department_id=$teacher->department->id;
        $course->save();
        
        return redirect(route("teacher.course.index"))->with([
          "type"=>"success",
          "message"=>"Course created successfully"
      ]);
    }

    public function edit($id){
        $course= $course=Course::where("teacher_id",Auth::id())->where("id",$id)->firstOrFail();
        return view("teacher.courses.edit",compact('course'));
    }

    public function update(Request $req){
        $this->validate($req,[
            "course_id"=>"required",
            "name"=>"required|string",
            "code"=>"required|string|max:24",
            
        ]);

        $course= $course=Course::where("teacher_id",Auth::id())->where("id",$req->course_id)->firstOrFail();
        $course->name=$req->name;
        $course->code=$req->code;
        $course->save();
        return redirect(route("teacher.course.index"))->with([
          "type"=>"success",
          "message"=>"Course updated successfully"
      ]);

    }

    public function delete($id){
         $course=Course::where("teacher_id",Auth::id())->where("id",$id)->firstOrFail();
        $course->delete();
        return redirect(route("teacher.course.index"))->with([
          "type"=>"success",
          "message"=>"Course deleted successfully"
      ]);
    }


    public function addStudentForm($course_id){
        $course=Course::where("teacher_id",Auth::id())->where("id",$course_id)->firstOrFail();
        $students= Student::where("department_id",$course->department_id)->latest()->get();

        return view("teacher.courses.add-student-form",compact('course','students'));
    }

    public function addCheckedStudents(Request $req){
        $this->validate($req,[
            "course_id"=>"required"
        ]);

        $course=Course::where("teacher_id",Auth::id())->where("id",$req->course_id)->firstOrFail();
        
        $course->students()->attach($req->student_ids);
         return redirect(route("teacher.course.enrolled-students",$req->course_id))->with([
          "type"=>"success",
          "message"=>"Course assigned to selected students successfully"
      ]);
        
    }

    public function showEnrolledStudents($course_id){
        $course=Course::where("teacher_id",Auth::id())->where("id",$course_id)->firstOrFail();
        return view("teacher.courses.enrolled-students",compact('course'));
    }

    public function removeEnrollment($course_id,$student_id){
        $course=Course::where("teacher_id",Auth::id())->where("id",$course_id)->firstOrFail();
        $course->students()->detach($student_id);
        return back()->with([
          "type"=>"success",
          "message"=>"Enrollment removed successfully"
      ]);
        
    }

    public function removeAllEnrollment($course_id){
        $course=Course::where("teacher_id",Auth::id())->where("id",$course_id)->firstOrFail();
        $course->students()->detach($course->students);
        
        return redirect(route("teacher.course.add-students",$course_id))->with([
          "type"=>"success",
          "message"=>"All enrollment removed successfully"
      ]);
    }

    public function showMyCourses(){
        return view("student.courses.index");
    }
}
