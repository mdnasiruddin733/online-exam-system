<?php

namespace App\Http\Livewire;

use Livewire\Component;

class SingleOption extends Component
{
    public $index,$option;



    public function  mount($option,$index){
        $this->option=$option;
        $this->index=$index;
    }

    
    public function render()
    {
        return view('livewire.single-option');
    }

    public function delete(){
        
        $this->option->delete();
        $this->emitTo("single-question","optionRemoved");
        

    }
}
