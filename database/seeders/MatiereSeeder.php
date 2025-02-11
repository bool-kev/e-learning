<?php

namespace Database\Seeders;

use App\Models\Faculte;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MatiereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         foreach(Faculte::all() as $faculte)
         {
            $level=[random_int(1,12),random_int(1,12),random_int(1,12),random_int(1,12),random_int(1,12)];
            $faculte->classes()->sync($level);
         }
    }
}
