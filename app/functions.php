<?php

use App\Models\Department;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Carbon;
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

function countStudents(){
    return Student::count();
}

function countTeachers(){
    return Teacher::count();
}

function countDepartments(){
    return Department::count();
}


function timeDiff($start,$end){
    $start= Carbon::parse($start);
    $end= Carbon::parse($end);
    return $end->diffInMinutes($start); 
}


function fullmarks($exam){
    $marks=0.0;
    foreach($exam->questions as $key=>$question){
        $marks+=$question->marks;
    }

    return $marks;
}


function timeRemains($end){
     $start= Carbon::parse(now());
     $end= Carbon::parse($end);
    return $end->diffInSeconds($start)*1000; 
}
