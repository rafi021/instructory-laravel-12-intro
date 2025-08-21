<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class FileUploadService
{
    public function fileUpload($file): string
    {
        if ($file) {
            Storage::disk('spaces')->put('beybsadar/', $file, 'public');
            $uploadedFilePath = Storage::disk('spaces')->url('beybsadar/' . $file->hashName());
            return $uploadedFilePath;
        }
        return '';
    }

    public function fileDelete($fileUrl): bool
    {
        $filePath = str_replace(Storage::disk('spaces')->url('/'), '', $fileUrl);
        if (Storage::disk('spaces')->exists($filePath)) {
            Storage::disk('spaces')->delete($filePath);
            return true;
        }
        return false;
    }
}
