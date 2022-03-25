<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Option;
class SingleQuestion extends Component
{
    public $question,$index,$option,$correct=0,$options=[];
    protected $rules=[
        "option"=>"required|string",
    ];

    public function updated($value)
    {
        $this->validateOnly($value,$this->rules);
    }
    public function render()
    {   
        return view('livewire.single-question');
    }

    public function  mount($question,$index){
        $this->question=$question;
        $this->index=$index;
        $this->options=$question->options;
    }

    public function submit(){
        $this->validate($this->rules);
        $option=new Option();
        $option->text=$this->option;
        $option->correct=$this->correct;
        $option->question_id=$this->question->id;
        $option->save();
        $this->options[]=$option;
        $this->reset(["option","correct"]);
    }
}
