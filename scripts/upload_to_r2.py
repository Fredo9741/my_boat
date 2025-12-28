#!/usr/bin/env python3
"""
Script pour uploader les photos des bateaux vers Cloudflare R2
"""

import os
import sys
import io
import json
import boto3
from pathlib import Path
from botocore.exceptions import ClientError

# Fix encoding on Windows
if sys.platform == 'win32':
    sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
    sys.stderr = io.TextIOWrapper(sys.stderr.buffer, encoding='utf-8')

# Configuration R2 (à remplacer par tes vraies credentials)
R2_ACCOUNT_ID = "YOUR_ACCOUNT_ID"
R2_ACCESS_KEY_ID = "YOUR_ACCESS_KEY_ID"
R2_SECRET_ACCESS_KEY = "YOUR_SECRET_ACCESS_KEY"
R2_BUCKET_NAME = "YOUR_BUCKET_NAME"
R2_PUBLIC_URL = f"https://pub-{R2_ACCOUNT_ID}.r2.dev"  # Ou ton domaine custom

# Configuration locale
PHOTOS_DIR = "storage/app/public/bateaux_photos"
JSON_FILE = "database/seeders/bateaux_scraped_data.json"

def create_r2_client():
    """Crée un client boto3 pour R2"""
    return boto3.client(
        's3',
        endpoint_url=f'https://{R2_ACCOUNT_ID}.r2.cloudflarestorage.com',
        aws_access_key_id=R2_ACCESS_KEY_ID,
        aws_secret_access_key=R2_SECRET_ACCESS_KEY,
        region_name='auto'
    )

def upload_file_to_r2(client, local_path, r2_key):
    """Upload un fichier vers R2"""
    try:
        with open(local_path, 'rb') as f:
            # Déterminer le content-type
            ext = os.path.splitext(local_path)[1].lower()
            content_types = {
                '.jpg': 'image/jpeg',
                '.jpeg': 'image/jpeg',
                '.png': 'image/png',
                '.gif': 'image/gif',
                '.webp': 'image/webp'
            }
            content_type = content_types.get(ext, 'application/octet-stream')

            client.put_object(
                Bucket=R2_BUCKET_NAME,
                Key=r2_key,
                Body=f,
                ContentType=content_type,
                # Rendre le fichier public
                ACL='public-read'
            )
        return True
    except ClientError as e:
        print(f"    ❌ Erreur upload: {e}")
        return False

def main():
    print("=" * 70)
    print("📤 UPLOAD DES PHOTOS VERS CLOUDFLARE R2")
    print("=" * 70)
    print()

    # Vérifier que le dossier photos existe
    if not os.path.exists(PHOTOS_DIR):
        print(f"❌ Dossier photos non trouvé: {PHOTOS_DIR}")
        print("   Exécutez d'abord: python scripts/download_photos.py")
        return

    # Créer le client R2
    print("🔗 Connexion à Cloudflare R2...")
    try:
        r2_client = create_r2_client()
        # Test de connexion
        r2_client.head_bucket(Bucket=R2_BUCKET_NAME)
        print("✅ Connexion réussie!\n")
    except Exception as e:
        print(f"❌ Erreur de connexion: {e}")
        print("\n💡 Vérifiez vos credentials R2 dans le script!")
        return

    # Parcourir les dossiers de photos
    total_uploaded = 0
    total_errors = 0
    boats_processed = 0

    for boat_folder in sorted(os.listdir(PHOTOS_DIR)):
        boat_path = os.path.join(PHOTOS_DIR, boat_folder)

        if not os.path.isdir(boat_path):
            continue

        photos = [f for f in os.listdir(boat_path) if os.path.isfile(os.path.join(boat_path, f))]

        if not photos:
            continue

        boats_processed += 1
        print(f"[{boats_processed}] 📁 {boat_folder} ({len(photos)} photos)")

        for photo in photos:
            local_path = os.path.join(boat_path, photo)
            # Structure dans R2: bateaux/{boat_folder}/{photo}
            r2_key = f"bateaux/{boat_folder}/{photo}"

            if upload_file_to_r2(r2_client, local_path, r2_key):
                total_uploaded += 1
                print(f"    ✓ {photo}")
            else:
                total_errors += 1

    print()
    print("=" * 70)
    print("📊 RÉSUMÉ")
    print("=" * 70)
    print(f"  ✅ {total_uploaded} photos uploadées avec succès")
    print(f"  ❌ {total_errors} erreurs")
    print(f"  📁 {boats_processed} bateaux traités")
    print()
    print("🔄 Prochaine étape:")
    print(f"   Mettre à jour les URLs dans la base de données avec:")
    print(f"   {R2_PUBLIC_URL}/bateaux/{{boat_folder}}/{{photo}}")
    print()

if __name__ == "__main__":
    # Afficher les instructions si pas configuré
    if "YOUR_ACCOUNT_ID" in [R2_ACCOUNT_ID, R2_ACCESS_KEY_ID]:
        print("⚠️  CONFIGURATION REQUISE")
        print()
        print("Éditez le fichier scripts/upload_to_r2.py et configurez:")
        print("  - R2_ACCOUNT_ID")
        print("  - R2_ACCESS_KEY_ID")
        print("  - R2_SECRET_ACCESS_KEY")
        print("  - R2_BUCKET_NAME")
        print()
        print("📖 Trouvez ces infos dans votre dashboard Cloudflare:")
        print("   R2 > Manage R2 API Tokens")
        sys.exit(1)

    main()
