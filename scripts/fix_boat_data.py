#!/usr/bin/env python3
"""
Script pour corriger les données aberrantes dans bateaux_scraped_data.json
"""

import json
import sys
import io

# Fix encoding on Windows
if sys.platform == 'win32':
    sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
    sys.stderr = io.TextIOWrapper(sys.stderr.buffer, encoding='utf-8')

def fix_boat_data(boat):
    """Corrige les données aberrantes d'un bateau"""
    corrections = []

    # 1. Longueur HT : si > 100, diviser par 100
    if boat.get('longueurht') and boat['longueurht'] > 100:
        old_val = boat['longueurht']
        boat['longueurht'] = round(boat['longueurht'] / 100, 2)
        corrections.append(f"longueurht: {old_val} → {boat['longueurht']}")

    # 2. Tirant d'eau : si > 10, diviser par 100
    if boat.get('tirantdeau') and boat['tirantdeau'] > 10:
        old_val = boat['tirantdeau']
        boat['tirantdeau'] = round(boat['tirantdeau'] / 100, 2)
        corrections.append(f"tirantdeau: {old_val} → {boat['tirantdeau']}")

    # 3. Largeur : si > 20, diviser par 100
    if boat.get('largeur') and boat['largeur'] > 20:
        old_val = boat['largeur']
        boat['largeur'] = round(boat['largeur'] / 100, 2)
        corrections.append(f"largeur: {old_val} → {boat['largeur']}")

    # 4. Année : si > 2025 ou < 1900, extraire les 4 premiers chiffres
    if boat.get('annee'):
        year = boat['annee']
        if year > 2025 or year < 1900:
            # Extraire les 4 premiers chiffres
            year_str = str(year)
            if len(year_str) >= 4:
                new_year = int(year_str[:4])
                if 1900 <= new_year <= 2025:
                    old_val = boat['annee']
                    boat['annee'] = new_year
                    corrections.append(f"annee: {old_val} → {new_year}")
                else:
                    # Valeur aberrante, mettre null
                    corrections.append(f"annee: {year} → null (aberrant)")
                    boat['annee'] = None

    # 5. Passagers : corriger les valeurs collées (81=8, 68=8, 46=6, etc.)
    if boat.get('passagers'):
        passagers = boat['passagers']
        # Liste des valeurs suspectes (formats "X-Y" collés en "XY")
        if passagers in [81, 68, 46, 42, 28, 24, 61, 62]:
            old_val = passagers
            pass_str = str(passagers)
            # Prendre le plus grand des deux chiffres comme capacité max
            if len(pass_str) == 2:
                digit1, digit2 = int(pass_str[0]), int(pass_str[1])
                new_pass = max(digit1, digit2)
                boat['passagers'] = new_pass
                corrections.append(f"passagers: {old_val} → {new_pass} ('{digit1}-{digit2}' collé)")
        # Si > 100, prendre les 2 premiers chiffres
        elif passagers > 100:
            old_val = passagers
            pass_str = str(passagers)
            if len(pass_str) >= 2:
                new_pass = int(pass_str[:2])
                if new_pass > 0:
                    boat['passagers'] = new_pass
                    corrections.append(f"passagers: {old_val} → {new_pass}")

    # 6. Cabines : si > 20, prendre le premier chiffre
    if boat.get('cabines') and boat['cabines'] > 20:
        old_val = boat['cabines']
        cab_str = str(boat['cabines'])
        new_cab = int(cab_str[0])
        if new_cab > 0:
            boat['cabines'] = new_cab
            corrections.append(f"cabines: {old_val} → {new_cab}")

    # 7. Puissance : si > 1000, probablement deux puissances collées (ex: 2150 = 2x150, 4502 = 2x450)
    if boat.get('puissance') and boat['puissance'] > 1000:
        old_val = boat['puissance']
        # Garder les 3 ou 2 derniers chiffres (la puissance unitaire)
        puiss_str = str(int(boat['puissance']))
        if len(puiss_str) >= 3:
            new_puiss = float(puiss_str[-3:])
            boat['puissance'] = new_puiss
            corrections.append(f"puissance: {old_val} → {new_puiss}")

    # 8. Heures moteur : si > 100000, probablement deux valeurs collées
    if boat.get('heuresmoteur') and boat['heuresmoteur'] > 100000:
        old_val = boat['heuresmoteur']
        # Prendre les 4 derniers chiffres
        heures_str = str(int(boat['heuresmoteur']))
        if len(heures_str) >= 4:
            new_heures = float(heures_str[-4:])
            boat['heuresmoteur'] = new_heures
            corrections.append(f"heuresmoteur: {old_val} → {new_heures}")

    # 9. Surface au près : si > 200, diviser par 10 (probablement en cm² au lieu de m²)
    if boat.get('surfaceaupres') and boat['surfaceaupres'] > 200:
        old_val = boat['surfaceaupres']
        boat['surfaceaupres'] = round(boat['surfaceaupres'] / 10, 1)
        corrections.append(f"surfaceaupres: {old_val} → {boat['surfaceaupres']}")

    # 10. Longueur aberrante : si > 1000, probablement corruption de données
    if boat.get('longueurht') and boat['longueurht'] > 1000:
        old_val = boat['longueurht']
        # Essayer de récupérer les 1-2 premiers chiffres raisonnables
        length_str = str(int(boat['longueurht']))
        if len(length_str) >= 2:
            # Prendre les 2 premiers chiffres comme mètres
            new_length = float(length_str[:2])
            if 5 <= new_length <= 30:  # Plage raisonnable pour un bateau
                boat['longueurht'] = new_length
                corrections.append(f"longueurht: {old_val} → {new_length}")
            else:
                # Données trop corrompues, mettre null
                boat['longueurht'] = None
                corrections.append(f"longueurht: {old_val} → null (données corrompues)")

    # 11. Tirant d'eau aberrant : si > 5m, probablement centimètres mal divisés
    if boat.get('tirantdeau') and boat['tirantdeau'] > 5:
        old_val = boat['tirantdeau']
        # Diviser par 10 (ex: 16.83 → 1.683, 7.02 → 0.702)
        boat['tirantdeau'] = round(boat['tirantdeau'] / 10, 2)
        corrections.append(f"tirantdeau: {old_val} → {boat['tirantdeau']}")

    # 12. Largeur aberrante : si > 100, probablement centimètres mal divisés
    if boat.get('largeur') and boat['largeur'] > 100:
        old_val = boat['largeur']
        boat['largeur'] = round(boat['largeur'] / 100, 2)
        corrections.append(f"largeur: {old_val} → {boat['largeur']}")

    return boat, corrections

def main():
    print("🔧 Correction des données des bateaux...\n")

    # Charger le JSON
    with open('database/seeders/bateaux_scraped_data.json', 'r', encoding='utf-8') as f:
        boats = json.load(f)

    total_corrections = 0

    for i, boat in enumerate(boats, 1):
        boat, corrections = fix_boat_data(boat)

        if corrections:
            print(f"Bateau {i}: {boat['modele']}")
            for corr in corrections:
                print(f"  ✓ {corr}")
            total_corrections += len(corrections)
            print()

    # Sauvegarder le JSON corrigé
    with open('database/seeders/bateaux_scraped_data.json', 'w', encoding='utf-8') as f:
        json.dump(boats, f, indent=2, ensure_ascii=False)

    print(f"\n✅ {total_corrections} corrections appliquées!")
    print(f"📁 Fichier JSON mis à jour: database/seeders/bateaux_scraped_data.json")

    # Maintenant régénérer le seeder
    print("\n🔄 Régénération du BateauSeeder.php...")

    # Importer la fonction de génération du seeder
    from scrape_backoffice import generate_seeder
    generate_seeder(boats)

    print("\n🎉 Terminé! Les fichiers sont prêts à être utilisés.")

if __name__ == "__main__":
    main()
