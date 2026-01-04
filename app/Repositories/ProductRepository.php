<?php

namespace App\Repositories;

use App\Models\Products;

class ProductRepository implements IProductRepository
{
    public function all()
    {
        return Products::all();
    }

    public function find($id)
    {
        return Products::find($id);
    }

    public function create(array $data)
    {
        return Products::create($data);
    }

    public function update($id, array $data)
    {
        return Products::where('id', $id)->update($data);
    }

    public function delete($id)
    {
        return Products::where('id', $id)->delete();
    }
    public function productsWithUnits()
    {
        return Products::select('products.*', 'units.abbreviation as unit_abv')->join('units', 'products.unit_id', '=', 'units.id');
    }
}
