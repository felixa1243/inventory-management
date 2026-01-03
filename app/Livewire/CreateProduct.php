<?php

namespace App\Livewire;

use App\Models\Products;
use App\Models\Stocks;
use App\Models\Units;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateProduct extends Component
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|numeric|min:0')]
    public float $price = 0;

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('required|exists:units,id')]
    public int $unitID = 1;

    #[Title('Create Product')]
    public function render()
    {
        return view('livewire.create-product');
    }

    #[Computed]
    public function units()
    {
        return Units::all();
    }

    public function createProduct()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                $product = Products::create([
                    'name'        => $this->name,
                    'price'       => $this->price,
                    'description' => $this->description,
                    'unit_id'     => $this->unitID,
                ]);
                Stocks::create([
                    'product_id' => $product->id,
                    'quantity'   => 0,
                ]);
            });

            $this->dispatch('productCreated');
            $this->reset();
        } catch (\Exception $e) {

            Log::error($e->getMessage());
            $this->dispatch('productNotCreated');
        }
    }
}
