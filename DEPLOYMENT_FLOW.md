# 🔄 Flux de Déploiement Railway - MyBoat

Ce document explique **EXACTEMENT** ce qui se passe lors d'un push vers Railway et dans quel ordre.

---

## 📊 Vue d'Ensemble du Processus

```
GitHub Push → Railway Build → Init Script → Start App
```

---

## 🎬 Étape par Étape

### 1️⃣ **PUSH VERS GITHUB**

```bash
git add .
git commit -m "Your message"
git push
```

**Ce qui se passe :**
- Le code est poussé vers votre repo GitHub
- Railway détecte le nouveau commit (webhook)
- Railway déclenche un nouveau déploiement

---

### 2️⃣ **BUILD PHASE (Nixpacks)**

**Fichier de configuration :** `nixpacks.toml`

```toml
[phases.setup]
nixPkgs = ['...']

[phases.install]
cmds = ['...']

[phases.build]
cmds = ['...']

[start]
cmd = "bash railway/init-app.sh && frankenphp php-server --listen :$PORT"
```

**Ce qui se passe :**
1. ✅ Nixpacks installe PHP, Composer, Node.js
2. ✅ `composer install` (installe dépendances Laravel)
3. ✅ `npm install && npm run build` (compile assets Vite)
4. ✅ Prépare l'image Docker

**Durée :** ~2-3 minutes

---

### 3️⃣ **INIT SCRIPT** (`railway/init-app.sh`)

**🔍 C'EST LA PARTIE CRUCIALE QUE NOUS AVONS OPTIMISÉE**

Le script détecte le mode via des variables d'environnement :

#### MODE A : FRESH DATABASE (`FRESH_DB=true`)

**Utilisé pour :** Première installation, migration vers nouvelle base

```bash
# 1. Reset complet de la base
php artisan migrate:fresh --force
# → Drop toutes les tables
# → Recrée toutes les tables (migrations)

# 2. Import complet des données
php artisan db:seed --class=FreshDatabaseSeeder --force
# → TypeSeeder (10 types de bateaux)
# → ZoneSeeder (5 zones)
# → ActionSeeder (4 actions)
# → EquipementSeeder (20 équipements)
# → UserSeeder (1 admin)
# → BateauSeeder (55 bateaux)
# → BateauMediaSeeder (~150 médias)

# 3. Migration photos vers R2 (si MIGRATE_PHOTOS_TO_R2=true)
php artisan photos:migrate-to-r2
# → Télécharge 150+ images depuis myboat-oi.com
# → Upload vers Cloudflare R2
# → Met à jour les URLs en base
```

**Ordre d'exécution des seeders :**
```
1. TypeSeeder          → Types de bateaux (dépendance: aucune)
2. ZoneSeeder          → Zones géographiques (dépendance: aucune)
3. ActionSeeder        → Actions/Slogans (dépendance: aucune)
4. EquipementSeeder    → Équipements (dépendance: aucune)
5. UserSeeder          → Admin user (dépendance: aucune)
6. BateauSeeder        → 55 bateaux (dépend: types, zones, actions)
7. BateauMediaSeeder   → ~150 images (dépend: bateaux)
```

**⏱️ Durée :**
- Sans migration photos : ~1-2 minutes
- Avec migration photos : ~12-15 minutes

---

#### MODE B : DÉPLOIEMENT NORMAL (par défaut)

**Utilisé pour :** Mises à jour régulières, nouveaux features

```bash
# 1. Migrations incrémentales seulement
php artisan migrate --force
# → Applique SEULEMENT les nouvelles migrations
# → NE touche PAS aux données existantes

# 2. Seeders essentiels (idempotents)
php artisan db:seed --force
# → DatabaseSeeder (vérifie existence avant insertion)
# → Types, Zones, Actions, Équipements
# → Ne re-seed PAS les bateaux
```

**⏱️ Durée :** ~30 secondes

---

### 4️⃣ **OPTIMISATIONS** (toujours exécutées)

```bash
# Clear all caches
php artisan optimize:clear

# Rebuild caches
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache
```

**⏱️ Durée :** ~10 secondes

---

### 5️⃣ **START APPLICATION**

```bash
frankenphp php-server --listen :$PORT
```

- ✅ Application démarre sur le port Railway
- ✅ Health check effectué (`/`)
- ✅ Service devient accessible

---

## 🎯 Configuration des Variables Railway

### Variables PERMANENTES (toujours présentes)

```env
# Database
DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

# Storage
FILESYSTEM_DISK=cloudflare
CLOUDFLARE_R2_ACCESS_KEY_ID=xxx
CLOUDFLARE_R2_SECRET_ACCESS_KEY=xxx
CLOUDFLARE_R2_BUCKET=myboat
CLOUDFLARE_R2_URL=https://pub-xxx.r2.dev
CLOUDFLARE_R2_ENDPOINT=https://xxx.r2.cloudflarestorage.com

# App
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:xxx
APP_URL=https://xxx.up.railway.app
```

### Variables TEMPORAIRES (première installation uniquement)

```env
# ⚠️ AJOUTER pour le PREMIER déploiement :
FRESH_DB=true
MIGRATE_PHOTOS_TO_R2=true

# 💡 SUPPRIMER après le premier déploiement réussi !
```

---

## 📋 Scénarios de Déploiement

### 🆕 Scénario 1 : Nouvelle Base de Données (VOTRE CAS)

**Étapes :**

1. ✅ Créer base MySQL sur Railway
2. ✅ Configurer toutes les variables (DB + R2)
3. ✅ **Ajouter** `FRESH_DB=true` et `MIGRATE_PHOTOS_TO_R2=true`
4. ✅ Push vers GitHub
5. ⏳ Attendre 12-15 minutes (Railway build + init + photos)
6. ✅ Vérifier l'app : 55 bateaux + photos visibles
7. ✅ **SUPPRIMER** `FRESH_DB=true` et `MIGRATE_PHOTOS_TO_R2=true`

**Résultat attendu :**
- ✅ Base de données complète
- ✅ 55 bateaux importés
- ✅ ~150 photos sur Cloudflare R2
- ✅ Admin accessible (admin@myboat.com / password)

---

### 🔄 Scénario 2 : Mise à Jour Normale

**Exemple :** Vous ajoutez une nouvelle fonctionnalité

**Étapes :**

1. ✅ Coder votre feature
2. ✅ Créer migration si nécessaire (`php artisan make:migration`)
3. ✅ Push vers GitHub
4. ⏳ Attendre 3-4 minutes (Railway build + migrate)
5. ✅ Nouvelle version déployée

**Ce qui se passe :**
- ✅ Migrations appliquées (nouvelles colonnes, tables, etc.)
- ✅ Code mis à jour
- ❌ AUCUNE donnée supprimée (seeders idempotents)
- ❌ PAS de reset de la base

---

### 🚨 Scénario 3 : Reset Complet de la Base (Dangereux)

**Exemple :** Vous voulez repartir de zéro

**⚠️ ATTENTION : Supprime TOUTES les données !**

**Étapes :**

1. ⚠️ Sauvegarder les données importantes
2. ✅ **Ajouter** `FRESH_DB=true` dans Railway Variables
3. ✅ Push vers GitHub (ou juste redéployer)
4. ⏳ Base complètement reset
5. ✅ **SUPPRIMER** `FRESH_DB=true`

---

## 🔍 Vérification des Logs Railway

Pour suivre le déploiement en temps réel :

1. Railway → Votre Service → **Deployments**
2. Cliquer sur le dernier déploiement
3. **View Logs**

**Ce que vous verrez :**

```
🚀 Starting My Boat deployment...
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🆕 MODE FRESH DATABASE - Setup complet
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
📋 Running migrations (fresh)...
Dropped all tables successfully.
Migration table created successfully.
Migrating: 0001_01_01_000000_create_users_table
Migrated:  0001_01_01_000000_create_users_table (123.45ms)
...
🌱 Seeding complete database (types, zones, bateaux, medias)...

╔══════════════════════════════════════════════════════════════╗
║  🔄 FRESH DATABASE SEEDER - Reset complet de la base       ║
╚══════════════════════════════════════════════════════════════╝

🧹 ÉTAPE 1/2 : Nettoyage complet de la base...
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
  ℹ️  MySQL: Foreign keys temporairement désactivées
  ✓ Table pivot Bateau-Equipement supprimée(s) (0 enregistrements)
  ✓ Médias supprimée(s) (0 enregistrements)
  ✓ Bateaux supprimée(s) (0 enregistrements)
  ...
  ✅ Nettoyage terminé!

🌱 ÉTAPE 2/2 : Population de la base avec des données fraîches...
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━

  → Seeding : Types de bateaux...
  ✅ 10 types de bateaux créés

  → Seeding : Zones géographiques...
  ✅ 5 zones créées

  ... (etc)

  → Seeding : Bateaux (55 annonces)...
  ✅ 55 bateaux créés

  → Seeding : Médias des bateaux...
  ✅ 150 images ajoutées pour 55 bateaux

📸 Migrating photos to Cloudflare R2...
⏳ This may take 5-10 minutes...
[Progress bar: 150/150]
✅ Migration terminée !

┌──────────────┬────────┐
│ Statut       │ Nombre │
├──────────────┼────────┤
│ ✅ Migrées   │ 150    │
│ ❌ Échouées  │ 0      │
└──────────────┴────────┘

⚡ Optimizing Laravel...
✅ Optimization complete!

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
🎉 Deployment ready!
━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
```

---

## ⚠️ Erreurs Possibles et Solutions

### Erreur : "SQLSTATE[HY000] [2002] Connection refused"

**Cause :** Variables MySQL incorrectes

**Solution :**
```bash
# Vérifier dans Railway → Variables
DB_HOST=${MYSQLHOST}  # Doit référencer le service MySQL
```

---

### Erreur : "Class FreshDatabaseSeeder not found"

**Cause :** Autoload pas à jour

**Solution :** Ajouter dans Railway Variables :
```env
COMPOSER_NO_DEV=false
```

---

### Erreur : Photos migration timeout

**Cause :** Connexion lente, timeout Railway

**Solution :** Ne pas inclure `MIGRATE_PHOTOS_TO_R2=true`, migrer manuellement :
```bash
railway run php artisan photos:migrate-to-r2
```

---

## 📚 Résumé

### ✅ CE QUI FONCTIONNE AUTOMATIQUEMENT

- Migrations de la base (via `init-app.sh`)
- Seeders (via `FRESH_DB=true` la première fois)
- Migration photos (via `MIGRATE_PHOTOS_TO_R2=true`)
- Optimisations Laravel (toujours)

### ❌ CE QUI NE FONCTIONNE PAS AUTOMATIQUEMENT

- Génération de `APP_KEY` (faire manuellement : `php artisan key:generate`)
- Configuration domaine personnalisé (faire dans Railway UI)
- Changement mot de passe admin (faire manuellement après)

---

**Dernière mise à jour :** 2025-01-15
