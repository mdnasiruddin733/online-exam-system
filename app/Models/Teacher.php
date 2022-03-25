<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Teacher extends  Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded=[];
    protected $guard="teacher";
    public function department(){
        return $this->belongsTo(Department::class);
    }
    
    public function courses(){
        return $this->hasMany(Course::class);
    }

    public function exams(){
        return $this->hasMany(Exam::class);
    }
}
