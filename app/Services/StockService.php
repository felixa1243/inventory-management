<?php

namespace App\Services;

use App\Repositories\IStockRepository;

class StockService
{
    private $stockRepository;
    public function __construct(IStockRepository $stockRepository)
    {
        $this->stockRepository = $stockRepository;
    }
    public function find($id)
    {
        return $this->stockRepository->find($id);
    }
    public function create(array $data)
    {
        return $this->stockRepository->create($data);
    }
    public function delete($id)
    {
        return $this->stockRepository->delete($id);
    }
    public function all()
    {
        return $this->stockRepository->all();
    }
    public function findByProductId($id)
    {
        return $this->stockRepository->findByProductId($id);
    }
    public function productsStocksAndUnits()
    {
        return $this->stockRepository->productsStocksAndUnits();
    }
    public function addStock($productId, $quantity)
    {
        try {
            return $this->stockRepository->addStock($productId, $quantity);
        } catch (\Exception $e) {
            throw new \Exception();
        }
    }
    public function reduceStock($productId, $quantity)
    {
        try {
            return $this->stockRepository->reduceStock($productId, $quantity);
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage());
        }
    }
}
