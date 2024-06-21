<?php

namespace Database\Seeders;

use App\Models\Faculte;
use App\Models\Niveau;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $niveaux=[
            "6e",
            "5e",
            "4e",
            "3e",
            "2nd A",
            "2nd C",
            "1ere A",
            "1ere D",
            "1ere C",
            "Tle A",
            "Tle D",
            "Tle C",
        ];

        foreach($niveaux as $niveau){
            Niveau::create([
                "libelle"=>$niveau
            ]);
        }
    }
}
