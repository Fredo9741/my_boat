#!/usr/bin/env python3
"""
Script pour scraper les bateaux du backoffice MyBoat
et générer automatiquement un BateauSeeder Laravel

Requirements:
    pip install selenium webdriver-manager

Usage:
    python scripts/scrape_backoffice.py
"""

import json
import time
import re
from datetime import datetime
from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import WebDriverWait
from selenium.webdriver.support import expected_conditions as EC
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.chrome.options import Options
from webdriver_manager.chrome import ChromeDriverManager

# Configuration
BACKOFFICE_URL = "https://www.myboat-oi.com/backoffice/bateaux/"
LOGIN_URL = "https://www.myboat-oi.com/login"  # URL de login (à ajuster si différente)
USERNAME = "ghislain"
PASSWORD = "myboat"

def setup_driver():
    """Configure et retourne le driver Selenium"""
    options = Options()
    options.add_argument('--start-maximized')
    # options.add_argument('--headless')  # Décommenter pour mode invisible

    service = Service(ChromeDriverManager().install())
    driver = webdriver.Chrome(service=service, options=options)
    return driver

def login(driver):
    """Authentification au backoffice"""
    print("🔐 Connexion au backoffice...")

    # Essayer d'accéder directement à la liste des bateaux
    driver.get(BACKOFFICE_URL)
    time.sleep(2)

    # Si on est redirigé vers la page de login
    if '/login' in driver.current_url or 'ACCÈS BACK OFFICE' in driver.page_source:
        print("  Page de login détectée...")

        try:
            # Trouver les champs de login
            wait = WebDriverWait(driver, 10)

            # Chercher les champs avec les vrais noms du formulaire
            username_field = wait.until(EC.presence_of_element_located(
                (By.ID, 'username')
            ))
            password_field = driver.find_element(By.ID, 'password')

            # Remplir les champs
            print(f"  Saisie des identifiants...")
            username_field.clear()
            username_field.send_keys(USERNAME)
            password_field.clear()
            password_field.send_keys(PASSWORD)

            # Trouver et cliquer sur le bouton de connexion
            submit_button = driver.find_element(By.CSS_SELECTOR, 'input[type="submit"]')
            print(f"  Clic sur le bouton de connexion...")
            submit_button.click()

            # Attendre la redirection
            print("  Attente de la redirection...")
            time.sleep(5)

            # Vérifier si on est bien connecté
            if '/backoffice/' in driver.current_url and '/login' not in driver.current_url:
                print("✅ Connecté avec succès!")
                # Retourner à la liste des bateaux si on n'y est pas déjà
                if driver.current_url != BACKOFFICE_URL:
                    driver.get(BACKOFFICE_URL)
                    time.sleep(2)
            else:
                raise Exception("Échec de connexion - vérifiez les credentials")

        except Exception as e:
            print(f"❌ Erreur lors de la connexion: {e}")
            driver.save_screenshot('login_error.png')
            raise
    else:
        print("✅ Déjà connecté!")

def scrape_boat_list(driver):
    """Récupère la liste des URLs des bateaux VISIBLES uniquement"""
    print("📋 Récupération de la liste des bateaux visibles...")

    boat_links = []

    try:
        # Si on est sur une page d'édition, retourner à la liste
        if '/edition/' in driver.current_url:
            driver.get(BACKOFFICE_URL)
            time.sleep(2)

        # Chercher toutes les lignes du tableau
        rows = driver.find_elements(By.CSS_SELECTOR, 'table tbody tr[data-id]')

        total_boats = len(rows)
        visible_count = 0

        for row in rows:
            try:
                # Chercher l'icône de visibilité dans cette ligne
                # Bateau visible: <i class="fa fa-check-square fa-2x">
                # Bateau caché: <i class="fa fa-times fa-2x">
                visibility_icon = row.find_element(By.CSS_SELECTOR, 'td i.fa-check-square')

                if visibility_icon:
                    # Ce bateau est visible, récupérer le lien d'édition
                    edit_link = row.find_element(By.CSS_SELECTOR, 'a[href*="/edition/"]')
                    href = edit_link.get_attribute('href')
                    if href:
                        boat_links.append(href)
                        visible_count += 1
            except:
                # Pas d'icône fa-check-square = bateau caché, on l'ignore
                pass

        print(f"✅ {visible_count} bateaux visibles trouvés (sur {total_boats} total)")

    except Exception as e:
        print(f"❌ Erreur lors de la récupération de la liste: {e}")
        driver.save_screenshot('list_error.png')

    return boat_links

def clean_text(text):
    """Nettoie le texte scraped"""
    if not text:
        return None
    text = text.strip()
    # Décoder les entités HTML
    text = text.replace('&quot;', '"')
    text = text.replace('&amp;', '&')
    text = text.replace('&lt;', '<')
    text = text.replace('&gt;', '>')
    return text if text else None

def clean_number(text):
    """Convertit le texte en nombre"""
    if not text:
        return None
    # Enlever les espaces, virgules, symboles €, M, CV, H etc.
    cleaned = re.sub(r'[^\d.,]', '', text)
    cleaned = cleaned.replace(',', '.')
    try:
        return float(cleaned) if cleaned else None
    except:
        return None

def clean_slug(text):
    """Génère un slug depuis le texte"""
    if not text:
        return None
    slug = text.lower()
    slug = re.sub(r'[àâä]', 'a', slug)
    slug = re.sub(r'[éèêë]', 'e', slug)
    slug = re.sub(r'[îï]', 'i', slug)
    slug = re.sub(r'[ôö]', 'o', slug)
    slug = re.sub(r'[ùûü]', 'u', slug)
    slug = re.sub(r'[ç]', 'c', slug)
    slug = re.sub(r'[^a-z0-9]+', '-', slug)
    slug = slug.strip('-')
    return slug

def scrape_boat_detail(driver, url):
    """Scrape les détails d'un bateau selon la structure HTML fournie"""
    print(f"  📄 Scraping: {url}")

    driver.get(url)
    time.sleep(2)

    boat_data = {
        'visible': True,
        'occasion': None,
        'modele': None,
        'slug': None,
        'prix': None,
        'afficher_prix': True,
        'description': None,
        'chantier': None,
        'architecte': None,
        'pavillon': None,
        'annee': None,
        'materiaux': None,
        'longueurht': None,
        'largeur': None,
        'tirantdeau': None,
        'poidslegeencharges': None,
        'surfaceaupres': None,
        'heuresmoteur': None,
        'puissance': None,
        'moteur': None,
        'systemeantiderive': None,
        'cabines': None,
        'passagers': None,
        'zones': [],
        'type': None,
        'slogan': None,
        'images': []
    }

    try:
        # Visible checkbox
        try:
            visible = driver.find_element(By.ID, 'appbundle_bateau_produit_visible')
            boat_data['visible'] = visible.is_selected()
        except:
            pass

        # Zones géographiques (multi-select)
        try:
            zones_select = driver.find_element(By.ID, 'appbundle_bateau_produit_categories')
            selected_zones = zones_select.find_elements(By.CSS_SELECTOR, 'option[selected]')
            boat_data['zones'] = [clean_text(z.text) for z in selected_zones if z.text]
        except:
            pass

        # Type (marque dans le formulaire)
        try:
            type_select = driver.find_element(By.ID, 'appbundle_bateau_produit_marque')
            selected_type = type_select.find_element(By.CSS_SELECTOR, 'option[selected]')
            boat_data['type'] = clean_text(selected_type.text)
        except:
            pass

        # Modèle (titre dans le formulaire)
        try:
            modele = driver.find_element(By.ID, 'appbundle_bateau_produit_titre').get_attribute('value')
            boat_data['modele'] = clean_text(modele)
            boat_data['slug'] = clean_slug(modele)
        except:
            pass

        # Occasion checkbox
        try:
            occasion = driver.find_element(By.ID, 'appbundle_bateau_produit_occasion')
            boat_data['occasion'] = occasion.is_selected()
        except:
            boat_data['occasion'] = False

        # Prix
        try:
            prix = driver.find_element(By.ID, 'appbundle_bateau_produit_prix').get_attribute('value')
            boat_data['prix'] = clean_number(prix)
        except:
            pass

        # Description
        try:
            # La description peut être dans un éditeur WYSIWYG
            description = driver.find_element(By.ID, 'appbundle_bateau_produit_description').get_attribute('value')
            if not description:
                # Essayer de récupérer depuis l'éditeur Jodit
                description = driver.find_element(By.ID, 'appbundle_bateau_produit_description').text
            boat_data['description'] = clean_text(description)
        except:
            pass

        # Slogan
        try:
            slogan_select = driver.find_element(By.ID, 'appbundle_bateau_produit_slogan')
            selected_slogan = slogan_select.find_element(By.CSS_SELECTOR, 'option[selected]')
            slogan_text = clean_text(selected_slogan.text)
            if slogan_text and slogan_text != 'Afficher prix':
                boat_data['slogan'] = slogan_text
        except:
            pass

        # Images
        try:
            images_input = driver.find_element(By.ID, 'appbundle_bateau_produit_images').get_attribute('value')
            if images_input:
                boat_data['images'] = [img.strip() for img in images_input.split(',') if img.strip()]
        except:
            pass

        # Chantier
        try:
            chantier = driver.find_element(By.ID, 'appbundle_bateau_chantier').get_attribute('value')
            boat_data['chantier'] = clean_text(chantier)
        except:
            pass

        # Architecte
        try:
            architecte = driver.find_element(By.ID, 'appbundle_bateau_architecte').get_attribute('value')
            boat_data['architecte'] = clean_text(architecte)
        except:
            pass

        # Année
        try:
            annee = driver.find_element(By.ID, 'appbundle_bateau_annee').get_attribute('value')
            year_num = clean_number(annee)
            boat_data['annee'] = int(year_num) if year_num else None
        except:
            pass

        # Matériaux
        try:
            materiaux = driver.find_element(By.ID, 'appbundle_bateau_materiaux').get_attribute('value')
            boat_data['materiaux'] = clean_text(materiaux)
        except:
            pass

        # Pavillon
        try:
            pavillon = driver.find_element(By.ID, 'appbundle_bateau_pavillon').get_attribute('value')
            boat_data['pavillon'] = clean_text(pavillon)
        except:
            pass

        # Longueur HT
        try:
            longueur = driver.find_element(By.ID, 'appbundle_bateau_longueurht').get_attribute('value')
            boat_data['longueurht'] = clean_number(longueur)
        except:
            pass

        # Largeur
        try:
            largeur = driver.find_element(By.ID, 'appbundle_bateau_largeur').get_attribute('value')
            boat_data['largeur'] = clean_number(largeur)
        except:
            pass

        # Tirant d'eau
        try:
            tirant = driver.find_element(By.ID, 'appbundle_bateau_tirantdeau').get_attribute('value')
            boat_data['tirantdeau'] = clean_number(tirant)
        except:
            pass

        # Poids lège en charges
        try:
            poids = driver.find_element(By.ID, 'appbundle_bateau_poidslegeencharges').get_attribute('value')
            boat_data['poidslegeencharges'] = clean_number(poids)
        except:
            pass

        # Surface au près
        try:
            surface = driver.find_element(By.ID, 'appbundle_bateau_surfaceaupres').get_attribute('value')
            boat_data['surfaceaupres'] = clean_number(surface)
        except:
            pass

        # Heures moteur
        try:
            heures = driver.find_element(By.ID, 'appbundle_bateau_heuresmoteur').get_attribute('value')
            boat_data['heuresmoteur'] = clean_number(heures)
        except:
            pass

        # Puissance
        try:
            puissance = driver.find_element(By.ID, 'appbundle_bateau_puissance').get_attribute('value')
            boat_data['puissance'] = clean_number(puissance)
        except:
            pass

        # Cabines
        try:
            cabines = driver.find_element(By.ID, 'appbundle_bateau_cabines').get_attribute('value')
            cab_num = clean_number(cabines)
            boat_data['cabines'] = int(cab_num) if cab_num else None
        except:
            pass

        # Passagers
        try:
            passagers = driver.find_element(By.ID, 'appbundle_bateau_passagers').get_attribute('value')
            pass_num = clean_number(passagers)
            boat_data['passagers'] = int(pass_num) if pass_num else None
        except:
            pass

        # Moteur
        try:
            moteur = driver.find_element(By.ID, 'appbundle_bateau_moteur').get_attribute('value')
            boat_data['moteur'] = clean_text(moteur)
        except:
            pass

        # Système anti-dérive
        try:
            antiderive = driver.find_element(By.ID, 'appbundle_bateau_systemeantiderive').get_attribute('value')
            boat_data['systemeantiderive'] = clean_text(antiderive)
        except:
            pass

    except Exception as e:
        print(f"    ⚠️  Erreur lors du scraping: {e}")

    return boat_data

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
     * Auto-generated from backoffice scraping on """ + datetime.now().strftime('%Y-%m-%d %H:%M:%S') + """
     * Total bateaux: """ + str(len(boats_data)) + """
     */
    public function run(): void
    {
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

    print(f"✅ Seeder généré: {seeder_path}")

    # Aussi sauvegarder les données en JSON pour backup
    json_path = 'database/seeders/bateaux_scraped_data.json'
    with open(json_path, 'w', encoding='utf-8') as f:
        json.dump(boats_data, f, indent=2, ensure_ascii=False)

    print(f"✅ Backup JSON créé: {json_path}")

def main():
    """Fonction principale"""
    import sys
    import io

    # Fix encoding on Windows
    if sys.platform == 'win32':
        sys.stdout = io.TextIOWrapper(sys.stdout.buffer, encoding='utf-8')
        sys.stderr = io.TextIOWrapper(sys.stderr.buffer, encoding='utf-8')

    print("=" * 60)
    print("🚀 Scraping Backoffice MyBoat - Génération BateauSeeder")
    print("=" * 60)
    print()

    driver = setup_driver()
    boats_data = []

    try:
        # Connexion
        login(driver)

        # Récupérer la liste des bateaux
        boat_urls = scrape_boat_list(driver)

        if not boat_urls:
            print("⚠️  Aucun bateau trouvé. Vérifiez que vous êtes sur la bonne page.")
            print("    URL actuelle:", driver.current_url)
            driver.save_screenshot('no_boats_found.png')
            print("    Screenshot sauvegardée: no_boats_found.png")
            return

        # Scraper chaque bateau
        print(f"\n📦 Scraping de {len(boat_urls)} bateaux...\n")
        for i, url in enumerate(boat_urls, 1):
            print(f"[{i}/{len(boat_urls)}]", end=" ")
            boat_data = scrape_boat_detail(driver, url)

            # Ne garder que les bateaux avec au moins un modèle
            if boat_data.get('modele'):
                boats_data.append(boat_data)
            else:
                print(f"    ⚠️  Bateau sans modèle, ignoré")

            time.sleep(1)  # Pause pour ne pas surcharger le serveur

        # Générer le seeder
        if boats_data:
            generate_seeder(boats_data)
            print(f"\n🎉 Scraping terminé! {len(boats_data)} bateaux récupérés.")
            print("\n📋 Prochaines étapes:")
            print("  1. Vérifiez le fichier: database/seeders/BateauSeeder.php")
            print("  2. Exécutez: php artisan db:seed --class=BateauSeeder")
        else:
            print("\n⚠️  Aucun bateau avec modèle n'a été trouvé.")

    except Exception as e:
        print(f"\n❌ Erreur fatale: {e}")
        import traceback
        traceback.print_exc()
        driver.save_screenshot('error_final.png')
        print("Screenshot d'erreur sauvegardée: error_final.png")

    finally:
        # Fermer le navigateur
        print("\n🔒 Fermeture du navigateur...")
        driver.quit()
        print("✅ Terminé!\n")

if __name__ == "__main__":
    main()
