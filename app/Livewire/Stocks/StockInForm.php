<?php

namespace App\Livewire\Stocks;

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Illuminate\Support\Number;
use Illuminate\Support\Facades\DB;
use App\Models\Products;
use App\Models\Stocks;
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
    public $unitAbbreviation = '';

    #[On('load-stock-info')]
    public function loadProduct($id)
    {
        $this->resetValidation();
        $this->productID = $id;
        $product = Products::find($id);
        $stock = Stocks::where('product_id', $id)->first();

        if ($product) {
            $this->name = $product->name;
            $this->price = Number::format($product->price);

            $unit = DB::table('units')
                ->join('products', 'units.id', '=', 'products.unit_id')
                ->where('products.id', $id)
                ->value('abbreviation');

            $this->unitAbbreviation = $unit;
        }

        if ($stock) {

            $this->quantityBefore = Number::format($stock->quantity);
        } else {
            $this->quantityBefore = '0';
        }
    }
    #[Computed()]
    public function projectedStock()
    {
        // Cast to float to ensure math works, treat empty input as 0
        $added = (float) $this->quantityAfter;
        $current = (float) $this->quantityBefore;

        return $current + $added;
    }
    public function rules()
    {
        $rules = [
            'quantityAfter' => 'required|numeric|min:0.1',
        ];
        if ($this->unitAbbreviation === 'pcs') {
            $rules['quantityAfter'] = 'required|integer|min:1';
        }

        return $rules;
    }


    public function updateStockIn()
    {
        $this->validate();

        DB::transaction(function () {
            $stock = Stocks::where('product_id', $this->productID)->lockForUpdate()->first();

            if ($stock) {
                $stock->increment('quantity', $this->quantityAfter);
            }
        });
    }

    public function render()
    {
        return view('livewire.stocks.stock-in-form');
    }
}
