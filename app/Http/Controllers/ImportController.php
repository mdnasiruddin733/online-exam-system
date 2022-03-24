<?php

namespace App\Http\Controllers;

use App\Imports\TeacherImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\StudentImport;

class ImportController extends Controller
{
   public function uploadTeacherExcell(){
       return view("admin.teachers.import");
   }

   public function importTeachers(Request $req){
       $this->validate($req,[
           "xl"=>"required|mimes:xls,xlsx,csv"
       ],[
           "xl.required"=>"This file is required",
           "xl.mimes"=>"File extension should be .xlsx or .xls or .csv"
       ]);

      $import=new TeacherImport();
      $import->import($req->file('xl'));
    
       if($import->failures()->isNotEmpty()){
        return back()->withFailures($import->failures());
       }
       return redirect(route('admin.teacher.index'))->with([
           "type"=>"success",
           "message"=>"All teachers imported successfully"
       ]);
   }

   public function uploadStudentExcell(){
       return view("admin.students.import");
   }

   public function importStudents(Request $req){
       $this->validate($req,[
           "xl"=>"required|mimes:xls,xlsx,csv"
       ],[
           "xl.required"=>"This file is required",
           "xl.mimes"=>"File extension should be .xlsx or .xls or .csv"
       ]);

      $import=new StudentImport();
      $import->import($req->file('xl'));
    
       if($import->failures()->isNotEmpty()){
        return back()->withFailures($import->failures());
       }
       return redirect(route('admin.student.index'))->with([
           "type"=>"success",
           "message"=>"All teachers imported successfully"
       ]);
   }
}
