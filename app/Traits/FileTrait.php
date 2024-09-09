<?php

namespace App\Traits;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{

    public function fileUpload(object $file): string
    {
        if($file) {
            $fileNameParts = explode('.', $file->getClientOriginalName());
            $fileName = $fileNameParts[0].time() . '.' . $fileNameParts[1];
            $file->storeAs("ufiles", $fileName, 'public');
        }
        return $fileName ?? "";
    }


    public function fileDelete(string $filePath): void
    {
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }

}
