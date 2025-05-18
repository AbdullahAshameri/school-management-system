<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $fillable= ['filename','imageable_id','imageable_type']; //تُستخدم في نموذج Eloquent لتحديد الحقول التي يُسمح بالتعديل عليها عند استخدام Mass Assignment (التعبئة الجماعية).

    public function imageable()
    {
        return $this->morphTo();
    }
}
