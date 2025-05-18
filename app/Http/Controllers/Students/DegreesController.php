<?php

namespace App\Http\Controllers\Students;

use Illuminate\Routing\Controller;
use App\Models\Classroom;
use App\Models\Degree;
use App\Models\Grade;
use App\Models\Library;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DegreesImport;

class DegreesController extends Controller
{
    /**
     * عرض صفحة رفع الدرجات مع الفلاتر.
     */
    public function create()
    {
        $grades = Grade::all();
        $classrooms = Classroom::all();
        $sections = Section::all();
        $teachers = Teacher::all();
        $library = Library::all();
        $students = Student::all();
        $terms = ['الفصل الدراسي الأول', 'الفصل الدراسي الثاني'];  // إضافة الفصول الدراسية هنا

        return view('pages.degrees.index', compact(
            'grades',
            'classrooms',
            'sections',
            'teachers',
            'library',
            'students',
            'terms'  // تمرير terms هنا
        ));
    }

    /**
     * فلترة الطلاب حسب المستوى والصف والقسم والمادة والمعلم والشهر والسنة.
     */
    public function filter(Request $request)
    {
        // التحقق من البيانات المدخلة
        $validated = $request->validate([
            'Grade_id'     => 'required|exists:grades,id',
            'Classroom_id' => 'required|exists:classrooms,id',
            'section_id'   => 'required|exists:sections,id',
            'library_id'   => 'required|exists:library,id',
            'teacher_id'   => 'required|exists:teachers,id',
            'month'        => 'required|string',
            'year'         => 'required|string',
            'term'         => 'required|string',
        ]);

        // استرجاع الطلاب بناءً على الفلاتر المدخلة
        $students = Student::where('Grade_id', $request->Grade_id)
            ->where('Classroom_id', $request->Classroom_id)
            ->where('section_id', $request->section_id)
            ->get();

        // استرجاع المواد بناءً على القسم
        $library = Library::where('section_id', $request->section_id)->get();

        // جلب بيانات المرحلة والقسم
        $grade = Grade::find($request->Grade_id);
        $section = Section::find($request->section_id);

        // جلب باقي البيانات
        $grades = Grade::all();
        $classrooms = Classroom::all();
        $sections = Section::all();
        $teachers = Teacher::all();
        $terms = ['الفصل الدراسي الأول', 'الفصل الدراسي الثاني'];

        // إعادة توجيه إلى صفحة إدخال الدرجات مع تمرير المتغيرات
        return view('pages.degrees.assign', compact(
            'students',
            'grades',
            'classrooms',
            'sections',
            'library',
            'teachers',
            'terms',
            'request',
            'grade',
            'section'
        ));
    }




    /**
     * تخزين درجات الطلاب.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'scores'       => 'required|array',
            'type'         => 'required|in:تحريري,واجبات,شفوي,المواضبة',
            'month'        => 'required|string',
            'year'         => 'required|string',
            'Grade_id'     => 'required|exists:grades,id',
            'Classroom_id' => 'required|exists:classrooms,id',
            'section_id'   => 'required|exists:sections,id',
            'library_id'   => 'required|exists:library,id',
            'teacher_id'   => 'required|exists:teachers,id',
            'term'         => 'nullable|string',
        ]);

        foreach ($request->scores as $student_id => $score) {
            Degree::create([
                'student_id'   => $student_id,
                'Grade_id'     => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id'   => $request->section_id,
                'library_id'   => $request->library_id,
                'teacher_id'   => $request->teacher_id,
                'score'        => $score,
                'type'         => $request->type,
                'term'         => $request->term,
                'year'         => $request->year,
                'month'        => $request->month,
                'title'        => 'تم التقييم',
            ]);
        }

        toastr()->success('تم حفظ الدرجات بنجاح');
        return redirect()->route('degrees.create');
    }
    public function getMaterials($section_id)
    {
        // استرجاع المواد بناءً على القسم المحدد
        $materials = Library::where('section_id', $section_id)->get();

        // إعادة البيانات بتنسيق JSON
        return response()->json($materials);
    }

    /**
     * صفحة استيراد الدرجات من Excel.
     */
    public function viewImport()
    {
        // Get necessary data for the view (like Grades, Classrooms, Sections, etc.)
        $grades = Grade::all();
        $classrooms = Classroom::all();
        $sections = Section::all();
        $teachers = Teacher::all();
        $library = Library::all();

        return view('pages.degrees.execl', compact('grades', 'classrooms', 'sections', 'teachers', 'library'));
    }

    public function import(Request $request)
    {
        // Validate the file input
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        // Pass necessary data for import
        $import = Excel::import(
            new DegreesImport(
                $request->Grade_id,
                $request->Classroom_id,
                $request->section_id,
                $request->teacher_id,
                $request->month,
                $request->year,
                $request->term,
                $request->library_id,
            ),
            $request->file('file')
        );

        toastr()->success('تم تحميل الدرجات بنجاح');
        return redirect()->route('degrees.create');
    }   
        // عرض نتائج الدرجات بعد الفلاتر
public function filterDegrees(Request $request)
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

    $degrees = Degree::where('Grade_id', $request->Grade_id)
        ->where('Classroom_id', $request->Classroom_id)
        ->where('section_id', $request->section_id)
        ->where('teacher_id', $request->teacher_id)
        ->where('month', $request->month)
        ->where('year', $request->year)
        ->where('term', $request->term)
        ->get();

    $grades = Grade::all();
    $classrooms = Classroom::all();
    $sections = Section::all();
    $teachers = Teacher::all();
    $terms = ['الفصل الدراسي الأول', 'الفصل الدراسي الثاني'];

    return view('pages.degrees.show', compact('degrees', 'grades', 'classrooms', 'sections', 'teachers', 'terms'));
}


    }
