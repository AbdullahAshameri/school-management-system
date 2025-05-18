<?php

use App\Models\My_Parent;
use App\Models\Nationalitie;
use App\Models\Religion;
use App\Models\Type_Blood;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('my__parents')->delete(); // حذف البيانات القديمة

        // بيانات مستعارة للأباء والأمهات
        $parents = [
            ['Father' => ['en' => 'Ahmed Ali', 'ar' => 'أحمد علي'], 'Mother' => ['en' => 'Fatima Hassan', 'ar' => 'فاطمة حسن']],
            ['Father' => ['en' => 'Mohammed Saleh', 'ar' => 'محمد صالح'], 'Mother' => ['en' => 'Aisha Omar', 'ar' => 'عائشة عمر']],
            ['Father' => ['en' => 'Yasser Nasser', 'ar' => 'ياسر ناصر'], 'Mother' => ['en' => 'Huda Sami', 'ar' => 'هدى سامي']],
            ['Father' => ['en' => 'Khalid Saeed', 'ar' => 'خالد سعيد'], 'Mother' => ['en' => 'Mona Tariq', 'ar' => 'منى طارق']],
            ['Father' => ['en' => 'Ibrahim Hamid', 'ar' => 'إبراهيم حميد'], 'Mother' => ['en' => 'Nadia Abdulrahman', 'ar' => 'نادية عبدالرحمن']],
            ['Father' => ['en' => 'Omar Zaid', 'ar' => 'عمر زيد'], 'Mother' => ['en' => 'Samira Mahmoud', 'ar' => 'سميرة محمود']],
            ['Father' => ['en' => 'Nabil Kareem', 'ar' => 'نبيل كريم'], 'Mother' => ['en' => 'Layla Jameel', 'ar' => 'ليلى جميل']],
            ['Father' => ['en' => 'Tariq Mustafa', 'ar' => 'طارق مصطفى'], 'Mother' => ['en' => 'Salma Fares', 'ar' => 'سلمى فارس']],
            ['Father' => ['en' => 'Hassan Fadel', 'ar' => 'حسن فاضل'], 'Mother' => ['en' => 'Amal Rafiq', 'ar' => 'أمل رفيق']],
            ['Father' => ['en' => 'Walid Basim', 'ar' => 'وليد باسم'], 'Mother' => ['en' => 'Rania Adel', 'ar' => 'رانيا عادل']],
        ];

        foreach ($parents as $index => $parent) {
            $my_parents = new My_Parent();
            $my_parents->email = 'parent' . ($index + 1) . '@example.com';
            $my_parents->password = Hash::make('12345678');
            $my_parents->Name_Father = $parent['Father'];
            $my_parents->National_ID_Father = '10000000' . $index;
            $my_parents->Passport_ID_Father = '20000000' . $index;
            $my_parents->Phone_Father = '77777777' . $index;
            $my_parents->Job_Father = ['en' => 'Engineer', 'ar' => 'مهندس'];
            $my_parents->Nationality_Father_id = Nationalitie::all()->random()->id;
            $my_parents->Blood_Type_Father_id = Type_Blood::all()->random()->id;
            $my_parents->Religion_Father_id = Religion::all()->random()->id;
            $my_parents->Address_Father = 'صنعاء، اليمن';

            $my_parents->Name_Mother = $parent['Mother'];
            $my_parents->National_ID_Mother = '30000000' . $index;
            $my_parents->Passport_ID_Mother = '40000000' . $index;
            $my_parents->Phone_Mother = '77788888' . $index;
            $my_parents->Job_Mother = ['en' => 'Teacher', 'ar' => 'معلمة'];
            $my_parents->Nationality_Mother_id = Nationalitie::all()->random()->id;
            $my_parents->Blood_Type_Mother_id = Type_Blood::all()->random()->id;
            $my_parents->Religion_Mother_id = Religion::all()->random()->id;
            $my_parents->Address_Mother = 'صنعاء، اليمن';

            $my_parents->save();
        }
    }
}
