<?php

namespace App\Livewire;

use App\Models\Products;
use Livewire\Component;

class CreateProduct extends Component
{
    public $name = '';
    public $price = 0;
    public $description = '';
    public function render()
    {
        return view('livewire.create-product');
    }
    public function createProduct()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);
        $product = new Products();
        $product->name = $this->name;
        $product->price = $this->price;
        $product->description = $this->description;
        $stocks = new \App\Models\Stocks();
        $stocks->product_id = $product->id;
        try {
            $product->save();
            $this->dispatch('productCreated');
            $this->reset(['name', 'price', 'description']);
        } catch (\Exception $e) {
            $this->dispatch('productNotCreated');
        }
    }
}
