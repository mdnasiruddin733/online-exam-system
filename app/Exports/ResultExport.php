<?php

namespace App\Exports;

use App\Models\Result;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class ResultExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected  $results;
    function __construct($exam_id)
    {
        $this->results=Result::where("exam_id",$exam_id)->orderBy("marks","desc")->get();
    }
   public function view(): View
   {
       return view("teacher.exams.result-table",[
            "results"=>$this->results
       ]);
   }

}
