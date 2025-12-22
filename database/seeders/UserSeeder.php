<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Administrateur Principal',
                'email' => 'admin@myboat.re',
                'password' => Hash::make('MyBoat2025!'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Courtier Maritime',
                'email' => 'courtier@myboat.re',
                'password' => Hash::make('Courtier2025!'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Gestionnaire Annonces',
                'email' => 'gestion@myboat.re',
                'password' => Hash::make('Gestion2025!'),
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
