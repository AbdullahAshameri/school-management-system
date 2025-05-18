<?php

namespace App\Http\Controllers\Students;

use App\Exports\GradesExport;
use App\Models\Classroom;
use App\Models\Degree;
use App\Models\Grade;
use App\Models\Library;
use App\Models\Section;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Maatwebsite\Excel\Facades\Excel;

class GradesController extends Controller
{
    /**
     * عرض صفحة الفلاتر لاختيار الدرجات
     */
    public function showFilterPage()
    {
        $grades = Grade::all();
        $classrooms = Classroom::all();
        $sections = Section::all();
        $teachers = Teacher::all();
        $library = Library::all();
        $terms = ['الفصل الدراسي الأول', 'الفصل الدراسي الثاني'];

        return view('pages.grades.filter', compact(
            'grades',
            'classrooms',
            'sections',
            'teachers',
            'library',
            'terms'
        ));
    }

    /**
     * فلترة الدرجات بناءً على الفلاتر المدخلة
     */
    public function filterGrades(Request $request)
    {
        $validated = $request->validate([
            'Grade_id'     => 'required|exists:grades,id',
            'Classroom_id' => 'required|exists:classrooms,id',
            'section_id'   => 'required|exists:sections,id',
            'teacher_id'   => 'required|exists:teachers,id',
            'month'        => 'required|string',
            'year'         => 'required|string',
            'term'         => 'required|string',
        ]);

        // استرجاع الدرجات بناءً على الفلاتر
        $filteredGrades = Degree::where('Grade_id', $request->Grade_id)
            ->where('Classroom_id', $request->Classroom_id)
            ->where('section_id', $request->section_id)
            ->where('teacher_id', $request->teacher_id)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->where('term', $request->term)
            ->get();

        // جلب البيانات اللازمة للفلاتر
        $grades = Grade::all();
        $classrooms = Classroom::all();
        $sections = Section::all();
        $teachers = Teacher::all();
        $library = Library::all();
        $terms = ['الفصل الدراسي الأول', 'الفصل الدراسي الثاني'];

        return view('pages.grades.filter', compact(
            'filteredGrades',
            'grades',
            'classrooms',
            'sections',
            'teachers',
            'library',
            'terms',
            'request'
        ));
    }

    public function updateGrade(Request $request, $degree_id)
    {
        $validated = $request->validate([
            'score' => 'required|numeric|min:0|max:100',  // Validate the grade input
        ]);

        // Find the degree to update
        $degree = Degree::find($degree_id);

        if ($degree) {
            $degree->score = $request->score;  // Update the grade score
            $degree->save();  // Save the updated grade
            toastr()->success('تم تعديل الدرجة بنجاح');
        } else {
            toastr()->error('الدرجة غير موجودة');
        }

        return redirect()->route('grades.filter');  // Redirect back to the filter page
    }
    public function exportGradesToExcel(Request $request)
    {
        $validated = $request->validate([
            'Grade_id'     => 'required|exists:grades,id',
            'Classroom_id' => 'required|exists:classrooms,id',
            'section_id'   => 'required|exists:sections,id',
            'teacher_id'   => 'required|exists:teachers,id',
            'month'        => 'required|string',
            'year'         => 'required|string',
            'term'         => 'required|string',
        ]);

        // Get filtered grades based on the request
        $filteredGrades = Degree::where('Grade_id', $request->Grade_id)
            ->where('Classroom_id', $request->Classroom_id)
            ->where('section_id', $request->section_id)
            ->where('teacher_id', $request->teacher_id)
            ->where('month', $request->month)
            ->where('year', $request->year)
            ->where('term', $request->term)
            ->get();

        // Export the grades using the GradesExport class
        return Excel::download(new GradesExport($filteredGrades), 'grades.xlsx');
    }
}
