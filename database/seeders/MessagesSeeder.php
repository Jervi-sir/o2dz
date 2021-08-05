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
            'text' => 'admin',
        ]);
        DB::table('messages')->insert([
            'text' => 'person',
        ]);
        DB::table('messages')->insert([
            'text' => 'supplier',
        ]);
    }
}
