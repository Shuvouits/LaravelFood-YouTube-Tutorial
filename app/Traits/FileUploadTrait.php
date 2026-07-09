<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

trait FileUploadTrait
{
    public function uploadFile(?UploadedFile $file, string $folder, ?string $oldFile = null): ?string
    {
        if (!$file) {
            return $oldFile;
        }

        $destinationPath = public_path('uploads/' . $folder);

        if (!File::exists($destinationPath)) {
            File::makeDirectory($destinationPath, 0755, true);
        }

        if ($oldFile && File::exists(public_path($oldFile))) {
            File::delete(public_path($oldFile));
        }

        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $file->move($destinationPath, $fileName);

        return 'uploads/' . $folder . '/' . $fileName;
    }
}
