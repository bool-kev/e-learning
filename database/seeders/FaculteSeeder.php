<?php

namespace Database\Seeders;

use App\Models\Faculte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FaculteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $facultes=[
            "Mathematiques",
            "Francais",
            "Anglais",
            "Science Physique",
            "Allemand",
            "Informatique",
            "Histoire Geographie",
            "SVT"
        ];

        foreach($facultes as $faculte){
            Faculte::create([
                "libelle"=>$faculte
            ]);
        }
    }
}
