<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array("Gratuit", "Payant", "Location");
        for($i = 1; $i <= count($types); $i++)
        {
            DB::table('costs')->insert([
                'number' => $i,
                'name' => $types[$i-1],
            ]);
        }
    }
}
