<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WilayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wilaya_name = array("Adrar", "Chlef", "Laghouat", "Oum El Bouaghi", "Batna", "Béjaïa", "Biskra",
        "Béchar", "Blida", "Bouïra", "Tamanrasset", "Tébessa", "Tlemcen", "Tiaret",
        "Tizi Ouzou" , "Alger", "Djelfa", "Jijel", "Sétif" , "Saïda", "Skikda",
        "Sidi Bel Abbès", "Annaba", "Guelma", "Constantine", "Médéa", "Mostaganem",
        "M\"Sila", "Mascara", "Ouargla", "Oran", "El Bayadh", "Illizi", "Bordj Bou Arréridj", 
        "Boumerdès", "El Tarf", "Tindouf", "Tissemsilt", "El Oued", "Khenchela", "Souk Ahras",
        "Tipaza", "Mila", "Aïn Defla", "Naâma", "Aïn Témouchent", "Ghardaïa", "Relizane",
        "El M\"ghair", "El Menia", "Ouled Djellal", "Bordj Baji Mokhtar", "Béni Abbès",
        "Timimoun", "Touggourt", "Djanet", "In Salah", "In Guezzam");

        for($i = 1; $i <= count($wilaya_name); $i++)
        {
            DB::table('wilayas')->insert([
                'number' => $i,
                'name' => $wilaya_name[$i-1],
            ]);
        }
    }
}
