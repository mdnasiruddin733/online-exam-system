<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function exam(){
        return $this->belongsTo(Exam::class);
    }

    public function student(){
       return $this->belongsTo(Student::class);
    }
}
