<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
class ExamController extends Controller
{
    public function index($course_id){
            $course=Course::findOrFail($course_id);
            return view("teacher.exams.index",compact('course'));
        }

        public function create($id){
            $course=Course::findOrFail($id);
            return view("teacher.exams.create",compact('course'));
        }

        public function store(Request $req){
            $this->validate($req,[
                "course_id"=>"required",
                "title"=>"required|string|max:100",
                "instructions"=>"required|string|max:500",
                "type"=>"required|string|max:5",
                "started_at"=>"required",
                "ended_at"=>"required",
            ]);
            $exam=new Exam();
            $exam->course_id=$req->course_id;
            $exam->title=$req->title;
            $exam->type=$req->type;
            $exam->instructions=$req->instructions;
            $exam->started_at=$req->started_at;
            $exam->ended_at=$req->ended_at;
            $exam->save();
            return redirect(route("teacher.exam.index",$req->course_id))->with([
            "type"=>"success",
            "message"=>"Exam created successfully"
        ]);
        }

        public function edit($id){
            $exam=Exam::findOrFail($id);
            return view("teacher.exams.edit",compact('exam'));
        }

        public function update(Request $req){
           $this->validate($req,[
                "exam_id"=>"required",
                "title"=>"required|string|max:100",
                "instructions"=>"required|string|max:500",
                "type"=>"required|string|max:5",
                "started_at"=>"required",
                "ended_at"=>"required",
            ]);
            $exam=Exam::findOrFail($req->exam_id);
            $exam->title=$req->title;
            $exam->type=$req->type;
            $exam->instructions=$req->instructions;
            $exam->started_at=$req->started_at;
            $exam->ended_at=$req->ended_at;
            $exam->save();
            
           return redirect(route("teacher.exam.index",$exam->course->id))->with([
            "type"=>"success",
            "message"=>"Exam updated successfully"
        ]);

        }

        public function delete($id){
            $exam=Exam::findOrFail($id);
            $exam->delete();
            return back()->with([
            "type"=>"success",
            "message"=>"Exam deleted successfully"
        ]);
        }

        public function showQuestions($exam_id){
            $exam=Exam::findOrFail($exam_id);
            if($exam->type=="mcq"){
                 return view("teacher.exams.questions",compact('exam'));
            }else{
                 return view("teacher..questions.show-cq",compact('exam'));
            }
           
        }

        public function showResult($exam_id){
            $exam=Exam::findOrFail($exam_id);
            return view("teacher.exams.result",compact('exam'));
            
        }
}
