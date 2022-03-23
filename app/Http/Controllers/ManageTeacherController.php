<?php

namespace App\Http\Controllers;

use App\Mail\TeacherCreated;
use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
class ManageTeacherController extends Controller
{
    public function index(){
        $teachers=Teacher::latest()->get();
        return view("admin.teachers.index",compact("teachers"));
    }
     public function create(){
        return view("admin.teachers.create");
    }

    public function store(Request $req){
         $this->validate($req, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:teachers'],
            "phone"=>["required","string"],
            "department_id"=>["required"]
        ]);
        $line=str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$");
        $password=substr($line,0,6);
        $teacher=Teacher::create([
            'name' => $req->name,
            'email' => $req->email,
            'phone' => $req->phone,
            'department_id' => $req->department_id,
            'password' => Hash::make($password),
        ]);
        $mail_data=[
            "name"=>$req->name,
            "email"=>$req->email,
            "password"=>$password,
            "url"=>url("/login/teacher")
        ];
        Mail::to($teacher)->send(new TeacherCreated($mail_data));
        return redirect(route("admin.teacher.create"))->with([
          "type"=>"success",
          "message"=>"Teacher created successfully"
      ]);
    }

    public function edit($id){
        $teacher=Teacher::findOrFail($id);
        return view("admin.teachers.edit",compact('teacher'));
    }

    public function update(Request $req){
        $this->validate($req,[
            "id"=>"required|exists:teachers,id",
            "name"=>"required|string|max:24",
            "email"=>"required|email",
            "phone"=>"required|max:14",
            "department_id"=>"required"
        ]);
        $teacher=Teacher::findOrFail($req->id);
        
        $teacher->name=$req->name;
        $teacher->email=$req->email;
        $teacher->phone=$req->phone;
        $teacher->department_id=$req->department_id;
        $teacher->save();
        return redirect(route("admin.teacher.index"))->with([
          "type"=>"success",
          "message"=>"Teacher updated successfully"
      ]);

    }

    public function delete($id){
        $teacher=Teacher::findOrFail($id);
        if($teacher->image!=="img/teacher.png" && file_exists($teacher->image)){
            unlink($teacher->image);
        }
        $teacher->delete();
        return redirect(route("admin.teacher.index"))->with([
          "type"=>"success",
          "message"=>"Teacher deleted successfully"
      ]);
    }
}
