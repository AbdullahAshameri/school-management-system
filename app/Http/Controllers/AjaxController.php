<?php
namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Section;
use App\Models\Library;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    // جلب الصفوف بناءً على المرحلة الدراسية
    public function getClassrooms($grade_id)
    {
        return Classroom::where('Grade_id', $grade_id)->pluck('Name_Class', 'id');
    }

    // جلب الأقسام بناءً على الصف الدراسي
    public function Get_Sections($classroom_id)
    {
        return Section::where('Class_id', $classroom_id)->pluck('Name_Section', 'id');
    }

    // جلب الكتب بناءً على المرحلة والصف والقسم
    public function loadLibraryBooks($grade_id, $classroom_id, $section_id)
    {
        $books = Library::where('Grade_id', $grade_id)
                        ->where('Classroom_id', $classroom_id)
                        ->where('section_id', $section_id)
                        ->pluck('title', 'id');
                        
        return response()->json($books);
    }
}
