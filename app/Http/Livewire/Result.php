<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Result as ModelResult;
class Result extends Component
{
    public $exam,$results;
    protected $listeners=["newSubmission"];


    public function newSubmission(){
        $this->results=ModelResult::where("exam_id",$this->exam->id)->orderBy("marks","desc")->get();
    }
    public function render()
    {
        return view('livewire.result');
    }

    public function mount($exam){
        $this->exam=$exam;
        $this->results=ModelResult::where("exam_id",$exam->id)->orderBy("marks","desc")->get();
    }
}
