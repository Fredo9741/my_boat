#!/usr/bin/env python3
"""
Script pour régénérer le BateauSeeder.php depuis le JSON mis à jour
"""

import json
import sys
import io
from datetime import datetime

# Fix encoding on Windows
if sys.platform == 'win32':
    sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')

def generate_seeder(boats_data):
    """Génère le fichier BateauSeeder.php"""
    print("\n📝 Génération du seeder Laravel...")

    seeder_content = """<?php

namespace Database\\Seeders;

use App\\Models\\Bateau;
use App\\Models\\Zone;
use App\\Models\\Type;
use App\\Models\\Action;
use Illuminate\\Database\\Seeder;

class BateauSeeder extends Seeder
{
    /**
     * Run the database seeder.
     *
     * Auto-generated from JSON on """ + datetime.now().strftime('%Y-%m-%d %H:%M:%S') + """
     * Total bateaux: """ + str(len(boats_data)) + """
     */
    public function run(): void
    {
        // Protection : ne pas re-seeder si des bateaux existent déjà
        if (Bateau::count() > 0) {
            echo "\\n⏭️  Bateaux déjà présents en base, skip du seeding\\n";
            return;
        }

        echo "\\n🚢 Seeding """ + str(len(boats_data)) + """ bateaux...\\n\\n";

"""

    for i, boat in enumerate(boats_data, 1):
        # Générer l'entrée pour chaque bateau
        seeder_content += f"        // Bateau {i}: {boat.get('modele', 'Sans titre')}\n"
        seeder_content += "        $bateauData = [\n"

        for key, value in boat.items():
            if key in ['zones', 'type', 'slogan', 'images']:
                continue  # On gérera séparément

            if value is None:
                seeder_content += f"            '{key}' => null,\n"
            elif isinstance(value, bool):
                seeder_content += f"            '{key}' => {'true' if value else 'false'},\n"
            elif isinstance(value, str):
                # Échapper les guillemets et antislash
                escaped = value.replace('\\', '\\\\').replace("'", "\\'").replace('\n', '\\n')
                seeder_content += f"            '{key}' => '{escaped}',\n"
            else:
                seeder_content += f"            '{key}' => {value},\n"

        seeder_content += "        ];\n\n"

        # Relations
        if boat.get('type'):
            escaped_type = boat['type'].replace("'", "\\'")
            seeder_content += f"        $type = Type::where('libelle', '{escaped_type}')->first();\n"
            seeder_content += "        $bateauData['type_id'] = $type ? $type->id : null;\n\n"

        if boat.get('slogan'):
            escaped_slogan = boat['slogan'].replace("'", "\\'")
            seeder_content += f"        $slogan = Action::where('libelle', '{escaped_slogan}')->first();\n"
            seeder_content += "        $bateauData['slogan_id'] = $slogan ? $slogan->id : null;\n\n"

        # Créer le bateau
        seeder_content += "        $bateau = Bateau::updateOrCreate(\n"
        seeder_content += "            ['slug' => $bateauData['slug']],\n"
        seeder_content += "            $bateauData\n"
        seeder_content += "        );\n\n"

        # Assigner la première zone (relation belongsTo)
        if boat.get('zones') and len(boat['zones']) > 0:
            escaped_zone = boat['zones'][0].replace("'", "\\'")
            seeder_content += f"        // Assigner la zone (première du tableau)\n"
            seeder_content += f"        $zone = Zone::where('libelle', '{escaped_zone}')->first();\n"
            seeder_content += "        if ($zone) {\n"
            seeder_content += "            $bateau->zone_id = $zone->id;\n"
            seeder_content += "            $bateau->save();\n"
            seeder_content += "        }\n\n"

        seeder_content += f"        echo \"  ✓ {{$bateau->modele}} ({{$bateau->slug}})\\n\";\n\n"

    seeder_content += """        echo "\\n✅ " . """ + str(len(boats_data)) + """ . " bateaux importés avec succès!\\n";
    }
}
"""

    # Sauvegarder le seeder
    seeder_path = 'database/seeders/BateauSeeder.php'
    with open(seeder_path, 'w', encoding='utf-8') as f:
        f.write(seeder_content)

    print(f"✅ Seeder régénéré: {seeder_path}")

if __name__ == "__main__":
    print("=" * 60)
    print("🔄 Régénération du BateauSeeder depuis le JSON")
    print("=" * 60)

    # Charger le JSON
    json_path = 'database/seeders/bateaux_scraped_data.json'
    print(f"\n📖 Lecture du fichier JSON: {json_path}")

    with open(json_path, 'r', encoding='utf-8') as f:
        boats_data = json.load(f)

    print(f"   {len(boats_data)} bateaux trouvés dans le JSON")

    # Vérifier combien ont des dates
    boats_with_dates = sum(1 for boat in boats_data if boat.get('published_at'))
    print(f"   {boats_with_dates} bateaux ont une date de publication")

    # Générer le seeder
    generate_seeder(boats_data)

    print(f"\n🎉 Régénération terminée!")
