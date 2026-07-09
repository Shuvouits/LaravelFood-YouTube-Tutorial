<?php

namespace App\Repositories;

use App\Models\Category;
use App\Traits\FileUploadTrait;
use Illuminate\Http\UploadedFile;

class CategoryRepository
{
    use FileUploadTrait;

    public function saveCategory(array $data, $photo = null)
    {
        unset($data['image']);

        if ($photo instanceof UploadedFile) {
            $data['image'] = $this->uploadFile($photo, 'category');
        }

        return Category::create($data);
    }

    public function updateCategory(array $data, $image = null, $id = null)
    {
        $category = Category::findOrFail($id);

        unset($data['image']);

        if ($image instanceof UploadedFile) {
            $data['image'] = $this->uploadFile($image, 'category', $category->image);
        }

        $category->update($data);

        return $category;
    }
}
