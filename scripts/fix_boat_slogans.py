#!/usr/bin/env python3
"""
Script pour mapper les anciens slogans vers les nouveaux
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
slogan_mapping = {
    'Baisse de prix': 'Prix en baisse !',
    'Coup de coeur': 'Coup de coeur',
    'Nouveau': 'Nouveau sur le marché',
    'VENDU': 'Vendu'
}

print("🔄 Correction des slogans/badges...\n")

corrections = 0
for boat in boats:
    if boat.get('slogan'):
        old_slogan = boat['slogan']
        if old_slogan in slogan_mapping:
            new_slogan = slogan_mapping[old_slogan]
            if old_slogan != new_slogan:
                boat['slogan'] = new_slogan
                corrections += 1
                print(f"{boat['modele']}: {old_slogan} -> {new_slogan}")

# Sauvegarder
json.dump(boats, open('database/seeders/bateaux_scraped_data.json', 'w', encoding='utf-8'), indent=2, ensure_ascii=False)
print(f"\n✅ {corrections} slogans corrigés")

# Régénérer le seeder
print("\n🔄 Régénération du seeder...")
from scrape_backoffice import generate_seeder
generate_seeder(boats)
print("✅ Seeder régénéré!")
