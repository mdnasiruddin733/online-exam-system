<?php

namespace App\Imports;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class QuestionImport implements ToModel, WithHeadingRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */


    public function model(array $row)
    {   
        $corrects=explode(",",$row['correct_options']);
        
        $exam_id=Session::get("exam_id");
        $question=new Question();
        $question->text=$row["question"];
        $question->exam_id=$exam_id;
        $question->marks=$row['marks'];
        $question->negative_marks=$row['negative_marks'];
        $question->save();
        
        $option1=new Option();
        $option1->text=$row["option_1"];
        $option1->question_id=$question->id;
        if(in_array(1,$corrects)){
            $option1->correct=1;
        }
        $option1->save();

        $option2=new Option();
        $option2->text=$row["option_2"];
        $option2->question_id=$question->id;
        if(in_array(2,$corrects)){
            $option2->correct=1;
        }
        $option2->save();


        $option3=new Option();
        $option3->text=$row["option_3"];
        $option3->question_id=$question->id;
        if(in_array(3,$corrects)){
            $option3->correct=1;
        }
        $option3->save();

        $option4=new Option();
        $option4->text=$row["option_4"];
        $option4->question_id=$question->id;
        if(in_array(4,$corrects)){
            $option4->correct=1;
        }
        $option4->save();
        return $question;
    }
}
