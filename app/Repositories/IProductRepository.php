<?php

namespace App\Repositories;

interface IProductRepository
{
    public function all();
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function productsWithUnits();
    public function productWithId($id);
}
