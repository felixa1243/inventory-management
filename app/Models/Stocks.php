<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stocks extends Model
{
    use HasFactory;
    protected $table = 'stocks';
    protected $fillable = [
        'product_id',
        'quantity',
    ];
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id', 'id');
    }
}
