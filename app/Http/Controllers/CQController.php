<?php

namespace App\Http\Controllers;

use App\Models\CQ;
use App\Models\Exam;
use Illuminate\Http\Request;

class CQController extends Controller
{
    public function store(Request $req){
        $this->validate($req,[
            "exam_id"=>"required",
            "marks"=>"required",
            "question"=>"required|mimes:pdf|max:104800"
        ]);
        $exam=Exam::findOrFail($req->exam_id);
        $cq=new CQ();
        $cq->exam_id=$req->exam_id;
        $cq->marks=$req->marks;
        if($req->question){
            $cq->file=upload($req->question,"questions");
        }
        $cq->save();

        return redirect(route("teacher.exam.index",$exam->course->id))->with([
            "type"=>"success",
            "message"=>"Question created successfully"
        ]);;
        
    }

    public function edit($exam_id){
        $exam=Exam::findOrFail($exam_id);
        return view("teacher.questions.cq-edit",compact("exam"));
    }

    public function update(Request $req){
        $this->validate($req,[
            "exam_id"=>"required",
            "marks"=>"required",
            "question"=>"nullable|mimes:pdf|max:104800"
        ]);
        $exam=Exam::findOrFail($req->exam_id);
        $cq=CQ::find($exam->cq->id);
        $cq->exam_id=$req->exam_id;
        $cq->marks=$req->marks;
        if($req->question){
            $cq->file=upload($req->question,"questions", $cq->file);
        }
        $cq->save();

        return redirect(route("teacher.exam.index",$exam->course->id))->with([
            "type"=>"success",
            "message"=>"Question updated successfully"
        ]);
        
    }

    public function delete($exam_id){
        $exam=Exam::findOrFail($exam_id);
        if(file_exists($exam->cq->file)){
            unlink($exam->cq->file);
        }
        $cq=CQ::find($exam->cq->id);
        $cq->delete();
        return redirect(route("teacher.exam.index",$exam->course->id))->with([
            "type"=>"success",
            "message"=>"Question deleted successfully"
        ]);
    }
}
