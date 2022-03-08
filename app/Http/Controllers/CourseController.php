<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
        public function index(){
            $courses=Course::where("department_id",Auth::user()->department_id)->latest()->get();
            return view("teacher.courses.index",compact('courses'));
        }

        public function create(){
            return view("teacher.courses.create");
        }

        public function store(Request $req){
            $this->validate($req,[
                "name"=>"required|string|max:60",
                "code"=>"required|string|max:60"
            ]);
            $course=new Course();
            $course->name=$req->name;
            $course->code=$req->code;
            $course->department_id=auth()->user()->department_id;
            $course->save();
            return redirect(route("teacher.course.index"))->with([
            "type"=>"success",
            "message"=>"Course created successfully"
        ]);
        }

        public function edit($id){
            $course=Course::findOrFail($id);
            return view("teacher.courses.edit",compact('course'));
        }

        public function update(Request $req){
            $this->validate($req,[
                "id"=>"required|exists:courses,id",
                "name"=>"required|string|max:60",
                "code"=>"required|string|max:60"
            ]);
            $course=Course::findOrFail($req->id);
            $course->name=$req->name;
            $course->code=$req->code;
            $course->save();
            
            return redirect(route("teacher.course.index"))->with([
            "type"=>"success",
            "message"=>"Course updated successfully"
        ]);

        }

        public function delete($id){
            $course=Course::findOrFail($id);
            $course->delete();
            return redirect(route("teacher.course.index"))->with([
            "type"=>"success",
            "message"=>"Course deleted successfully"
        ]);
        }
}
