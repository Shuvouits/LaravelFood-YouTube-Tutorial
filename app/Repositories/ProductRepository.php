<?php


namespace App\Repositories;

use App\Models\Product;
use App\Traits\FileUploadTrait; // Import the FileUploadTrait

class ProductRepository
{
    use FileUploadTrait; // Use the FileUploadTrait



    public function saveProduct($data, $image)
    {
       $product = new Product();

         // Handle file uploads manually
        if ($image) {
            $data['image'] = $this->uploadFile($image, 'product', $product->image);
        }


        // Save the intro
        $product->create($data);

        return $product;
    }

    public function updateProduct($data, $image, $id)
    {
       $product = Product::find($id);

        // Handle file uploads manually
        if ($image) {
             $data['image'] = $this->uploadFile($image, 'product', $product->image);
        }


        $product->update($data);

        return $product;
    }
}
