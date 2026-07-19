<?php


namespace App\Repositories;

use App\Models\AboutUs;
use App\Models\Advertise;
use App\Models\ImageGallery;
use App\Traits\FileUploadTrait; // Import the FileUploadTrait

class GalleryRepository
{
    use FileUploadTrait; // Use the FileUploadTrait



    public function updateGallery($data, $files)
    {


        // new gallery object (not mandatory, but okay to return)
        $gallery = new ImageGallery();

        // multiple file upload check
        if (!empty($files['images'])) {
            foreach ($files['images'] as $file) {
                $imagePath = $this->uploadFile($file, 'gallery');

                ImageGallery::create([
                    'product_id' => $data['product_id'],
                    'image'      => $imagePath,
                ]);
            }
        }

        return $gallery;


    }
}
