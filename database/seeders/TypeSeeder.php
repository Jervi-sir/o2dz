<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array("Condensateur", "Oxygen", "Bouteil", "Rechargement");
        for($i = 1; $i <= count($types); $i++)
        {
            DB::table('types')->insert([
                'number' => $i,
                'name' => $types[$i-1],
            ]);
        }
    }
}
