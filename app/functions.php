<?php

use App\Models\Department;
use Illuminate\Support\Facades\Auth;
function guard(){
    if(Auth::guard('admin')->check())
        {return "admin";}
    elseif(Auth::guard('student')->check())
        {return "student";}
    elseif(Auth::guard('teacher')->check())
        {return "teacher";}
}


function upload($image,$folder,$prev_image=""){
    if(file_exists($prev_image)){
        unlink($prev_image);
    }
    $filename=uniqid(time()).".".$image->getClientOriginalExtension();
    $image->storeAs($folder,$filename,"public");
    return "storage/".$folder."/".$filename;
}


function departments(){
    return Department::latest()->get();
}
