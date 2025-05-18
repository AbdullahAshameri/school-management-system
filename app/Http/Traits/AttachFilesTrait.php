<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait AttachFilesTrait
{
    public function uploadFile($request, $name, $folder)
    {
        // الحصول على اسم الملف الأصلي
        $file_name = $request->file($name)->getClientOriginalName();
        
        // تخزين الملف في المجلد المحدد
        $request->file($name)->storeAs('attachments/'.$folder, $file_name, 'upload_attachments');
    }

        public function deleteFile($fileName, $folder)
    {
        $path = storage_path('app/attachments/' . $folder . '/' . $fileName);

        if (file_exists($path)) {
            unlink($path); // حذف الملف
        }
    }

}
