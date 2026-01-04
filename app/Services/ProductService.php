<?php

namespace App\Services;

use App\Repositories\IProductRepository;
use Illuminate\Support\Facades\DB;

class ProductService
{
    private $productRepository;
    private $stockService;
    public function __construct(IProductRepository $productRepository, StockService $stockService)
    {
        $this->stockService = $stockService;
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        return $this->productRepository->all();
    }
    public function find($id)
    {
        return $this->productRepository->find($id);
    }
    public function create(array $data)
    {
        try {
            DB::transaction(function () use ($data) {
                $product = $this->productRepository->create($data);
                $this->stockService->create([
                    'product_id' => $product->id,
                    'quantity'   => 0,
                ]);
            });
        } catch (\Exception $e) {
            throw new \Exception('Product not created');
        }
        return $this->productRepository->create($data);
    }
    public function update($id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }
    public function delete($id)
    {
        DB::transaction(function () use ($id) {
            $stock = $this->stockService->findByProductId($id)->first();
            if ($stock) {
                $this->stockService->delete($stock->id);
            }
            return $this->productRepository->delete($id);
        });
    }
    public function productsWithUnits()
    {
        return $this->productRepository->productsWithUnits();
    }
}
