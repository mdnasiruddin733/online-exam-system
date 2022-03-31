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
        return $this->belongsToMany(Course::class);
    }

    public function results(){
        return $this->hasMany(Result::class);
    }

    
}
