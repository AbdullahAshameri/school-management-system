<?php
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Type_Blood;
use App\Models\Student;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('students')->delete(); // حذف جميع البيانات القديمة

        // استرجاع جميع أولياء الأمور وتوزيع الطلاب عليهم
        $parents = My_Parent::all()->shuffle(); 
        $parentIndex = 0;

        // بيانات مستعارة لـ 20 اسمًا مختلفًا
        $studentNames = [
            ['ar' => 'أحمد العنسي', 'en' => 'Ahmed Al-Ansi'],
            ['ar' => 'محمد سعيد', 'en' => 'Mohammed Saeed'],
            ['ar' => 'عمر خالد', 'en' => 'Omar Khaled'],
            ['ar' => 'إبراهيم زيد', 'en' => 'Ibrahim Zaid'],
            ['ar' => 'خالد فاضل', 'en' => 'Khaled Fadel'],
            ['ar' => 'ياسر أحمد', 'en' => 'Yasser Ahmed'],
            ['ar' => 'سامر طارق', 'en' => 'Samer Tarek'],
            ['ar' => 'حسين الخمري', 'en' => 'Hussain Al-Khamri'],
            ['ar' => 'نبيل كريم', 'en' => 'Nabil Kareem'],
            ['ar' => 'مروان عبدالعزيز', 'en' => 'Marwan Abdulaziz'],
            ['ar' => 'فارس جميل', 'en' => 'Fares Jameel'],
            ['ar' => 'رائد منصور', 'en' => 'Raed Mansour'],
            ['ar' => 'جمال عبدالناصر', 'en' => 'Jamal Abdulnaser'],
            ['ar' => 'عدنان زاهر', 'en' => 'Adnan Zaher'],
            ['ar' => 'كريم السالمي', 'en' => 'Kareem Al-Salmi'],
            ['ar' => 'وليد نبيل', 'en' => 'Waleed Nabeel'],
            ['ar' => 'هيثم زيد', 'en' => 'Haitham Zaid'],
            ['ar' => 'فؤاد خالد', 'en' => 'Fouad Khaled'],
            ['ar' => 'زياد محسن', 'en' => 'Ziad Mohsen']
        ];

        // تحديد عدد الطلاب 20
        for ($i = 1; $i <= 20; $i++) {
            $name = $studentNames[array_rand($studentNames)]; // اختيار اسم عشوائي

            // اختيار ولي أمر بطريقة متسلسلة (لضمان توزيع عادل)
            $parent = $parents[$parentIndex];
            $parentIndex = ($parentIndex + 1) % count($parents); // التكرار عند انتهاء القائمة

            // تحديد المرحلة الدراسية عشوائيًا
            $grade = Grade::all()->random();

            // تحديد الصف والقسم بناءً على المرحلة
            $classroom = Classroom::where('Grade_id', $grade->id)->get()->random();
            $section = Section::where('Class_id', $classroom->id)->get()->random();

            $student = new Student();
            $student->name = $name;
            $student->email = 'student' . $i . '@example.com';
            $student->password = Hash::make('12345678');
            $student->gender_id = rand(1, 2); // 1 ذكر - 2 أنثى
            $student->nationalitie_id = $parent->Nationality_Father_id; // وراثة جنسية الأب
            $student->blood_id = $parent->Blood_Type_Father_id; // وراثة فصيلة دم الأب
            $student->Date_Birth = date('Y-m-d', strtotime('-' . rand(10, 18) . ' years'));
            $student->Grade_id = $grade->id;
            $student->Classroom_id = $classroom->id;
            $student->section_id = $section->id;
            $student->parent_id = $parent->id; // تعيين الأب مباشرة
            $student->academic_year = '2025';
            $student->save();
        }
    }
}
