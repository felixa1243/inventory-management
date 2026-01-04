<?php

namespace App\Livewire;

use App\Models\Units;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

class CreateProduct extends Component
{
    public string $name = '';
    public float $price = 0;
    public string $description = '';
    public int $unit_id = 1;

    #[Title('Create Product')]
    public function render()
    {
        return view('livewire.create-product');
    }
    private $productService;
    public function boot()
    {
        $this->productService = app()->make(\App\Services\ProductService::class);
    }
    #[Computed]
    public function units()
    {
        return Units::all();
    }
    public function rules()
    {
        return \App\Livewire\Validator\ProductValidator::rules();
    }
    public function createProduct()
    {
        $this->validate();

        try {
            $this->productService->create([
                'name' => $this->name,
                'price' => $this->price,
                'description' => $this->description,
                'unit_id' => $this->unit_id
            ]);
            $this->dispatch('productCreated');
            $this->reset();
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            $this->dispatch('productNotCreated');
        }
    }
}
