<?php

namespace App\Http\Controllers;

use App\Events\ExamLeftEvent;
use App\Models\Check;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CheckController extends Controller
{
   public function check(Request $req){
       $check=Check::where("student_id",Auth::id())->first();
       if(!$check){
            $check=new Check();
            $check->exam_id=$req->exam_id;
            $check->student_id=Auth::id();
            $check->count=1;
            $check->created_at=now();
            $check->save();
            event(new ExamLeftEvent($check->exam->teacher->id));
       }else{
            $check->exam_id=$req->exam_id;
            $check->student_id=Auth::id();
            $check->count=$check->count+1;
            $check->created_at=now();
            $check->save();
          event(new ExamLeftEvent($check->exam->teacher->id));   
       }

       return response()->json(["count"=>$check->count]);
       
      
       
       
   }
}
