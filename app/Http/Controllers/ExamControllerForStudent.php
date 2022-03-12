<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExamControllerForStudent extends Controller
{
  public function participate($exam_id){
      $exam=Exam::findOrFail($exam_id);
      if(Student::find(Auth::id())->hasCourse($exam->course_id)){
        return view("student.exams.participate",compact('exam'));
      }else{
          abort(404);
      }
  }

  public function submit(Request $req){
  
    $this->validate($req,[
      "exam_id"=>"required"
    ]);
    $exam=Exam::findOrFail($req->exam_id);
    $student=Student::find(Auth::id());

    if(!$student->hasGivenExam($exam->id)){
      $rules=[];
    $messages=[];
    foreach($exam->questions as $question){
      $rules["answers.".$question->id]="required";
      $messages["answers.".$question->id.".required"]="You must answer this question";
    }
    $this->validate($req,$rules,$messages);
    $score=0;
    foreach($req->answers as $key=>$answer){
       $question=Question::findOrFail($key);
       if($question->answer==$answer){
         $score+=$question->marks;
       };
    }
  
    
    $student->exams()->attach($exam,[
      "marks"=>$score,
      "answers"=>json_encode($req->answers,true),
      "submitted_at"=>now()
    ]);
    return redirect(route("student.exam.view-result",$exam->id));

   } else{
    return redirect(route("student.exam.view-result",$exam->id));
   }
    
  }

  public function viewResult($exam_id){
    $student=Student::find(Auth::id());
    if($student->hasGivenExam($exam_id)){
      $exam=Exam::findOrFail($exam_id);
      $details=DB::table("exam_student")->where("exam_id",$exam_id)->where("student_id",Auth::id())->get();
      return view("student.exams.marks",compact("details","exam"));
    }else{
      abort(404);
    }
    
  }
}
