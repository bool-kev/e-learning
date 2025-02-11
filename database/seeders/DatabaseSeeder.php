<?php

namespace Database\Seeders;

use App\Models\Eleve;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([FaculteSeeder::class,NiveauSeeder::class,MatiereSeeder::class]);
        User::factory(10)->create();
        Eleve::factory(5)->create();
        // User::factory()->create([
        //     'name' => 'boolkevin2@gmail.com',
        //     'email' => 'test@example.com',
        // ]);
    }
}
