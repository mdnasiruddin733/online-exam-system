<?php

namespace App\Http\Controllers;

use App\Exports\ResultExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Exam;
use App\Models\Result;
use Maatwebsite\Excel\Facades\Excel;

class ResultController extends Controller
{
    public function viewResult($exam_id){
        $exam=Exam::where("teacher_id",Auth::id())->where("id",$exam_id)->firstOrFail();
        return view("teacher.exams.result",compact('exam'));
    }

    public function resultDetails($result_id,$rank){
        $result=Result::findOrFail($result_id);
        if($result->exam->course->teacher->id==Auth::id()){
            return view("teacher.exams.result-details",compact("result","rank"));
        }else{
            abort(403);
        }
        
    }

    public function exportResult($exam_id){
        $exam=Exam::where("teacher_id",Auth::id())->where("id",$exam_id)->firstOrFail();
        return Excel::download(new ResultExport($exam_id),"result.xlsx");
    }

    public function monitorExam($exam_id){
        $exam=Exam::where("teacher_id",Auth::id())->where("id",$exam_id)->firstOrFail();
        return view("teacher.exams.monitor",compact('exam'));
    }
}
