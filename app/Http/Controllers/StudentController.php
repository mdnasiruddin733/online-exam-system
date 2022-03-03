<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Rules\InvalidCurrentPassword;
use Illuminate\Support\Facades\Auth;
class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth:student");
    
    }
    public function index(){
        return view("student.dashboard");
    }

    
    public function showProfile(){
        return view("student.profile");
    }

    public function updateProfile(Request $req){
       $this->validate($req,[
           "name"=>"required",
           "email"=>"required|email",
           "phone"=>"required"
       ]);
    $student=Student::find(Auth::id());
      $student->name=$req->name;
      $student->email=$req->email;
      $student->phone=$req->phone;
      $student->save();
      return back()->with([
          "type"=>"success",
          "message"=>"Profile updated successfully"
      ]);
    }

    public function changeProfileImage(Request $req){
        $student=Student::find(Auth::id());
        if($req->image){
            $student->image=upload($req->image,"profile-images",$student->image);
            $student->save();
        }

        return response()->json(["data"=>"Image updated successfully"]);
    }

    public function showChangePasswordForm(){
        return view("student.change-password");
    }

    public function changePassword(Request $req){
        $this->validate($req,[
            "current_password"=>["required", new InvalidCurrentPassword()],
            "new_password"=>['required', 'string', 'min:6'],
            "password_confirmation"=>['required', 'string', 'min:6']
        ]);

        $student=Student::find(Auth::id());
        if($req->password_confirmation===$req->new_password){
            $student->password=bcrypt($req->new_password);
            $student->save();
        }else{
            return back()->with([
                "type"=>"error",
                "message"=>"Confrim password doesn't match"
            ]);
        }
        
       
        return redirect(route("student.profile"))->with([
          "type"=>"success",
          "message"=>"Password changed successfully"
      ]);

    
    }
}
