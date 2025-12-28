#!/usr/bin/env python3
"""
Vérification manuelle des données bateaux basée sur la logique
et les descriptions (sans recherche web)
"""

import json
import sys
import io
import re

# Fix encoding on Windows
if sys.platform == 'win32':
    sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
    sys.stderr = io.TextIOWrapper(sys.stderr.buffer, encoding='utf-8')

def extract_specs_from_description(description, modele):
    """Extrait les specs mentionnées dans la description"""
    issues = []

    # Chercher les moteurs mentionnés
    motor_patterns = [
        r'(\d+)\s*moteurs?\s+.*?(\d+)\s*[cC][vV]',  # "2 moteurs 450 CV"
        r'(\d+)\s*[xX]\s*(\d+)\s*[cC][vV]',          # "2x115 CV"
        r'moteur.*?(\d+)\s*[cC][vV]',                # "moteur 40 CV"
    ]

    motors_info = None
    for pattern in motor_patterns:
        match = re.search(pattern, description)
        if match:
            groups = match.groups()
            if len(groups) == 2:
                motors_info = {'count': int(groups[0]), 'cv': int(groups[1])}
            elif len(groups) == 1:
                motors_info = {'count': 1, 'cv': int(groups[0])}
            break

    # Chercher dimensions
    length_match = re.search(r'(\d+)[.,](\d+)\s*m', description)
    if length_match:
        length_from_desc = float(f"{length_match.group(1)}.{length_match.group(2)}")
    else:
        length_from_desc = None

    # Chercher passagers
    passengers_patterns = [
        r'(\d+)\s*(?:à|a)\s*(\d+)\s*personnes',  # "6 à 8 personnes"
        r'(\d+)\s*passagers',                      # "8 passagers"
        r'capacité[:\s]+(\d+)',                    # "Capacité : 8"
    ]

    passengers_from_desc = None
    for pattern in passengers_patterns:
        match = re.search(pattern, description, re.IGNORECASE)
        if match:
            groups = match.groups()
            if len(groups) == 2:
                passengers_from_desc = int(groups[1])  # Prendre le max
            else:
                passengers_from_desc = int(groups[0])
            break

    return {
        'motors': motors_info,
        'length': length_from_desc,
        'passengers': passengers_from_desc
    }

def verify_boat(boat, index):
    """Vérifie un bateau et retourne les problèmes trouvés"""
    problems = []
    modele = boat.get('modele', f'Bateau {index}')

    # Extraire les specs de la description
    desc_specs = extract_specs_from_description(
        boat.get('description', ''),
        modele
    )

    # 1. Vérifier la puissance avec description
    if desc_specs['motors'] and boat.get('puissance'):
        expected_cv = desc_specs['motors']['cv']
        motor_count = desc_specs['motors']['count']
        current_cv = boat['puissance']

        # La puissance devrait être soit unitaire soit totale
        if current_cv != expected_cv and current_cv != (expected_cv * motor_count):
            problems.append({
                'field': 'puissance',
                'current': current_cv,
                'expected': f"{expected_cv} (unitaire) ou {expected_cv * motor_count} (total)",
                'reason': f"Description mentionne {motor_count}x{expected_cv} CV"
            })

    # 2. Vérifier les passagers suspects
    if boat.get('passagers'):
        passengers = boat['passagers']
        length = boat.get('longueurht', 0)

        # Si passagers semble être un nombre collé (68, 81, 28, etc.)
        if passengers in [68, 81, 28, 46, 42, 24, 62, 61]:
            # Probablement "6-8" collé en "68"
            pass_str = str(passengers)
            if len(pass_str) == 2:
                suggested = int(pass_str[1])  # Prendre le deuxième chiffre
                problems.append({
                    'field': 'passagers',
                    'current': passengers,
                    'expected': f"{pass_str[0]}-{pass_str[1]} (mettre {suggested})",
                    'reason': f"Valeur suspecte, probablement '{pass_str[0]}-{pass_str[1]}' collé"
                })

        # Vérifier cohérence avec description
        if desc_specs['passengers'] and desc_specs['passengers'] != passengers:
            if passengers > 20:  # Seulement si aberrant
                problems.append({
                    'field': 'passagers',
                    'current': passengers,
                    'expected': desc_specs['passengers'],
                    'reason': f"Description mentionne {desc_specs['passengers']} personnes"
                })

    # 3. Vérifier longueur null
    if boat.get('longueurht') is None:
        if desc_specs['length']:
            problems.append({
                'field': 'longueurht',
                'current': 'null',
                'expected': desc_specs['length'],
                'reason': f"Description mentionne {desc_specs['length']}m"
            })
        else:
            problems.append({
                'field': 'longueurht',
                'current': 'null',
                'expected': '?',
                'reason': 'Longueur manquante, vérifier modèle'
            })

    # 4. Tirant d'eau aberrant
    if boat.get('tirantdeau'):
        draft = boat['tirantdeau']
        if draft > 5:
            problems.append({
                'field': 'tirantdeau',
                'current': draft,
                'expected': f"~{draft/10:.2f}",
                'reason': f"{draft}m est aberrant, probablement en cm"
            })

    # 5. Largeur aberrante
    if boat.get('largeur') and boat.get('longueurht'):
        width = boat['largeur']
        length = boat['longueurht']

        # Ratio largeur/longueur normal: 25-65%
        if length > 0:
            ratio = (width / length) * 100
            if ratio > 80 or ratio < 15:
                problems.append({
                    'field': 'largeur',
                    'current': width,
                    'expected': '?',
                    'reason': f"Ratio largeur/longueur = {ratio:.0f}% (anormal)"
                })

    return problems

def main():
    print("🔍 Vérification manuelle des données bateaux...\n")

    # Charger le JSON
    with open('database/seeders/bateaux_scraped_data.json', 'r', encoding='utf-8') as f:
        boats = json.load(f)

    critical_problems = []
    minor_problems = []
    ok_boats = []

    for i, boat in enumerate(boats, 1):
        modele = boat.get('modele', f'Bateau {i}')
        problems = verify_boat(boat, i)

        if problems:
            # Séparer critiques et mineurs
            critical = [p for p in problems if p['field'] in ['longueurht', 'passagers', 'puissance']]
            minor = [p for p in problems if p not in critical]

            if critical:
                critical_problems.append({'index': i, 'modele': modele, 'problems': critical})
            if minor:
                minor_problems.append({'index': i, 'modele': modele, 'problems': minor})
        else:
            ok_boats.append({'index': i, 'modele': modele})

    # Générer le rapport
    report = []
    report.append("=" * 70)
    report.append("RAPPORT DE VÉRIFICATION DES BATEAUX")
    report.append("=" * 70)
    report.append("")

    if critical_problems:
        report.append("🚨 PROBLÈMES CRITIQUES:")
        report.append("")
        for boat in critical_problems:
            report.append(f"Bateau {boat['index']}: {boat['modele']}")
            for prob in boat['problems']:
                report.append(f"  ❌ {prob['field']}: {prob['current']} → devrait être {prob['expected']}")
                report.append(f"     Raison: {prob['reason']}")
            report.append("")

    if minor_problems:
        report.append("⚠️  PROBLÈMES MINEURS:")
        report.append("")
        for boat in minor_problems:
            report.append(f"Bateau {boat['index']}: {boat['modele']}")
            for prob in boat['problems']:
                report.append(f"  ⚠️  {prob['field']}: {prob['current']} → {prob['expected']}")
                report.append(f"     Raison: {prob['reason']}")
            report.append("")

    report.append("✅ BATEAUX OK:")
    report.append("")
    for boat in ok_boats:
        report.append(f"  ✓ Bateau {boat['index']}: {boat['modele']}")
    report.append("")

    report.append("=" * 70)
    report.append("RÉSUMÉ:")
    report.append(f"  🚨 {len(critical_problems)} bateaux avec problèmes critiques")
    report.append(f"  ⚠️  {len(minor_problems)} bateaux avec problèmes mineurs")
    report.append(f"  ✅ {len(ok_boats)} bateaux OK")
    report.append("=" * 70)

    # Afficher à l'écran
    for line in report:
        print(line)

    # Sauvegarder dans un fichier
    with open('boat_verification_report.txt', 'w', encoding='utf-8') as f:
        f.write('\n'.join(report))

    print(f"\n📄 Rapport sauvegardé: boat_verification_report.txt")

if __name__ == "__main__":
    main()
