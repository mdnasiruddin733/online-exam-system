<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends  Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded=[];
    protected $guard="student";
    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function courses(){
        return $this->belongsToMany(Course::class,"course_student");
    }
    public function hasCourse($course_id){
        return $this->courses->contains('id',$course_id);
    }

    public function exams(){
          return $this->belongsToMany(Exam::class,"exam_student");
    }
    public function hasGivenExam($exam_id){
        return $this->exams->contains('id',$exam_id);
    }
}
