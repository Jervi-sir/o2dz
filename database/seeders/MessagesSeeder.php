<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('messages')->insert([
            'text' => 'اطمئن, سنحاول مساعدتك',
        ]);
        DB::table('messages')->insert([
            'text' => 'اذكر الله’ فيطمئن بالك',
        ]);
        DB::table('messages')->insert([
            'text' => 'خذ Omega 3  لتعزيز صحتك',
        ]);
        DB::table('messages')->insert([
            'text' => ' اسمح لنفسك ببعض من النوم ان امكن ',
        ]);
        DB::table('messages')->insert([
            'text' => ' مهما كانت الاحوال, أعلم أن شخصًا ما مهتم بك  ',
        ]);
        DB::table('messages')->insert([
            'text' => ' جميعنا اخوة و نبفي متمسكين بالبعض  ',
        ]);
        DB::table('messages')->insert([
            'text' => '🤲 باسم الله  ',
        ]);
        DB::table('messages')->insert([
            'text' => ' اغسل ايديك و انفك حالما تدخل منزلك   ',
        ]);
        DB::table('messages')->insert([
            'text' => ' قي نفسك ',
        ]);
        DB::table('messages')->insert([
            'text' => '🤲 ندعو الله ان يقويكم  ',
        ]);
    }
}
