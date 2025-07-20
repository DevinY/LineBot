<?php

namespace Deviny\LineBot\Livewire;

use Livewire\Component;

class RichMenu extends Component
{
    public $count = 1;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }

    public function render()
    {
        return view('livewire::rich-menu');
        //return view('livewire.counter');
    }
}
