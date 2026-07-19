<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ImageGalleryRequest;
use App\Services\GalleryService;
use Illuminate\Http\Request;

class ProductImageGalleryController extends Controller
{
    //

     protected $galleryService;

    public function __construct(GalleryService $galleryService)
    {
        $this->galleryService = $galleryService;
    }

      public function store(ImageGalleryRequest $request)
    {
          $this->galleryService->updateGallery($request->validated(), $request->allFiles() );
        return redirect()->back()->with('success', 'Data updated successfully');
    }



    public function destroy(string $id)
    {
         $gallery = ImageGallery::findOrFail($id);

        // Delete associated image if exists
        // Delete the image file if it exists
        if ($gallery->image) {
            $imagePath = public_path(parse_url($gallery->image, PHP_URL_PATH));
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $gallery->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }


}
