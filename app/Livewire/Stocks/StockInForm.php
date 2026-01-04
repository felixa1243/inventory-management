<?php

namespace App\Livewire\Stocks;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Number;
use Livewire\Attributes\Computed;

class StockInForm extends Component
{
    // Public properties
    public $productID;
    public $name = '';
    public $price = '';
    public $quantityBefore = '';
    #[Validate]
    public $quantityAfter;
    public $unitAbbreviation;
    private $stockService;
    private $productService;
    public function boot()
    {
        $this->stockService = app()->make(\App\Services\StockService::class);
        $this->productService = app()->make(\App\Services\ProductService::class);
    }
    #[On('load-stock-info')]
    public function loadProduct($id)
    {
        $this->resetValidation();
        $this->productID = $id;
        $product = $this->productService->productWithUnits($id);
        $stock = $this->stockService->findByProductId($id)->first();

        if ($product) {
            $this->name = $product->name;
            $this->price = Number::format($product->price);
            $this->unitAbbreviation = $product->unit_abv;
        }

        if ($stock) {

            $this->quantityBefore = Number::format($stock->quantity);
        } else {
            $this->quantityBefore = '0';
        }
    }
    #[On('stockUpdated')]
    public function refresh()
    {
        $this->reset();
        $this->redirect(route('dashboard'));
    }
    #[Computed()]
    public function projectedStock()
    {
        $added = (float) $this->quantityAfter;
        $current = (float) $this->quantityBefore;

        return $current + $added;
    }
    public function rules()
    {
        return \App\Livewire\Validator\StockInValidator::rules($this->unitAbbreviation);
    }


    public function updateStockIn()
    {
        try {
            $this->stockService->addStock($this->productID, $this->quantityAfter);
            $this->dispatch('stockUpdated');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->dispatch('stockNotUpdated');
        }
    }

    public function render()
    {
        return view('livewire.stocks.stock-in-form');
    }
}
