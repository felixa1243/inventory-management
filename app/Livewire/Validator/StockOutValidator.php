<?php

namespace App\Livewire\Validator;

class StockOutValidator
{
    public static function rules($unitAbbreviation)
    {
        $rules = [
            'quantityAfter' => 'required|numeric|min:0.1|lte:rawQuantityBefore',
        ];
        if ($unitAbbreviation === 'pcs') {
            $rules['quantityAfter'] = 'required|integer|min:1|lte:rawQuantityBefore';
        }

        return $rules;
    }
}
