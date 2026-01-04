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
    // ... existing properties ...
    public $productID;
    public $name = '';
    public $price = '';

    // Display value (formatted)
    public $quantityBefore = '';

    // Add this: Validation value (unformatted)
    public $rawQuantityBefore = 0;

    #[Validate]
    public $quantityAfter;
    public $unitAbbreviation = '';

    // ... services ...
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
        $product = $this->productService->productsWithUnits()->find($id)->first();
        $stock = $this->stockService->findByProductId($id)->first();

        if ($product) {
            $this->name = $product->name;
            $this->price = Number::format($product->price);
            $this->unitAbbreviation = $product->unit_abv;
        }

        if ($stock) {
            // Store the display version
            $this->quantityBefore = Number::format($stock->quantity);
            // Store the raw version for math/validation
            $this->rawQuantityBefore = $stock->quantity;
        } else {
            $this->quantityBefore = '0';
            $this->rawQuantityBefore = 0;
        }
    }

    // ... refresh method ...

    #[Computed()]
    public function projectedStock()
    {
        // Use rawQuantityBefore for accurate math
        $reduced = (float) $this->quantityAfter;
        $current = (float) $this->rawQuantityBefore;

        return $current - $reduced;
    }

    public function rules()
    {
        return \App\Livewire\Validator\StockOutValidator::rules($this->unitAbbreviation);
    }

    // Custom messages to make the error user-friendly
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
