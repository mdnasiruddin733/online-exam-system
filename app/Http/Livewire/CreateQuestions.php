<?php

namespace App\Http\Livewire;

use App\Models\Question;
use Livewire\Component;

class CreateQuestions extends Component
{
    public $text="",$marks=1,$negative_marks=0,$exam_id;
    public $questions;
    protected $rules=[
        "text"=>"required|string",
        "marks"=>"required",
        "negative_marks"=>"required"
    ];

    public function updated($value)
    {
        $this->validateOnly($value,$this->rules);
    }

    public function mount($exam_id){
        $this->exam_id=$exam_id;
        $this->questions=Question::where("exam_id",$exam_id)->get();
    }
    public function render()
    {
        return view('livewire.create-questions');
    }

    public function submit(){
        $this->validate($this->rules);
        $question=new Question();
        $question->exam_id=$this->exam_id;
        $question->text=$this->text;
        $question->marks=$this->marks;
        $question->negative_marks=$this->negative_marks;
        $question->save();
        $this->questions[]=$question;
        $this->reset(["text","marks","negative_marks"]);

    }
}
