#!/usr/bin/env python3
"""
Script pour mapper les anciens types vers les nouveaux types
"""

import json
import sys
import io

# Fix encoding on Windows
if sys.platform == 'win32':
    sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
    sys.stderr = io.TextIOWrapper(sys.stderr.buffer, encoding='utf-8')

# Charger les données
boats = json.load(open('database/seeders/bateaux_scraped_data.json', 'r', encoding='utf-8'))

# Mapping ancien → nouveau
type_mapping = {
    'Monocoque': 'Voilier monocoque',
    'Multicoques': 'Catamaran à voile',
    'Catamaran moteur': 'Catamaran à moteur',
    'Bateau Moteur': 'Bateau Moteur',
    'Bateau neuf': 'Bateau Moteur'  # Par défaut
}

print("🔄 Correction des types de bateaux...\n")

corrections = 0
for boat in boats:
    if boat.get('type'):
        old_type = boat['type']
        if old_type in type_mapping:
            new_type = type_mapping[old_type]
            if old_type != new_type:
                boat['type'] = new_type
                corrections += 1
                print(f"{boat['modele']}: {old_type} -> {new_type}")

# Sauvegarder
json.dump(boats, open('database/seeders/bateaux_scraped_data.json', 'w', encoding='utf-8'), indent=2, ensure_ascii=False)
print(f"\n✅ {corrections} types corrigés")

# Régénérer le seeder
print("\n🔄 Régénération du seeder...")
from scrape_backoffice import generate_seeder
generate_seeder(boats)
print("✅ Seeder régénéré!")
