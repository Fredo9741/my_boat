<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed boat marketplace data in correct order (respecting foreign keys)
        $this->call([
            TypeSeeder::class,
            ZoneSeeder::class,
            ActionSeeder::class,
            EquipementSeeder::class,
            BateauSeeder::class,
            MediaSeeder::class,
            UserSeeder::class,
        ]);
    }
}
