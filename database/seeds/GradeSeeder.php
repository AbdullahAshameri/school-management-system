<?php

use App\Models\Grade;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    public function run()
    {
        DB::table('grades')->delete();

        $grades = [
            ['en' => 'Primary stage', 'ar' => 'ابتدائي'],
            ['en' => 'Middle School', 'ar' => 'اساسي'],
            ['en' => 'Preparatory stage', 'ar' => 'اعدادي'],
            ['en' => 'High school', 'ar' => 'ثانوي'],
        ];

        foreach ($grades as $grade) {
            Grade::create(['Name' => $grade]);
        }
    }
}