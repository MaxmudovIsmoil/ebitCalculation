<?php

namespace App\Traits;


use App\Models\OrderFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait FileTrait
{

    public function uploadFile(object $file): string
    {
        if($file) {
            $fileNameParts = explode('.', $file->getClientOriginalName());
            $fileName = $fileNameParts[0].time() . '.' . $fileNameParts[1];
            $file->storeAs("ufiles", $fileName, 'public');
        }
        return $fileName ?? "";
    }


    public function uploadFiles($orderId, $files): void
    {
        if($files)  {
            foreach($files as $file) {
                $fileName = $this->fileUpload($file);
                OrderFile::create([
                    'orderId' => $orderId,
                    'userId' => Auth::id(),
                    'file'   => $fileName,
                ]);
            }
        }

    }
    public function fileDelete(string $filePath): void
    {
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
        }
    }

}
