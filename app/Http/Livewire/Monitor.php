<?php

namespace App\Http\Livewire;

use App\Events\WarnEvent;
use App\Models\Check;
use Livewire\Component;

class Monitor extends Component
{

    public $exam,$monitors;

    protected $listeners=["studentLeftExam"];

    public function studentLeftExam(){
        $this->monitors=Check::where("exam_id",$this->exam->id)->latest()->get();
    }
    public function render()
    {
        return view('livewire.monitor');
    }
    public function mount($exam){
        $this->exam=$exam;
        $this->monitors=Check::where("exam_id",$this->exam->id)->latest()->get();
    }

    public function warn($student_id){
        event(new WarnEvent($student_id));
    }
}
