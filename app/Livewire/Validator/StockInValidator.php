<?php

namespace App\Livewire\Validator;

class StockInValidator
{
    public static function rules($unitAbbreviation)
    {
        $rules = [
            'quantityAfter' => 'required|numeric|min:0.1',
        ];
        if ($unitAbbreviation === 'pcs') {
            $rules['quantityAfter'] = 'required|integer|min:1';
        }

        return $rules;
    }
}
