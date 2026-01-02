<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'unit_id'
    ];
    public function stocks()
    {
        return $this->hasMany(Stocks::class, 'product_id', 'id');
    }
    public function unit()
    {
        return $this->hasOne(Units::class, 'id', 'unit_id');
    }
}
