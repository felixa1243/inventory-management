<?php

namespace App\Repositories;

interface IStockRepository
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function findByProductID($id);
    public function productsStocksAndUnits();
    public function addStock($productId, $quantity);
}
