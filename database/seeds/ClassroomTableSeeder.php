<?php

use App\Models\Classroom;
use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassroomTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('classrooms')->delete();

        // الحصول على المراحل التعليمية
        $primary = Grade::where('Name->ar', 'ابتدائي')->first();
        $middle = Grade::where('Name->ar', 'اساسي')->first();
        $preparatory = Grade::where('Name->ar', 'اعدادي')->first();
        $high = Grade::where('Name->ar', 'ثانوي')->first();

        // صفوف المرحلة الابتدائية
        $primaryClassrooms = [
            ['en' => 'First', 'ar' => 'الاول'],
            ['en' => 'Second', 'ar' => 'الثاني'],
            ['en' => 'Third', 'ar' => 'الثالث'],
        ];

        // صفوف المرحلة الأساسية
        $middleClassrooms = [
            ['en' => 'Fourth', 'ar' => 'الرابع'],
            ['en' => 'Fifth', 'ar' => 'الخامس'],
            ['en' => 'Sixth', 'ar' => 'السادس'],
        ];

        // صفوف المرحلة الإعدادية
        $preparatoryClassrooms = [
            ['en' => 'Seventh', 'ar' => 'السابع'],
            ['en' => 'Eighth', 'ar' => 'الثامن'],
            ['en' => 'Ninth', 'ar' => 'التاسع'],
        ];

        // صفوف المرحلة الثانوية
        $highClassrooms = [
            ['en' => 'First', 'ar' => 'الاول'],
            ['en' => 'Second', 'ar' => 'الثاني'],
            ['en' => 'Third', 'ar' => 'الثالث'],
        ];

        // إضافة صفوف المرحلة الابتدائية
        foreach ($primaryClassrooms as $classroom) {
            Classroom::create([
                'Name_Class' => $classroom,
                'Grade_id' => $primary->id,
            ]);
        }

        // إضافة صفوف المرحلة الأساسية
        foreach ($middleClassrooms as $classroom) {
            Classroom::create([
                'Name_Class' => $classroom,
                'Grade_id' => $middle->id,
            ]);
        }

        // إضافة صفوف المرحلة الإعدادية
        foreach ($preparatoryClassrooms as $classroom) {
            Classroom::create([
                'Name_Class' => $classroom,
                'Grade_id' => $preparatory->id,
            ]);
        }

        // إضافة صفوف المرحلة الثانوية
        foreach ($highClassrooms as $classroom) {
            Classroom::create([
                'Name_Class' => $classroom,
                'Grade_id' => $high->id,
            ]);
        }
    }
}