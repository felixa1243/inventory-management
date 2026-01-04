<?php

namespace App\Livewire\Stocks;

use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Number;
use Livewire\Attributes\Computed;

class StockOutForm extends Component
{

    public $productID;
    public $name = '';
    public $price = '';

    public $quantityBefore = '';
    public $rawQuantityBefore = 0;

    #[Validate]
    public $quantityAfter;
    public $unitAbbreviation = '';
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
            $this->rawQuantityBefore = $stock->quantity;
        } else {
            $this->quantityBefore = '0';
            $this->rawQuantityBefore = 0;
        }
    }


    #[Computed()]
    public function projectedStock()
    {

        $reduced = (float) $this->quantityAfter;
        $current = (float) $this->rawQuantityBefore;

        return $current - $reduced;
    }

    public function rules()
    {
        return \App\Livewire\Validator\StockOutValidator::rules($this->unitAbbreviation);
    }

    public function messages()
    {
        return [
            'quantityAfter.lte' => 'The reduction amount cannot be greater than the current stock.',
        ];
    }

    public function updateStockIn()
    {
        $this->validate(); // This now runs the checks above

        try {
            // ... existing logic ...
            $this->stockService->reduceStock($this->productID, $this->quantityAfter);
            $this->dispatch('stockUpdated');
        } catch (\Exception $e) {
            // This catch is now a fallback, the validation above handles the main check
            if ($e->getMessage() == 'Stock cannot be below 0') {
                $this->addError('quantityAfter', 'Stock cannot be below 0'); // Add error to field
            }
            Log::error($e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.stocks.stock-out-form');
    }
}
