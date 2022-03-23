<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Teacher;
use Illuminate\Support\Facades\Auth;
use App\Rules\InvalidCurrentPassword;
class TeacherController extends Controller
{

    public function __construct()
    {
       $this->middleware("auth:teacher");
    
    }
    public function index(){
        return view("teacher.dashboard");
    }

    public function showProfile(){
        return view("teacher.profile");
    }
    public function updateProfile(Request $req){
       $this->validate($req,[
           "name"=>"required",
           "email"=>"required|email",
           "phone"=>"required"
       ]);
     $teacher=Teacher::find(Auth::id());
      $teacher->name=$req->name;
      $teacher->email=$req->email;
      $teacher->phone=$req->phone;
      $teacher->save();
      return back()->with([
          "type"=>"success",
          "message"=>"Profile updated successfully"
      ]);
    }
    public function changeProfileImage(Request $req){
        $teacher=Teacher::find(Auth::id());
        if($req->image){
            if($teacher->image==="img/teacher.png"){
                 $teacher->image=upload($req->image,"profile-images");
            }else{
                 $teacher->image=upload($req->image,"profile-images",$teacher->image);
            }
           
            $teacher->save();
        }

        return response()->json(["data"=>"Image updated successfully"]);
    }

    public function showChangePasswordForm(){
        return view("teacher.change-password");
    }

    public function changePassword(Request $req){
        $this->validate($req,[
            "current_password"=>["required", new InvalidCurrentPassword()],
            "new_password"=>['required', 'string', 'min:6'],
            "password_confirmation"=>['required', 'string', 'min:6']
        ]);

        $teacher=Teacher::find(Auth::id());
        if($req->password_confirmation===$req->new_password){
            $teacher->password=bcrypt($req->new_password);
            $teacher->save();
            return back()->with([
                "type"=>"success",
                "message"=>"Password changed successfully"
            ]);
        }else{
            return back()->with([
                "type"=>"error",
                "message"=>"Confrim password doesn't match"
            ]);
        }
        
       
        return redirect(route("teacher.profile"))->with([
          "type"=>"success",
          "message"=>"Password changed successfully"
      ]);

    
    }
}
