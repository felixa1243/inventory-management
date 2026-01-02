<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class Products extends Component
{
    #[Computed()]
    public function products()
    {
        return \App\Models\Products::select(
            'products.*',
            'units.abbreviation as unit_abv',
        )
            ->join('units', 'products.unit_id', '=', 'units.id')
            ->paginate(15);
    }

    public function render()
    {
        return view('livewire.products');
    }
}
