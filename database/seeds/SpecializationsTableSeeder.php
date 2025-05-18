<?php

use App\Models\Specialization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecializationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();
        
        $specializations = [
            ['en' => 'Quran and its sciences', 'ar' => 'القرآن وعلومه'],
            ['en' => 'Arabic Language', 'ar' => 'اللغة العربية'],
            ['en' => 'Mathematics', 'ar' => 'الرياضيات'],
            ['en' => 'Sciences', 'ar' => 'العلوم'],
            ['en' => 'Physics', 'ar' => 'الفيزياء'],
            ['en' => 'Chemistry', 'ar' => 'الكيمياء'],
            ['en' => 'Biology', 'ar' => 'الأحياء'],
            ['en' => 'Computer Science', 'ar' => 'علوم الحاسوب'],
            ['en' => 'English Language', 'ar' => 'اللغة الإنجليزية'],
            ['en' => 'French Language', 'ar' => 'اللغة الفرنسية'],
            ['en' => 'Islamic Studies', 'ar' => 'التربية الإسلامية'],
            ['en' => 'History', 'ar' => 'التاريخ'],
            ['en' => 'Geography', 'ar' => 'الجغرافيا'],
            ['en' => 'National Education', 'ar' => 'التربية الوطنية'],
            ['en' => 'Social Studies', 'ar' => 'الدراسات الاجتماعية'],
            ['en' => 'Psychology', 'ar' => 'علم النفس'],
            ['en' => 'Philosophy', 'ar' => 'الفلسفة'],
            ['en' => 'Economics', 'ar' => 'الاقتصاد'],
            ['en' => 'Business Administration', 'ar' => 'إدارة الأعمال'],
            ['en' => 'Physical Education', 'ar' => 'التربية البدنية'],
            ['en' => 'Art Education', 'ar' => 'التربية الفنية'],
            ['en' => 'Home Economics', 'ar' => 'الاقتصاد المنزلي'],
            ['en' => 'Technical Education', 'ar' => 'التعليم الفني'],
        ];

        foreach ($specializations as $specialization) {
            Specialization::create(['Name' => $specialization]);
        }
    }
}
