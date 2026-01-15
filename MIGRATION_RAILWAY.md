# 🚀 Guide de Migration - Nouvelle Base Railway (MySQL)

## 📋 Vue d'ensemble

Ce guide détaille les étapes pour migrer votre application MyBoat vers une nouvelle base de données MySQL sur Railway avec toutes les migrations et seeders.

---

## 🎯 Plan de Migration

### Phase 1 : Préparation Railway
### Phase 2 : Configuration des variables d'environnement
### Phase 3 : Exécution de la migration
### Phase 4 : Vérifications post-migration

---

## 📦 PHASE 1 : Préparation Railway

### 1.1 Créer la nouvelle base MySQL

1. Aller sur [Railway.app](https://railway.app)
2. Sélectionner votre projet MyBoat
3. Cliquer sur **"New"** → **"Database"** → **"MySQL"**
4. Attendre que la base soit provisionnée (1-2 minutes)

### 1.2 Récupérer les credentials

Railway va générer automatiquement :
- `MYSQL_URL` (URL complète)
- `MYSQLHOST`
- `MYSQLPORT`
- `MYSQLDATABASE`
- `MYSQLUSER`
- `MYSQLPASSWORD`

**⚠️ Notez ces valeurs, vous en aurez besoin !**

### 1.3 Supprimer l'ancienne base (optionnel)

Une fois la migration réussie :
1. Allez dans l'ancienne base de données
2. Onglet **"Settings"** → **"Danger"** → **"Delete Service"**

---

## ⚙️ PHASE 2 : Configuration des Variables

### 2.1 Variables de Base de Données (MySQL)

Dans Railway → Votre Service → **"Variables"** :

```env
# Base de données MySQL
DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}
```

### 2.2 Variables Cloudflare R2 (OBLIGATOIRE)

```env
# Configuration du stockage (Cloudflare R2)
FILESYSTEM_DISK=cloudflare
CLOUDFLARE_R2_ACCESS_KEY_ID=votre_access_key_id
CLOUDFLARE_R2_SECRET_ACCESS_KEY=votre_secret_access_key
CLOUDFLARE_R2_BUCKET=myboat
CLOUDFLARE_R2_URL=https://pub-xxxxxxxxxxxxx.r2.dev
CLOUDFLARE_R2_ENDPOINT=https://xxxxxxxxxxxxx.r2.cloudflarestorage.com
```

**💡 Comment obtenir vos credentials Cloudflare R2 :**

1. Aller sur [Cloudflare Dashboard](https://dash.cloudflare.com)
2. **R2 Storage** → Créer un bucket nommé `myboat`
3. **R2 API Tokens** → **Create API Token**
4. Copier :
   - Access Key ID
   - Secret Access Key
   - Endpoint URL
   - Public URL du bucket

### 2.3 Variables Application

```env
# Application
APP_NAME="MyBoat Ocean Indien"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://votre-app.up.railway.app

# Générer une nouvelle clé : php artisan key:generate
APP_KEY=base64:xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx

# Session & Cache
SESSION_DRIVER=database
CACHE_DRIVER=database
```

---

## 🚀 PHASE 3 : Exécution de la Migration

### Option A : Via Railway CLI (RECOMMANDÉ)

```bash
# 1. Installer Railway CLI
npm i -g @railway/cli

# 2. Se connecter
railway login

# 3. Lier votre projet
railway link

# 4. Exécuter le script de migration
railway run bash scripts/fresh-railway-migration.sh
```

### Option B : Commandes manuelles

```bash
# Via Railway CLI
railway run php artisan migrate:fresh --force
railway run php artisan db:seed --class=FreshDatabaseSeeder --force
railway run php artisan optimize
```

### Option C : Depuis l'interface Railway

1. Aller dans **"Settings"** → **"Deploy"**
2. Ajouter un **Custom Start Command** temporaire :
   ```bash
   php artisan migrate:fresh --force && php artisan db:seed --class=FreshDatabaseSeeder --force && php -S 0.0.0.0:$PORT -t public
   ```
3. Déclencher un redéploiement
4. ⚠️ Remettre le start command normal après :
   ```bash
   php -S 0.0.0.0:$PORT -t public
   ```

---

## 🔍 PHASE 4 : Vérifications Post-Migration

### 4.1 Vérifier les données

Connectez-vous à votre base Railway :

```bash
# Via Railway CLI
railway connect MySQL

# Ou directement
mysql -h MYSQLHOST -P MYSQLPORT -u MYSQLUSER -p MYSQLDATABASE
```

Puis exécutez :

```sql
-- Vérifier les tables
SHOW TABLES;

-- Vérifier les counts
SELECT 'Users' as Table_Name, COUNT(*) as Count FROM users
UNION SELECT 'Types', COUNT(*) FROM types
UNION SELECT 'Zones', COUNT(*) FROM zones
UNION SELECT 'Actions', COUNT(*) FROM actions
UNION SELECT 'Equipements', COUNT(*) FROM equipements
UNION SELECT 'Bateaux', COUNT(*) FROM bateaux
UNION SELECT 'Medias', COUNT(*) FROM medias;
```

**Résultats attendus :**
- Users : 1
- Types : ~10
- Zones : ~5
- Actions : ~4
- Equipements : ~20
- Bateaux : 55
- Medias : ~150+

### 4.2 Tester l'application

1. **Page d'accueil** : `https://votre-app.up.railway.app`
   - ✅ Les bateaux s'affichent
   - ✅ Les filtres fonctionnent

2. **Page bateau** : Cliquer sur un bateau
   - ✅ Les images s'affichent (depuis myboat-oi.com temporairement)
   - ✅ Les informations sont complètes

3. **Admin** : `https://votre-app.up.railway.app/admin`
   - Email : `admin@myboat.com`
   - Password : `password`
   - ✅ Login fonctionne
   - ✅ Liste des bateaux visible

4. **Upload de photo** (Test R2) :
   - Aller dans Admin → Éditer un bateau
   - Uploader une nouvelle image
   - ✅ L'image doit être visible immédiatement
   - ✅ Vérifier dans Cloudflare R2 que le fichier est bien uploadé

---

## 📸 Comprendre le Système de Photos

### Photos Actuelles (Seedées)

Les 55 bateaux importés ont des photos qui pointent vers :
```
https://www.myboat-oi.com/wp-content/uploads/...
```

**Fonctionnement :**
- ✅ Elles s'affichent tant que myboat-oi.com est en ligne
- ⚠️ Elles ne sont PAS sur votre Cloudflare R2
- 💡 C'est temporaire et ça fonctionne grâce au helper `r2_url()`

### Nouvelles Photos (Uploadées)

Quand vous uploadez une nouvelle photo :
1. Elle est stockée dans Cloudflare R2 : `images/{bateau_id}/filename.jpg`
2. Le chemin relatif est enregistré en base : `images/123/photo.jpg`
3. Le helper `r2_url()` transforme en URL complète : `https://pub-xxx.r2.dev/images/123/photo.jpg`

### Migration des anciennes photos vers R2 (RECOMMANDÉ)

**⚠️ IMPORTANT :** Après une migration réussie, il est fortement recommandé de migrer toutes les photos de myboat-oi.com vers votre Cloudflare R2.

**Pourquoi ?**
- Les photos actuelles dépendent du site myboat-oi.com (si ce site tombe, vos photos disparaissent)
- Les photos sur votre R2 seront plus rapides à charger
- Vous aurez le contrôle total de vos assets

**Comment faire :**

```bash
# 1. Test en mode dry-run (simulation sans modification)
railway run php artisan photos:migrate-to-r2 --dry-run

# 2. Migration réelle (télécharge et upload toutes les photos)
railway run php artisan photos:migrate-to-r2
```

**Ce que fait cette commande :**
1. Parcourt toutes les images en base (environ 150+)
2. Télécharge chaque image depuis myboat-oi.com
3. Upload vers Cloudflare R2 : `bateaux/{bateau_id}/{filename}.jpg`
4. Met à jour les URLs dans la table `medias`

**Durée estimée :** 5-10 minutes pour 150 images (dépend de votre connexion)

**Résultat attendu :**
```
✅ Migration terminée !

┌──────────────┬────────┐
│ Statut       │ Nombre │
├──────────────┼────────┤
│ ✅ Migrées   │ 150    │
│ ❌ Échouées  │ 0      │
│ ⏭️ Ignorées  │ 0      │
│ ✔️ Déjà migrées │ 0   │
└──────────────┴────────┘
```

---

## 🛠️ Ordre des Migrations

Les migrations sont exécutées dans cet ordre (automatiquement) :

### 1. Tables Laravel (Framework)
- `users`
- `cache`
- `jobs`

### 2. Tables de Référence (Pas de dépendances)
- `types` - Types de bateaux
- `zones` - Zones géographiques
- `actions` - Slogans/Actions

### 3. Table Principale
- `bateaux` - Dépend de : types, zones, actions

### 4. Tables Dépendantes
- `medias` - Dépend de : bateaux
- `equipements` - Pas de dépendance
- `bateau_equipement` - Dépend de : bateaux, equipements
- `settings` - Pas de dépendance

### 5. Migrations Additionnelles
- Colonnes supplémentaires
- Index
- Modifications de schéma

---

## 🌱 Ordre des Seeders

Le `FreshDatabaseSeeder` exécute dans cet ordre :

```
1. TypeSeeder          → Types de bateaux (Catamaran, Voilier, etc.)
2. ZoneSeeder          → Zones (Réunion, Maurice, Madagascar, etc.)
3. ActionSeeder        → Actions (Coup de cœur, Vendu, etc.)
4. EquipementSeeder    → Équipements (GPS, VHF, Pilote auto, etc.)
5. UserSeeder          → Utilisateur admin (admin@myboat.com)
6. BateauSeeder        → 55 bateaux avec toutes leurs données
7. BateauMediaSeeder   → ~150+ images liées aux bateaux
```

**⚠️ Important :** Ne jamais modifier cet ordre, il respecte les dépendances !

---

## 🔧 Dépannage

### Erreur : "SQLSTATE[HY000] [2002] Connection refused"

**Cause :** Variables de connexion MySQL incorrectes

**Solution :**
```bash
# Vérifier vos variables Railway
railway variables

# Vérifier depuis l'app
railway run php artisan db:show
```

### Erreur : "Class 'FreshDatabaseSeeder' not found"

**Cause :** Autoload pas à jour

**Solution :**
```bash
railway run composer dump-autoload
railway run php artisan db:seed --class=FreshDatabaseSeeder --force
```

### Erreur : "SQLSTATE[42S01]: Base table or view already exists"

**Cause :** Tables déjà présentes

**Solution :** Utiliser `migrate:fresh` au lieu de `migrate`
```bash
railway run php artisan migrate:fresh --force
```

### Les images ne s'affichent pas

**Vérifier :**

1. Les URLs dans la base :
```sql
SELECT id, type, url FROM medias LIMIT 5;
```

2. Variables Cloudflare R2 :
```bash
railway run php artisan tinker --execute="
echo env('CLOUDFLARE_R2_URL');
echo PHP_EOL;
echo env('FILESYSTEM_DISK');
"
```

3. Tester le helper :
```bash
railway run php artisan tinker --execute="
echo r2_url('images/test.jpg');
"
```

---

## ✅ Checklist Finale

### Phase 1 : Migration de base (OBLIGATOIRE)

- [ ] Base MySQL créée sur Railway
- [ ] Variables d'environnement configurées (DB + R2)
- [ ] Migrations exécutées avec succès
- [ ] Seeders exécutés avec succès
- [ ] Page d'accueil fonctionne
- [ ] 55 bateaux visibles
- [ ] Images des bateaux s'affichent (depuis myboat-oi.com)
- [ ] Admin accessible (admin@myboat.com / password)
- [ ] Upload de nouvelle photo fonctionne (test R2)
- [ ] Optimisations effectuées (`config:cache`, `route:cache`)

### Phase 2 : Migration des photos (RECOMMANDÉ)

- [ ] Test de migration en dry-run : `photos:migrate-to-r2 --dry-run`
- [ ] Migration réelle des photos : `photos:migrate-to-r2`
- [ ] Vérification : toutes les images affichent correctement
- [ ] Vérification : URLs en base ne contiennent plus myboat-oi.com
- [ ] Vérification : fichiers présents dans Cloudflare R2

---

## 📞 Support

En cas de problème :

1. Vérifier les logs Railway : **"Deployments"** → **"View Logs"**
2. Checker la doc : [docs/DEPLOYMENT.md](docs/DEPLOYMENT.md)
3. Tester en local d'abord avec une base MySQL
4. Contacter le support Railway si problème d'infrastructure

---

## 🎉 Prochaines Étapes

Après une migration réussie :

1. **Nom de domaine personnalisé**
   - Railway → Settings → Domains
   - Ajouter votre domaine (ex: myboat-oi.com)

2. **SSL/HTTPS**
   - Automatiquement géré par Railway

3. **Monitoring**
   - Activer les alertes Railway
   - Configurer un outil comme Sentry (optionnel)

4. **Backups**
   - Railway fait des backups automatiques
   - Configurer des exports réguliers si besoin

5. **Migration photos R2** (optionnel)
   - Développer un script pour migrer les photos de myboat-oi.com vers R2
   - Mettre à jour les URLs en base

---

**Dernière mise à jour :** 2025-01-15
