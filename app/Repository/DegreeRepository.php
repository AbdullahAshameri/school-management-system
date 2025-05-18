<?php

namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Degree;
use App\Models\Grade;
use App\Models\Library;
use App\Models\Student;
use App\Models\Teacher;

class DegreeRepository implements DegreeRepositoryInterface
{

    use AttachFilesTrait;

    public function index()
    {
        $Grades = Grade::with(['Sections'])->get();
        $list_Grades = Grade::all();
        $books = Library::all();
        $teachers = Teacher::all();
        return view('pages.degrees.Sections',compact('Grades','list_Grades','teachers'));
        
    }

    public function show($id)
    {
        $students = Student::with('degree')->where('section_id',$id)->get();
        return view('pages.degrees.index',compact('students'));
    }

    public function create()
    {
        
    }

    public function store($request)
    {
        
    }

    public function edit($id)
    {
        
    }

    public function update($request)
    {
        
    }

    public function destroy($request)
    {
        
    }


}
