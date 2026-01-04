<?php

namespace App\Livewire;

use Livewire\Attributes\Computed;
use Livewire\Component;

class Products extends Component
{
    private $stockService;
    public function boot()
    {
        $this->stockService = app()->make(\App\Services\StockService::class);
    }
    #[Computed()]
    public function products()
    {
        return $this->stockService->productsStocksAndUnits()->paginate(15);
    }

    public function render()
    {
        return view('livewire.products');
    }
}
