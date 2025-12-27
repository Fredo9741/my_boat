# Guide de Déploiement Railway - My Boat

## ⚠️ IMPORTANT : Gestion des Données

### Politique de Seeding

Les seeders sont configurés pour **NE PAS ÉCRASER** vos données existantes :

- ✅ **Types de bateaux** : Seedés uniquement si la table est vide
- ✅ **Zones géographiques** : Seedées uniquement si la table est vide
- ✅ **Actions/Slogans** : Seedés uniquement si la table est vide
- ✅ **Équipements** : Seedés uniquement si la table est vide
- ✅ **Utilisateur admin** : Créé uniquement si aucun utilisateur n'existe

**Vos modifications manuelles dans l'admin sont TOUJOURS préservées** lors des redéploiements.

### Correction One-Time des Catégories d'Équipements

Si vous avez des équipements avec des catégories en majuscules (Navigation, Confort, etc.), exécutez UNE SEULE FOIS :

```bash
# En local
php artisan equipements:fix-categories

# Sur Railway (via Railway CLI)
railway run php artisan equipements:fix-categories
```

Cette commande convertit les catégories de majuscules vers minuscules sans supprimer vos équipements.

## 🚀 Déploiement Initial

### 1. Configuration des Variables d'Environnement

Assurez-vous que toutes les variables d'environnement sont configurées dans Railway :

```env
APP_NAME="My Boat"
APP_ENV=production
APP_KEY=base64:... # Généré avec php artisan key:generate
APP_DEBUG=false
APP_URL=https://votre-domaine.up.railway.app

DB_CONNECTION=mysql
DB_HOST=containers-us-west-xxx.railway.app
DB_PORT=3306
DB_DATABASE=railway
DB_USERNAME=root
DB_PASSWORD=xxx

CLOUDFLARE_R2_ACCESS_KEY_ID=xxx
CLOUDFLARE_R2_SECRET_ACCESS_KEY=xxx
CLOUDFLARE_R2_BUCKET=my-boat
CLOUDFLARE_R2_ENDPOINT=https://xxx.r2.cloudflarestorage.com
CLOUDFLARE_R2_URL=https://files.fredlabs.org

FILESYSTEM_DISK=cloudflare
```

### 2. Commandes de Déploiement

Le fichier `railway/setup.sh` s'exécute automatiquement lors de chaque déploiement et effectue :

1. Migration de la base de données
2. Optimisation de Laravel (config, routes, views)
3. **Seeding des données essentielles** (types, zones, slogans, équipements)

## 📊 Seeders Automatiques

Les seeders suivants s'exécutent **automatiquement** à chaque déploiement :

### 1. **TypeSeeder** - Types de bateaux
- Voilier
- Catamaran
- Yacht
- Bateau à moteur
- Semi-rigide
- Bateau de pêche
- Et autres...

### 2. **ZoneSeeder** - Zones géographiques
- La Réunion
- Maurice
- Madagascar
- Seychelles
- Mayotte
- Comores

### 3. **ActionSeeder** - Slogans avec couleurs
- Affaire à saisir (orange)
- Coup de coeur (pink)
- État exceptionnel (green)
- Exclusivité (purple)
- Grand entretien récent (blue)
- Nouveau sur le marché (blue)
- Prix en baisse ! (orange)
- Sous offre (yellow)
- Vendu (gray)
- Et autres...

### 4. **EquipementSeeder** - Équipements (avec icônes)

#### Navigation (6 équipements)
- GPS (fa-location-dot)
- Pilote automatique (fa-route)
- Compas (fa-compass)
- Anémomètre (fa-wind)
- Loch/Speedomètre (fa-gauge)
- Sondeur (fa-water)

#### Confort (9 équipements)
- Climatisation (fa-snowflake)
- Chauffage (fa-fire)
- Congélateur (fa-ice-cream)
- Réfrigérateur (fa-refrigerator)
- Eau chaude (fa-faucet-drip)
- Douche de pont (fa-shower)
- Toilettes marines (fa-restroom)
- Dessalinisateur (fa-droplet)
- TV/Système audio (fa-tv)

#### Sécurité (8 équipements)
- Radeau de survie (fa-life-ring)
- Gilets de sauvetage (fa-vest)
- Extincteurs (fa-fire-extinguisher)
- EPIRB (fa-tower-broadcast)
- Fusées de détresse (fa-rocket)
- Harnais et longes (fa-link)
- Pompes de cale (fa-pump)

#### Électronique (9 équipements)
- VHF (fa-radio)
- AIS (fa-satellite-dish)
- Radar (fa-radar)
- Traceur GPS (fa-map-location-dot)
- Panneau solaire (fa-solar-panel)
- Éolienne (fa-fan)
- Groupe électrogène (fa-plug)
- Convertisseur (fa-bolt)
- Chargeur de batterie (fa-car-battery)

#### Manœuvre (8 équipements)
- Guindeau électrique (fa-anchor)
- Winch électrique (fa-gears)
- Propulseur d'étrave (fa-jet-fighter)
- Propulseur de poupe (fa-jet-fighter)
- Enrouleur de génois (fa-circle-notch)
- Lazy bag (fa-bag-shopping)
- Bôme (fa-minus)
- Tangon de spi (fa-arrows-left-right)

#### Loisirs (10 équipements)
- Annexe (fa-person-swimming)
- Moteur hors-bord (fa-propeller)
- Paddle/SUP (fa-person-walking)
- Matériel de plongée (fa-person-swimming)
- Matériel de pêche (fa-fish)
- Kayak (fa-kayaking)
- Équipement de snorkeling (fa-mask-snorkel)
- Barbecue (fa-fire-burner)
- Bimini/Taud de soleil (fa-umbrella-beach)
- Taud de mouillage (fa-tarp)

### 5. **UserSeeder** - Utilisateur admin
Crée un compte administrateur par défaut si aucun utilisateur n'existe.

## 🔄 Re-seeding Manuel

Si vous avez besoin de réinitialiser les données de référence :

### En local (développement)
```bash
# Tous les seeders
php artisan db:seed --force

# Un seeder spécifique
php artisan db:seed --class=EquipementSeeder --force
php artisan db:seed --class=ActionSeeder --force
php artisan db:seed --class=TypeSeeder --force
php artisan db:seed --class=ZoneSeeder --force
```

### Sur Railway (production)
Les seeders s'exécutent automatiquement lors du déploiement via `railway/setup.sh`.

Si vous devez les relancer manuellement :
1. Connectez-vous à Railway CLI
2. Exécutez : `railway run php artisan db:seed --force`

## ⚠️ Important

### Données NON seedées automatiquement
- **Bateaux** : Ajoutés manuellement via le panel d'administration
- **Médias** : Uploadés via Cloudflare R2
- **Relations bateau-équipement** : Configurées dans l'admin

### Données Seedées Automatiquement
- Types de bateaux
- Zones géographiques
- Slogans (Actions) avec couleurs
- Équipements avec icônes
- Utilisateur admin (si table users vide)

## 🔧 Troubleshooting

### Les équipements ne s'affichent pas
1. Vérifiez que le seeder a bien été exécuté
2. Les catégories doivent être en **minuscules** :
   - navigation
   - confort
   - securite
   - electronique
   - manoeuvre
   - loisirs

### Les couleurs des slogans ne s'affichent pas
Les couleurs disponibles sont :
- green
- yellow
- red
- blue
- purple
- pink
- orange
- gray

### Reset complet des données de référence
```bash
# En local
php artisan migrate:fresh --seed

# ⚠️ ATTENTION : Supprime TOUTES les données !
```

## 📝 Checklist de Déploiement

- [ ] Variables d'environnement configurées dans Railway
- [ ] Base de données MySQL créée et connectée
- [ ] Cloudflare R2 configuré
- [ ] `railway/setup.sh` exécutable (`chmod +x railway/setup.sh`)
- [ ] Premier déploiement effectué
- [ ] Seeders exécutés automatiquement
- [ ] Vérification des données dans la base :
  - [ ] Types de bateaux présents
  - [ ] Zones géographiques présentes
  - [ ] Slogans avec couleurs présents
  - [ ] Équipements avec catégories en minuscules présents
  - [ ] Utilisateur admin créé
- [ ] Ajout manuel des bateaux via l'admin
- [ ] Upload des photos via Cloudflare R2
- [ ] Assignment des équipements aux bateaux

## 🚨 En cas de problème

1. Vérifiez les logs Railway : `railway logs`
2. Vérifiez que le script setup.sh s'est bien exécuté
3. Vérifiez les données en base :
   ```sql
   SELECT COUNT(*) FROM types;
   SELECT COUNT(*) FROM zones;
   SELECT COUNT(*) FROM actions;
   SELECT COUNT(*) FROM equipements;
   SELECT categorie, COUNT(*) FROM equipements GROUP BY categorie;
   ```

## 📞 Support

Pour toute question ou problème, consultez :
- Railway Dashboard : https://railway.app
- Logs Railway : `railway logs`
- Laravel Logs : Accessible via Railway shell
