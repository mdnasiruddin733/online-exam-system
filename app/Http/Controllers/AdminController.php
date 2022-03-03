<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Rules\InvalidCurrentPassword;

class AdminController extends Controller
{

    public function __construct(){
        $this->middleware("auth:admin");
    }
    public function index(){
        return view("admin.dashboard");
    }

    public function showProfile(){
        return view("admin.profile");
    }

    public function updateProfile(Request $req){
       $this->validate($req,[
           "name"=>"required",
           "email"=>"required|email",
           "phone"=>"required"
       ]);
    $admin=Admin::find(Auth::id());
      $admin->name=$req->name;
      $admin->email=$req->email;
      $admin->phone=$req->phone;
      $admin->save();
      return back()->with([
          "type"=>"success",
          "message"=>"Profile updated successfully"
      ]);
    }

    public function changeProfileImage(Request $req){
        $admin=Admin::find(Auth::id());
        if($req->image){
            $admin->image=upload($req->image,"profile-images",$admin->image);
            $admin->save();
        }

        return response()->json(["data"=>"Image updated successfully"]);
    }

    public function showChangePasswordForm(){
        return view("admin.change-password");
    }

    public function changePassword(Request $req){
        $this->validate($req,[
            "current_password"=>["required", new InvalidCurrentPassword()],
            "new_password"=>['required', 'string', 'min:6'],
            "password_confirmation"=>['required', 'string', 'min:6']
        ]);

        $admin=Admin::find(Auth::id());
        if($req->password_confirmation===$req->new_password){
            $admin->password=bcrypt($req->new_password);
            $admin->save();
        }else{
            return back()->with([
                "type"=>"error",
                "message"=>"Confrim password doesn't match"
            ]);
        }
        
       
        return redirect(route("admin.profile"))->with([
          "type"=>"success",
          "message"=>"Password changed successfully"
      ]);

    
    }
}
