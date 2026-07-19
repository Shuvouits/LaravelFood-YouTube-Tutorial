<?php

namespace App\Services;

use App\Repositories\GalleryRepository;

class GalleryService
{


    protected $galleryRepository;

    public function __construct(GalleryRepository $galleryRepository)
    {
        $this->galleryRepository = $galleryRepository;
    }


    public function updateGallery(array $data, array $files)
    {
        return $this->galleryRepository->updateGallery($data, $files);

    }




}
