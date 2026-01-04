<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class Settings extends Component
{
    #[Computed()]
    public function units()
    {
        return \App\Models\Units::all();
    }

    #[Title('Settings')]
    public function render()
    {
        return view('livewire.settings');
    }
}
