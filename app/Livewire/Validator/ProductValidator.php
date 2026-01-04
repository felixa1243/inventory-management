<?php

namespace App\Livewire\Validator;

class ProductValidator
{
    public static function rules()
    {
        return [
            'name' => 'required|string|min:3|max:255|unique:products,name',
            'description' => 'required|string|min:3|max:1000',
            'unit_id' => 'required|exists:units,id',
            'price' => 'required|numeric|min:0',
        ];
    }
}
