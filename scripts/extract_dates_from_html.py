#!/usr/bin/env python3
"""
Script pour extraire les dates de publication depuis le HTML du backoffice
"""

import re
import json
from datetime import datetime
from bs4 import BeautifulSoup

def extract_boat_dates(html_file):
    """Extrait les dates de publication des bateaux depuis le HTML"""

    with open(html_file, 'r', encoding='utf-8') as f:
        html_content = f.read()

    soup = BeautifulSoup(html_content, 'html.parser')

    # Trouver toutes les lignes du tableau
    rows = soup.find_all('tr', {'data-id': True})

    boat_dates = {}

    for row in rows:
        try:
            # Récupérer l'ID du bateau
            boat_id = row.get('data-id')

            # Trouver le lien d'édition pour récupérer le slug
            edit_link = row.find('a', href=re.compile(r'/backoffice/bateaux/edition/'))
            if not edit_link:
                continue

            # Trouver la première image pour identifier le bateau
            img = row.find('img', src=True)
            if not img:
                continue

            img_src = img['src']

            # Trouver la colonne avec data-order (timestamp) et la date
            date_td = row.find('td', {'data-order': True})
            if not date_td:
                continue

            timestamp = int(date_td['data-order'])
            date_text = date_td.get_text(strip=True)

            # Convertir le timestamp en datetime
            published_at = datetime.fromtimestamp(timestamp)

            boat_dates[boat_id] = {
                'timestamp': timestamp,
                'date_text': date_text,
                'published_at': published_at.isoformat(),
                'image': img_src
            }

            print(f"Bateau ID {boat_id}: {date_text} (TS: {timestamp})")

        except Exception as e:
            print(f"Erreur ligne bateau: {e}")
            continue

    return boat_dates

def match_dates_to_json(boat_dates, json_file):
    """Associe les dates aux bateaux du JSON en matchant par image"""

    # Charger le JSON des bateaux
    with open(json_file, 'r', encoding='utf-8') as f:
        boats = json.load(f)

    matched = 0

    for boat in boats:
        if not boat.get('images') or len(boat['images']) == 0:
            continue

        # Prendre la première image du bateau
        first_image = boat['images'][0]
        image_filename = first_image.split('/')[-1]

        # Chercher dans les dates extraites
        for boat_id, date_info in boat_dates.items():
            html_image_filename = date_info['image'].split('/')[-1]

            if image_filename == html_image_filename:
                boat['published_at'] = date_info['published_at']
                matched += 1
                print(f"✓ Matched {boat['modele']}: {date_info['date_text']}")
                break

    # Sauvegarder le JSON mis à jour
    with open(json_file, 'w', encoding='utf-8') as f:
        json.dump(boats, f, indent=2, ensure_ascii=False)

    print(f"\n✅ {matched}/{len(boats)} bateaux matchés avec succès!")
    return matched

if __name__ == "__main__":
    import sys
    import io

    # Fix encoding for Windows console
    if sys.platform == 'win32':
        sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')

    print("📅 Extraction des dates de publication...\n")

    # Extraire les dates du HTML
    boat_dates = extract_boat_dates('bateauhtml.html')
    print(f"\n✅ {len(boat_dates)} dates extraites du HTML\n")

    # Matcher avec le JSON
    print("🔗 Association avec les bateaux du JSON...\n")
    match_dates_to_json(boat_dates, 'database/seeders/bateaux_scraped_data.json')
