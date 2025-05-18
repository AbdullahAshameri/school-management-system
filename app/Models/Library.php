<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    protected $table="library";

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'Classroom_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }
    public function library()
    {
        return $this->hasMany('App\Models\Library', 'section_id');
    }

    public function teacher()
    {
        return $this->belongsTo('App\Models\Teacher', 'teacher_id');
    }
        ///////////////////////////////////
    public function degree()
    {
        return $this->hasMany('App\Models\Degree', 'degree_id');
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
}
