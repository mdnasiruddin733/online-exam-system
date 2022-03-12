<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function index($exam_id){
        $exam=Exam::findOrFail($exam_id);
        if($exam->type=="mcq"){
              return view("teacher.questions.index",compact('exam'));
        }else{
            return view("teacher.questions.create-cq",compact('exam'));
        }
      
    }

    public function store(Request $req){
        $this->validate($req,[
            "exam_id"=>"required",
            "question"=>"required",
            "option_1"=>"required",
            "option_2"=>"required",
            "option_3"=>"required",
            "option_4"=>"required",
            "answer"=>"required",
            "marks"=>"required"
        ]);
        $question=new Question();
        $question->exam_id=$req->exam_id;
        $question->question=$req->question;
        $question->option_1=$req->option_1;
        $question->option_2=$req->option_2;
        $question->option_3=$req->option_3;
        $question->option_4=$req->option_4;
        $question->answer=$req->answer;
        $question->marks=$req->marks;
        $question->save();
        return back()->with([
            "type"=>"success",
            "message"=>"Question added successfully"
        ]);
    }

    public function edit($id){
        $question=Question::findOrFail($id);
        return view("teacher.questions.edit",compact('question'));
    }

    public function update(Request $req){
        $this->validate($req,[
            "question_id"=>"required",
            "question"=>"required",
            "option_1"=>"required",
            "option_2"=>"required",
            "option_3"=>"required",
            "option_4"=>"required",
            "answer"=>"required",
            "marks"=>"required"
        ]);
        $question=Question::findOrFail($req->question_id);
        $question->question=$req->question;
        $question->option_1=$req->option_1;
        $question->option_2=$req->option_2;
        $question->option_3=$req->option_3;
        $question->option_4=$req->option_4;
        $question->answer=$req->answer;
        $question->marks=$req->marks;
        $question->save();
        return back()->with([
            "type"=>"success",
            "message"=>"Question updated successfully"
        ]);
    }

    public function delete($id){
        $question=Question::findOrFail($id);
        $question->delete();
        return back()->with([
            "type"=>"success",
            "message"=>"Question deleted successfully"
        ]);
    }
}
