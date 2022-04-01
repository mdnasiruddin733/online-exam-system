<?php

namespace App\Http\Controllers;

use App\Events\ResultEvent;
use App\Models\Course;
use App\Models\Exam;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use Illuminate\Support\ItemNotFoundException;
use Illuminate\Http\Request;
use App\Models\Result;

class StudentExamController extends Controller
{
    public function index($course_id){
        $student=Student::find(Auth::id());
        try {
            $course=$student->courses->where("id",$course_id)->firstOrFail();
            return view("student.courses.exams",compact('course'));
        } catch (ItemNotFoundException $ex) {
           abort(404);
        }
        
        
        
    }

    public function participate($exam_id){
        $exam=Exam::findOrFail($exam_id);
        $result=Auth::user()->results->where("exam_id",$exam_id)->first();
        if($result){
              return redirect(route("student.exam.result",$exam_id));
        }
        if(strtotime($exam->started_at) < strtotime(now()) && strtotime(now()) < strtotime($exam->ended_at)){
            return view("student.courses.exam-page",compact('exam'));
        }else {
            abort(403);
        }
        
    }

    public function submit(Request $req){

        $exam=Exam::findOrFail($req->exam_id);
        $result=Auth::user()->results->where("exam_id",$req->exam_id)->first();
        if($result){
             return view("student.courses.result",compact('result'));
        }
        
        $rules=[
             "exam_id"=>"required",
        ];
        $messages=[];

        $exam=Exam::find($req->exam_id);
        
        foreach($exam->questions as $question){
            $rules["questions.".$question->id]="required";
            $messages["questions.".$question->id.".required"]="You must answer this question";
        }
        $this->validate($req,$rules,$messages);


        // Submitting answers
        $answers=$req->questions;
        $right_answers=[];
        $marks=0;
        $questions=$exam->questions;
        foreach($questions as $question){
            $answer_array=$answers[$question->id];
            $correct_answers=$question->options->where("correct",1)->pluck("id")->toArray();
            $right_answers[$question->id]=$correct_answers;
            if($answer_array==$correct_answers){
               $marks+=$question->marks;
            }else{
                $marks-=$question->negative_marks;
            }
        }


        if(strtotime($exam->started_at) < strtotime(now()) && strtotime(now()) < strtotime($exam->ended_at)){
            $result=new Result();
            $result->exam_id=$req->exam_id;
            $result->student_id=Auth::id();
            $result->marks=$marks>0 ? $marks:0;
            $result->my_answers=json_encode($answers);
            $result->right_answers=json_encode($right_answers);
            $result->created_at=now();
            $result->save();
            return redirect(route("student.exam.result",$req->exam_id));
        }else {
            abort(403);
        }
        
        
       
    }

    public function result($exam_id){
        $exam=Exam::findOrFail($exam_id);
        $result=Auth::user()->results->where("exam_id",$exam_id)->first();
        if($result){
             return view("student.courses.result",compact('result'));
        }else{
            return back();
        }
    }
}
