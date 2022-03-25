<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;

class ExamController extends Controller
{
     public function index(){
       
        return view("teacher.exams.index");
    }

    public function create(){
        return view("teacher.exams.create");
    }

    public function store(Request $req){
        $this->validate($req,[
            "title"=>"required|string|max:100",
            "instructions"=>"required|string",
            "started_at"=>"required",
            "ended_at"=>"required",
            "course_id"=>"required",
            
        ]);
        $teacher=Teacher::find(Auth::id());
        $exam=new Exam();
        $exam->title=$req->title;
        $exam->instructions=$req->instructions;
        $exam->course_id=$req->course_id;
        $exam->started_at=$req->started_at;
        $exam->ended_at=$req->ended_at;
        $exam->teacher_id=$teacher->id;
        $exam->save();
        
        return redirect(route("teacher.exam.index"))->with([
          "type"=>"success",
          "message"=>"Exam created successfully"
      ]);
    }

    public function edit($exam_id){
        $exam=Exam::where("teacher_id",Auth::id())->where("id",$exam_id)->firstOrFail();
        return view("teacher.exams.edit",compact('exam'));
    }

    public function update(Request $req){
         $this->validate($req,[
            "exam_id"=>"required",
            "title"=>"required|string|max:100",
            "instructions"=>"required|string",
            "started_at"=>"required",
            "ended_at"=>"required",
            "course_id"=>"required",
            
        ]);
        $teacher=Teacher::find(Auth::id());
        $exam=Exam::where("teacher_id",Auth::id())->where("id",$req->exam_id)->firstOrFail();
        $exam->title=$req->title;
        $exam->instructions=$req->instructions;
        $exam->course_id=$req->course_id;
        $exam->started_at=$req->started_at;
        $exam->ended_at=$req->ended_at;
        $exam->teacher_id=$teacher->id;
        $exam->save();
        
        return redirect(route("teacher.exam.index"))->with([
          "type"=>"success",
          "message"=>"Exam updated successfully"
      ]);

    }

    public function delete($id){
        $exam=Exam::where("teacher_id",Auth::id())->where("id",$id)->firstOrFail();
        $exam->delete();
        return redirect(route("teacher.exam.index"))->with([
          "type"=>"success",
          "message"=>"Exam deleted successfully"
      ]);
    }

    public function createQuestion($exam_id){
         $exam=Exam::where("teacher_id",Auth::id())->where("id",$exam_id)->firstOrFail();
        return view("teacher.exams.questions.create",compact("exam"));
    }
}
