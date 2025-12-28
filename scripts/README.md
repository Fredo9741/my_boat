# Script de Scraping du Backoffice MyBoat

Ce script automatise le scraping des bateaux depuis le backoffice MyBoat et génère automatiquement un seeder Laravel.

## 📋 Prérequis

### Python 3.7+
Vérifiez votre version :
```bash
python --version
```

### Installer les dépendances
```bash
pip install selenium webdriver-manager
```

## 🚀 Utilisation

### 1. Exécuter le script
Depuis le dossier racine du projet :
```bash
python scripts/scrape_backoffice.py
```

### 2. Ce que fait le script

1. **Connexion automatique** au backoffice avec les credentials
2. **Récupération de la liste** de tous les bateaux
3. **Scraping détaillé** de chaque fiche bateau :
   - Informations de base (modèle, prix, description)
   - Caractéristiques techniques (chantier, année, matériaux)
   - Dimensions (longueur, largeur, tirant d'eau)
   - Motorisation (moteur, puissance, heures)
   - Accommodations (cabines, passagers)
   - Relations (zone, type, slogan)
   - Équipements associés

4. **Génération automatique** de 2 fichiers :
   - `database/seeders/BateauSeeder.php` - Seeder Laravel prêt à l'emploi
   - `database/seeders/bateaux_data.json` - Backup JSON des données

### 3. Utiliser le seeder généré

Une fois le seeder généré, vous pouvez l'exécuter :

```bash
# En local
php artisan db:seed --class=BateauSeeder

# Sur Railway
railway run php artisan db:seed --class=BateauSeeder
```

## ⚙️ Configuration

Si les sélecteurs CSS ne fonctionnent pas (le backoffice a une structure différente), vous devrez adapter les sélecteurs dans le fichier `scrape_backoffice.py`.

### Zones à adapter si nécessaire :

1. **Login** (ligne ~50) :
```python
username_field = wait.until(EC.presence_of_element_located(
    (By.CSS_SELECTOR, 'input[name="username"]')  # ← Modifier ici
))
```

2. **Liste des bateaux** (ligne ~90) :
```python
links = driver.find_elements(By.CSS_SELECTOR, 'a[href*="bateau"]')  # ← Modifier ici
```

3. **Champs de formulaire** (lignes ~150+) :
Chaque champ a son sélecteur CSS. Exemple :
```python
modele = driver.find_element(By.CSS_SELECTOR, '#modele').get_attribute('value')
```

## 🐛 Debugging

### Le script ne trouve pas les champs

Le script prend automatiquement des captures d'écran en cas d'erreur :
- `login_error.png` - Erreur de connexion
- `list_error.png` - Erreur liste des bateaux
- `no_boats_found.png` - Aucun bateau trouvé

Examinez ces captures pour comprendre la structure réelle de la page.

### Mode visible (pour voir ce qui se passe)

Par défaut, le navigateur s'affiche. Pour le cacher (plus rapide) :
```python
# Ligne 29 - Décommenter cette ligne :
options.add_argument('--headless')
```

### Ajouter des pauses

Si le script va trop vite, ajoutez des pauses :
```python
time.sleep(5)  # Pause de 5 secondes
```

## 📊 Sortie attendue

Le script affiche sa progression :
```
🚀 Démarrage du scraping du backoffice MyBoat

🔐 Connexion au backoffice...
✅ Connecté avec succès!

📋 Récupération de la liste des bateaux...
✅ 25 bateaux trouvés

📦 Scraping de 25 bateaux...

[1/25]   📄 Scraping: https://www.myboat-oi.com/backoffice/bateaux/1
[2/25]   📄 Scraping: https://www.myboat-oi.com/backoffice/bateaux/2
...

📝 Génération du seeder Laravel...
✅ Seeder généré: ../database/seeders/BateauSeeder.php
✅ Backup JSON créé: ../database/seeders/bateaux_data.json

🎉 Scraping terminé! 25 bateaux récupérés.

🔒 Fermeture du navigateur...
```

## 🔧 Dépannage

### WebDriver Error
Si vous avez une erreur de WebDriver :
```bash
pip install --upgrade webdriver-manager
```

### Chrome not found
Le script utilise Chrome. Si vous n'avez pas Chrome :
1. Installez Chrome : https://www.google.com/chrome/
2. Ou modifiez le script pour utiliser Firefox :
```python
from selenium.webdriver.firefox.service import Service
from webdriver_manager.firefox import GeckoDriverManager

driver = webdriver.Firefox(service=Service(GeckoDriverManager().install()))
```

### Timeout errors
Augmentez les délais d'attente :
```python
wait = WebDriverWait(driver, 20)  # Au lieu de 10
```

## 📝 Notes importantes

- ⚠️ Le script respecte un délai de 1 seconde entre chaque bateau pour ne pas surcharger le serveur
- ✅ Les données sont sauvegardées en JSON pour backup
- ✅ Le seeder utilise `updateOrCreate` avec le slug comme clé unique
- ✅ Les relations (zones, types, slogans) sont résolues automatiquement

## 🆘 Support

Si le script ne fonctionne pas :
1. Vérifiez que vous avez bien installé les dépendances
2. Examinez les captures d'écran d'erreur
3. Vérifiez que les credentials sont corrects
4. Testez la connexion manuelle au backoffice
