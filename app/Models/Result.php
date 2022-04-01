<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $cast=["right_answers"=>"array","my_answers"=>"array"];
    public function exam(){
        return $this->belongsTo(Exam::class);
    }
    public function student(){
        return $this->belongsTo(Student::class);
    }
}
