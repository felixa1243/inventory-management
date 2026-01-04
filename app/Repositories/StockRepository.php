<?php

namespace App\Repositories;

use App\Models\Products;
use App\Models\Stocks;
use Illuminate\Support\Facades\DB;

class StockRepository implements IStockRepository
{
    public function all()
    {
        return Stocks::all();
    }
    public function find($id)
    {
        return Stocks::find($id);
    }
    public function create(array $data)
    {
        return Stocks::create($data);
    }
    public function update($id, array $data)
    {
        return Stocks::where('id', $id)->update($data);
    }
    public function delete($id)
    {
        return Stocks::where('id', $id)->delete();
    }
    public function findByProductId($id)
    {
        return Stocks::where('product_id', $id);
    }
    public function productsStocksAndUnits()
    {
        return Stocks::select('stocks.*', 'products.*', 'units.abbreviation as unit_abv')->join('products', 'stocks.product_id', '=', 'products.id')->join('units', 'products.unit_id', '=', 'units.id');
    }
    public function addStock($productId, $quantity)
    {
        $stock = $this->findByProductId($productId);
        if ($stock) {
            DB::transaction(function () use ($stock, $quantity) {
                $stock = $stock->lockForUpdate()->first();
                $stock->increment('quantity', $quantity);
            });
        } else {
            throw new \Exception('Product not found');
        }
    }
    public function reduceStock($productId, $quantity)
    {
        $stock = $this->findByProductId($productId);
        if ($stock) {
            DB::transaction(function () use ($stock, $quantity) {
                $stock = $stock->lockForUpdate()->first();
                if ($stock->quantity - $quantity < 0) throw new \Exception('Stock cannot be below 0');
                $stock->decrement('quantity', $quantity);
            });
        } else {
            throw new \Exception('Product not found');
        }
    }
}
