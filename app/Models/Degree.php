<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $fillable = [
        'title',
        'student_id',
        'Grade_id',
        'Classroom_id',
        'section_id',
        'library_id',
        'teacher_id',
        'type',
        'score',
        'term',
        'year',
        'month',
    ];
    

    // علاقة مع الطالب
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // علاقة مع المادة
    public function library()
    {
        return $this->belongsTo(Library::class);
    }

    // علاقة مع الصف الدراسي
    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    // علاقة مع القسم الدراسي
    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    // علاقة مع المعلم
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // علاقة مع المستوى الدراسي (Grade)
    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }
}
