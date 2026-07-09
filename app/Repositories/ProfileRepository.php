<?php

namespace App\Repositories;

use App\Models\User;
use App\Traits\FileUploadTrait; // Import the FileUploadTrait

class ProfileRepository
{
    use FileUploadTrait; // Use the FileUploadTrait

    public function createOrUpdateProfile($data, $avatar, $id)
    {
        $profile = User::find($id);

        // Unlink image if exists
        if ($profile->avatar) {
            $imagePath = public_path(parse_url($profile->avatar, PHP_URL_PATH));
            if (file_exists($imagePath) && is_file($imagePath)) {
                unlink($imagePath);
            }
        }

        // Handle file uploads manually
        if ($avatar) {
            $data['avatar'] = $this->uploadFile($avatar, 'user', $profile->avatar);
        }

        // Manually assign other fields from $data
        $profile->update($data);

        return $profile;
    }
}
