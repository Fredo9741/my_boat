<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Ne seed que si aucun utilisateur n'existe
        if (User::count() > 0) {
            return;
        }

        $users = [
            [
                'name' => 'Administrateur Principal',
                'email' => 'admin@myboat.re',
                'password' => Hash::make('MyBoat2025!'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Courtier Maritime',
                'email' => 'courtier@myboat.re',
                'password' => Hash::make('Courtier2025!'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Gestionnaire Annonces',
                'email' => 'gestion@myboat.re',
                'password' => Hash::make('Gestion2025!'),
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
