<?php

namespace App\Http\Controllers;

use App\Models\Degree;
use App\Models\Student;
use App\Models\Grade;
use App\Models\Classroom;
use App\Models\Section;
use App\Models\Library;
use App\Models\Teacher;
use Illuminate\Http\Request;

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



    public function show(Request $request)
    {
        // جلب بيانات المستوى الدراسي والقسم بناءً على الفلاتر
        $grade = Grade::find($request->Grade_id);
        $section = Section::find($request->section_id);

        // استرجاع الطلاب بناءً على الفلاتر المدخلة
        $students = Student::where('Grade_id', $request->Grade_id)
            ->where('Classroom_id', $request->Classroom_id)
            ->where('section_id', $request->section_id)
            ->get();

        // جلب باقي البيانات
        
        $grades = Grade::all();
        $classrooms = Classroom::all();
        $sections = Section::all();
        $library = Library::all();
        $teachers = Teacher::all();
        $terms = ['الفصل الدراسي الأول', 'الفصل الدراسي الثاني'];

        // عرض صفحة عرض درجات الطلاب مع البيانات المطلوبة
        return view('pages.degrees.degree', compact(
            'students',
            'grades',
            'classrooms',
            'sections',
            'library',
            'teachers',
            'terms',
            'grade',
            'section'
        ));
    }


    public function edit(Request $request)
    {
        // جلب بيانات المرحلة والقسم بناءً على الفلاتر
        $grade = Grade::find($request->Grade_id);
        $section = Section::find($request->section_id);

        // استرجاع الطلاب بناءً على الفلاتر المدخلة
        $students = Student::where('Grade_id', $request->Grade_id)
            ->where('Classroom_id', $request->Classroom_id)
            ->where('section_id', $request->section_id)
            ->get();

        // جلب باقي البيانات
        $grades = Grade::all();
        $classrooms = Classroom::all();
        $sections = Section::all();
        $library = Library::all();
        $teachers = Teacher::all();
        $terms = ['الفصل الدراسي الأول', 'الفصل الدراسي الثاني'];

        // عرض صفحة تعديل الدرجات مع البيانات المطلوبة
        return view('pages.degrees.edit', compact(
            'students',
            'grades',
            'classrooms',
            'sections',
            'library',
            'teachers',
            'terms',
            'grade',
            'section'
        ));
    }
}
