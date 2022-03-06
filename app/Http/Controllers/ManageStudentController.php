<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;
use App\Mail\StudentCreated;
use Illuminate\Support\Facades\Mail;
class ManageStudentController extends Controller
{
    public function index(){
        $students=Student::latest()->get();
        return view("admin.students.index",compact("students"));
    }
     public function create(){
        return view("admin.students.create");
    }

    public function store(Request $req){
         $this->validate($req, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:students'],
            "phone"=>["required","string"],
            "roll"=>"required",
            "department_id"=>["required"]
        ]);
        $line=str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$");
        $password=substr($line,0,6);
        $student=Student::create([
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'department_id' => $req->department_id,
            'roll'=>"required",
            'password' => Hash::make($password),
        ]);
        $mail_data=[
            "name"=>$req->name,
            "email"=>$req->email,
            "password"=>$password,
            "url"=>url("/login/student")
        ];
        Mail::to($student)->send(new StudentCreated($mail_data));
        return redirect(route("admin.student.create"))->with([
          "type"=>"success",
          "message"=>"Student created successfully"
      ]);
    }

    public function edit($id){
        $student=Student::findOrFail($id);
        return view("admin.students.edit",compact('student'));
    }

    public function update(Request $req){
        $this->validate($req,[
            "id"=>"required|exists:students,id",
            "name"=>"required|string|max:24",
            "email"=>"required|email",
            "phone"=>"required|max:14",
            "department_id"=>"required",
            'roll'=>"required",
        ]);
        $student=Student::findOrFail($req->id);
        
        $student->name=$req->name;
        $student->email=$req->email;
        $student->phone=$req->phone;
        $student->department_id=$req->department_id;
        $student->roll=$req->roll;
        $student->save();
        return redirect(route("admin.student.index"))->with([
          "type"=>"success",
          "message"=>"Student updated successfully"
      ]);

    }

    public function delete($id){
        $student=Student::findOrFail($id);
        if($student->image!=="img/student.png" && file_exists($student->image)){
            unlink($student->image);
        }
        $student->delete();
        return redirect(route("admin.student.index"))->with([
          "type"=>"success",
          "message"=>"Student deleted successfully"
      ]);
    }
}
