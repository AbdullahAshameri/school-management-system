<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('settings')->delete();

        $data = [
            ['key' => 'current_session', 'value' => '2025-2026'],
            ['key' => 'school_title', 'value' => 'نظام متابعة الطلاب'],
            ['key' => 'school_name', 'value' => 'مدرسة آزال الحدية'],
            ['key' => 'end_first_term', 'value' => '01-12-2025'],// نهتية الترم الاول 
            ['key' => 'end_second_term', 'value' => '01-03-2026'],// نهاية الترم الثاني
            ['key' => 'phone', 'value' => '777 777 777'],
            ['key' => 'address', 'value' => 'صنعاء'],
            ['key' => 'school_email', 'value' => 'azal@gmail.com'],
            ['key' => 'logo', 'value' => 'ELogo.png'],
        ];

        DB::table('settings')->insert($data);
    }
}
