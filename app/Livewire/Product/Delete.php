<?php

namespace App\Livewire\Product;

use Illuminate\Support\Number;
use Livewire\Attributes\On;
use Livewire\Component;

class Delete extends Component
{
    public $productID;
    public $name;
    public $price;
    public $unitAbbreviation;
    public $quantityBefore;
    private $productService;
    public function boot()
    {
        $this->productService = app()->make(\App\Services\ProductService::class);
    }
    public function render()
    {
        return view('livewire.product.delete');
    }
    #[On('load-stock-info')]
    public function loadProduct($id)
    {
        $this->resetValidation();
        $this->productID = $id;
        $product = $this->productService->productsWithUnits()->find($id)->first();

        if ($product) {
            $this->name = $product->name;
            $this->price = Number::format($product->price);
            $this->unitAbbreviation = $product->unit_abv;
        }
    }
    #[On('deleteProductDeleted')]
    public function refresh()
    {
        $this->redirect(route('dashboard'));
    }
    public function deleteProduct()
    {
        try {
            $this->productService->delete($this->productID);
            $this->dispatch('productDeleted');
        } catch (\Exception $e) {
            $this->dispatch('productNotDeleted');
        }
    }
}
