<?php

use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SectionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('sections')->delete();

        // الحصول على المراحل التعليمية
        $primary = Grade::where('Name->ar', 'ابتدائي')->first();
        $middle = Grade::where('Name->ar', 'اساسي')->first();
        $preparatory = Grade::where('Name->ar', 'اعدادي')->first();
        $high = Grade::where('Name->ar', 'ثانوي')->first();

        // أقسام المرحلة الابتدائية (عربي، انجليزي)
        $primarySections = [
            ['en' => 'Arabic', 'ar' => 'عربي'],
            ['en' => 'English', 'ar' => 'انجليزي'],
        ];

        // أقسام المرحلة الأساسية (بنين، بنات، انجليزي)
        $middleSections = [
            ['en' => 'Boys', 'ar' => 'بنين'],
            ['en' => 'Girls', 'ar' => 'بنات'],
            ['en' => 'English', 'ar' => 'انجليزي'],
        ];

        // أقسام المرحلة الإعدادية والثانوية (بنين، بنات)
        $preparatoryHighSections = [
            ['en' => 'Boys', 'ar' => 'بنين'],
            ['en' => 'Girls', 'ar' => 'بنات'],
        ];

        // إضافة أقسام المرحلة الابتدائية (لكل صف)
        $primaryClassrooms = Classroom::where('Grade_id', $primary->id)->get();
        foreach ($primaryClassrooms as $classroom) {
            foreach ($primarySections as $section) {
                Section::create([
                    'Name_Section' => $section,
                    'Status' => 1,
                    'Grade_id' => $primary->id,
                    'Class_id' => $classroom->id,
                ]);
            }
        }

        // إضافة أقسام المرحلة الأساسية (لكل صف)
        $middleClassrooms = Classroom::where('Grade_id', $middle->id)->get();
        foreach ($middleClassrooms as $classroom) {
            foreach ($middleSections as $section) {
                Section::create([
                    'Name_Section' => $section,
                    'Status' => 1,
                    'Grade_id' => $middle->id,
                    'Class_id' => $classroom->id,
                ]);
            }
        }

        // إضافة أقسام المرحلة الإعدادية (لكل صف)
        $preparatoryClassrooms = Classroom::where('Grade_id', $preparatory->id)->get();
        foreach ($preparatoryClassrooms as $classroom) {
            foreach ($preparatoryHighSections as $section) {
                Section::create([
                    'Name_Section' => $section,
                    'Status' => 1,
                    'Grade_id' => $preparatory->id,
                    'Class_id' => $classroom->id,
                ]);
            }
        }

        // إضافة أقسام المرحلة الثانوية (لكل صف)
        $highClassrooms = Classroom::where('Grade_id', $high->id)->get();
        foreach ($highClassrooms as $classroom) {
            foreach ($preparatoryHighSections as $section) {
                Section::create([
                    'Name_Section' => $section,
                    'Status' => 1,
                    'Grade_id' => $high->id,
                    'Class_id' => $classroom->id,
                ]);
            }
        }
    }
}