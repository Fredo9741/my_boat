<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Placeholder images for demonstration (using placeholder services)
        $medias = [
            // Bateau 1 - Lagoon 450
            ['bateau_id' => 1, 'type' => 'image', 'url' => 'https://placehold.co/800x600/0066cc/white?text=Lagoon+450+Exterieur', 'description' => 'Vue extérieure du catamaran', 'ordre' => 1],
            ['bateau_id' => 1, 'type' => 'image', 'url' => 'https://placehold.co/800x600/0066cc/white?text=Lagoon+450+Cockpit', 'description' => 'Cockpit spacieux', 'ordre' => 2],
            ['bateau_id' => 1, 'type' => 'image', 'url' => 'https://placehold.co/800x600/0066cc/white?text=Lagoon+450+Interieur', 'description' => 'Carré intérieur', 'ordre' => 3],
            ['bateau_id' => 1, 'type' => 'image', 'url' => 'https://placehold.co/800x600/0066cc/white?text=Lagoon+450+Cabine', 'description' => 'Cabine propriétaire', 'ordre' => 4],

            // Bateau 2 - Beneteau Oceanis 46.1
            ['bateau_id' => 2, 'type' => 'image', 'url' => 'https://placehold.co/800x600/006633/white?text=Oceanis+46.1+Voile', 'description' => 'Sous voile', 'ordre' => 1],
            ['bateau_id' => 2, 'type' => 'image', 'url' => 'https://placehold.co/800x600/006633/white?text=Oceanis+46.1+Pont', 'description' => 'Pont avant', 'ordre' => 2],
            ['bateau_id' => 2, 'type' => 'image', 'url' => 'https://placehold.co/800x600/006633/white?text=Oceanis+46.1+Carre', 'description' => 'Carré moderne', 'ordre' => 3],

            // Bateau 3 - Jeanneau Cap Camarat
            ['bateau_id' => 3, 'type' => 'image', 'url' => 'https://placehold.co/800x600/cc6600/white?text=Cap+Camarat+Navigation', 'description' => 'En navigation', 'ordre' => 1],
            ['bateau_id' => 3, 'type' => 'image', 'url' => 'https://placehold.co/800x600/cc6600/white?text=Cap+Camarat+Poste', 'description' => 'Poste de pilotage', 'ordre' => 2],
            ['bateau_id' => 3, 'type' => 'image', 'url' => 'https://placehold.co/800x600/cc6600/white?text=Cap+Camarat+Cockpit', 'description' => 'Cockpit arrière', 'ordre' => 3],

            // Bateau 4 - Zodiac Pro
            ['bateau_id' => 4, 'type' => 'image', 'url' => 'https://placehold.co/800x600/ff6600/white?text=Zodiac+Pro+Profile', 'description' => 'Vue de profil', 'ordre' => 1],
            ['bateau_id' => 4, 'type' => 'image', 'url' => 'https://placehold.co/800x600/ff6600/white?text=Zodiac+Pro+Console', 'description' => 'Console centrale', 'ordre' => 2],

            // Bateau 5 - Princess V58
            ['bateau_id' => 5, 'type' => 'image', 'url' => 'https://placehold.co/800x600/330066/white?text=Princess+V58+Exterieur', 'description' => 'Vue extérieure luxueuse', 'ordre' => 1],
            ['bateau_id' => 5, 'type' => 'image', 'url' => 'https://placehold.co/800x600/330066/white?text=Princess+V58+Salon', 'description' => 'Salon principal', 'ordre' => 2],
            ['bateau_id' => 5, 'type' => 'image', 'url' => 'https://placehold.co/800x600/330066/white?text=Princess+V58+Cabine', 'description' => 'Suite propriétaire', 'ordre' => 3],
            ['bateau_id' => 5, 'type' => 'image', 'url' => 'https://placehold.co/800x600/330066/white?text=Princess+V58+Flybridge', 'description' => 'Flybridge', 'ordre' => 4],
            ['bateau_id' => 5, 'type' => 'video', 'url' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'description' => 'Visite virtuelle', 'ordre' => 5],

            // Bateau 6 - Fountaine Pajot Lucia 40
            ['bateau_id' => 6, 'type' => 'image', 'url' => 'https://placehold.co/800x600/0099cc/white?text=Lucia+40+Ancre', 'description' => 'Au mouillage', 'ordre' => 1],
            ['bateau_id' => 6, 'type' => 'image', 'url' => 'https://placehold.co/800x600/0099cc/white?text=Lucia+40+Flybridge', 'description' => 'Flybridge spacieux', 'ordre' => 2],
            ['bateau_id' => 6, 'type' => 'image', 'url' => 'https://placehold.co/800x600/0099cc/white?text=Lucia+40+Cuisine', 'description' => 'Cuisine équipée', 'ordre' => 3],

            // Bateau 7 - Bateau de pêche
            ['bateau_id' => 7, 'type' => 'image', 'url' => 'https://placehold.co/800x600/996633/white?text=Peche+Traditionnelle', 'description' => 'Bateau traditionnel', 'ordre' => 1],
            ['bateau_id' => 7, 'type' => 'image', 'url' => 'https://placehold.co/800x600/996633/white?text=Peche+Equipement', 'description' => 'Équipement de pêche', 'ordre' => 2],

            // Bateau 8 - Bavaria 37
            ['bateau_id' => 8, 'type' => 'image', 'url' => 'https://placehold.co/800x600/003366/white?text=Bavaria+37+Navigation', 'description' => 'En mer', 'ordre' => 1],
            ['bateau_id' => 8, 'type' => 'image', 'url' => 'https://placehold.co/800x600/003366/white?text=Bavaria+37+Cockpit', 'description' => 'Cockpit arrière', 'ordre' => 2],
            ['bateau_id' => 8, 'type' => 'image', 'url' => 'https://placehold.co/800x600/003366/white?text=Bavaria+37+Carre', 'description' => 'Carré et dinette', 'ordre' => 3],
        ];

        foreach ($medias as $media) {
            DB::table('medias')->insert(array_merge($media, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }
    }
}
