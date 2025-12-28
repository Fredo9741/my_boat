#!/usr/bin/env python3
"""
Script pour télécharger toutes les photos des bateaux depuis le JSON
et les organiser dans des dossiers

Requirements:
    pip install requests

Usage:
    python scripts/download_photos.py
"""

import json
import os
import requests
from pathlib import Path
from urllib.parse import urlparse
import time
import sys
import io

# Fix encoding on Windows
if sys.platform == 'win32':
    sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
    sys.stderr = io.TextIOWrapper(sys.stderr.buffer, encoding='utf-8')

# Configuration
JSON_FILE = 'database/seeders/bateaux_scraped_data.json'
OUTPUT_DIR = 'storage/app/public/bateaux_photos'
BASE_URL = 'https://www.myboat-oi.com'

def sanitize_filename(filename):
    """Nettoie un nom de fichier pour éviter les problèmes"""
    # Remplacer les caractères problématiques
    invalid_chars = '<>:"/\\|?*'
    for char in invalid_chars:
        filename = filename.replace(char, '_')
    return filename

def download_image(url, output_path):
    """Télécharge une image depuis une URL"""
    try:
        # Si l'URL est relative, ajouter le domaine
        if url.startswith('/'):
            url = BASE_URL + url

        response = requests.get(url, timeout=30)
        response.raise_for_status()

        # Sauvegarder l'image
        with open(output_path, 'wb') as f:
            f.write(response.content)

        return True
    except Exception as e:
        print(f"    ⚠️  Erreur téléchargement: {e}")
        return False

def get_image_extension(url):
    """Extrait l'extension de l'image depuis l'URL"""
    parsed = urlparse(url)
    path = parsed.path
    ext = os.path.splitext(path)[1]
    if not ext:
        ext = '.jpg'  # Extension par défaut
    return ext

def main():
    """Fonction principale"""
    print("=" * 60)
    print("📸 Téléchargement des photos des bateaux")
    print("=" * 60)
    print()

    # Vérifier que le fichier JSON existe
    if not os.path.exists(JSON_FILE):
        print(f"❌ Fichier {JSON_FILE} introuvable!")
        print("   Exécutez d'abord le script de scraping.")
        return

    # Charger les données
    print(f"📂 Lecture du fichier {JSON_FILE}...")
    with open(JSON_FILE, 'r', encoding='utf-8') as f:
        boats_data = json.load(f)

    print(f"✅ {len(boats_data)} bateaux trouvés\n")

    # Créer le dossier de sortie
    os.makedirs(OUTPUT_DIR, exist_ok=True)

    # Statistiques
    total_photos = 0
    total_downloaded = 0
    total_errors = 0
    boats_without_photos = 0

    # Parcourir chaque bateau
    for i, boat in enumerate(boats_data, 1):
        modele = boat.get('modele', f'bateau_{i}')
        images = boat.get('images', [])

        if not images:
            boats_without_photos += 1
            print(f"[{i}/{len(boats_data)}] ⚠️  {modele} - Aucune photo")
            continue

        # Utiliser le nom du modèle comme nom de dossier
        folder_name = sanitize_filename(modele)
        folder_path = os.path.join(OUTPUT_DIR, folder_name)

        # Créer le dossier du bateau
        os.makedirs(folder_path, exist_ok=True)

        print(f"[{i}/{len(boats_data)}] 📦 {modele} ({len(images)} photos)")
        print(f"             Dossier: {folder_name}/")

        # Télécharger chaque image
        for j, image_url in enumerate(images, 1):
            if not image_url:
                continue

            total_photos += 1

            # Extension de l'image
            ext = get_image_extension(image_url)

            # Nom du fichier: 01.jpg, 02.jpg, etc.
            filename = f"{j:02d}{ext}"
            output_path = os.path.join(folder_path, filename)

            # Télécharger si pas déjà présent
            if os.path.exists(output_path):
                print(f"    ✓ {filename} (existe déjà)")
                total_downloaded += 1
            else:
                print(f"    ⬇️  Téléchargement {filename}...", end=" ")
                if download_image(image_url, output_path):
                    print("✓")
                    total_downloaded += 1
                else:
                    print("✗")
                    total_errors += 1

                # Petite pause pour ne pas surcharger le serveur
                time.sleep(0.5)

        print()

    # Rapport final
    print("=" * 60)
    print("📊 Rapport de téléchargement")
    print("=" * 60)
    print(f"Bateaux traités:     {len(boats_data)}")
    print(f"Bateaux sans photos: {boats_without_photos}")
    print(f"Photos totales:      {total_photos}")
    print(f"Téléchargées:        {total_downloaded}")
    print(f"Erreurs:             {total_errors}")
    print()
    print(f"📁 Dossier de sortie: {os.path.abspath(OUTPUT_DIR)}")
    print()

    if total_errors > 0:
        print("⚠️  Certaines photos n'ont pas pu être téléchargées.")
        print("   Relancez le script pour réessayer.")
    else:
        print("✅ Toutes les photos ont été téléchargées avec succès!")

if __name__ == "__main__":
    main()
