<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Section extends Model
{
    use HasTranslations;
    public $translatable = ['Name_Section'];
    protected $fillable=['Name_Section','Grade_id','Class_id'];

    protected $table = 'sections';
    public $timestamps = true;


    // علاقة بين الاقسام والصفوف لجلب اسم الصف في جدول الاقسام

    public function My_classs()
    {
        return $this->belongsTo('App\Models\Classroom', 'Class_id');
    }

    // علاقة الاقسام مع المعلمين
    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher','teacher_section');
    }

    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade','Grade_id');
    }
    public function Library()
    {
        return $this->hasMany('App\Models\Library', 'section_id');
    }
    
    public function books()
    {
        return $this->hasMany(Library::class, 'section_id');  // تأكد من أن حقل section_id موجود في جدول الكتب
    }
    public function Classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'Class_id');
    }

   

}
