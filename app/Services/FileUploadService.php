<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public function fileUpload($file): string
    {
        if ($file) {
            Storage::disk('s3')->put('media/main-image/', $file, 'public');
            $uploadedFilePath = Storage::disk('s3')->url('media/main-image/' . $file->hashName());
            return $uploadedFilePath;
        }
        return '';
    }

    public function fileDelete($fileUrl): bool
    {
        $filePath = str_replace(Storage::disk('s3')->url('/'), '', $fileUrl);
        if (Storage::disk('s3')->exists($filePath)) {
            Storage::disk('s3')->delete($filePath);
            return true;
        }
        return false;
    }
}
