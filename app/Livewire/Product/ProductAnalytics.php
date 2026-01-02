<?php

namespace App\Livewire\Product;

use Livewire\Attributes\Computed;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ProductAnalytics extends Component
{
    #[Computed()]
    public function productCounts()
    {
        return \App\Models\Products::count();
    }
    #[Computed()]
    public function productValueSum()
    {
        $totalValue = \App\Models\Stocks::rightJoin('products', 'stocks.product_id', '=', 'products.id')
            ->selectRaw('SUM(COALESCE(stocks.quantity, 0) * products.price) as total_value')
            ->first()
            ->total_value;
        return $totalValue;
    }
    #[Computed()]
    public function topPriceProduct()
    {
        return \App\Models\Products::orderBy('price', 'desc')->first()->price;
    }
    public function render()
    {
        return view('livewire.product.product-analytics');
    }
}
