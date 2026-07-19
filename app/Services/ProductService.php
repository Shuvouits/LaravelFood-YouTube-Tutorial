<?php

namespace App\Services;

use App\Repositories\ProductRepository;

class ProductService
{


    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    public function saveProduct(array $data, $image=null)
    {
        return $this->productRepository->saveProduct($data, $image);

    }

    public function updateProduct(array $data, $image=null, $id)
    {
        return $this->productRepository->updateProduct($data, $image, $id);

    }


}
