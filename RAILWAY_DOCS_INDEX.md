# 📚 Documentation Railway - Index

Guide complet pour déployer MyBoat sur Railway avec une nouvelle base de données MySQL.

---

## 🎯 Par où commencer ?

### 👉 Vous voulez migrer vers Railway MAINTENANT ?
**→ Lire : [QUICK_START_RAILWAY.md](QUICK_START_RAILWAY.md)**
- Guide rapide en 3 étapes
- Temps de lecture : 5 minutes
- Temps d'exécution : 15 minutes

---

### 👉 Vous voulez comprendre le processus complet ?
**→ Lire : [DEPLOYMENT_FLOW.md](DEPLOYMENT_FLOW.md)**
- Explication détaillée du flux de déploiement
- Ce qui se passe lors d'un push
- Ordre exact d'exécution des scripts
- Scénarios de déploiement

---

### 👉 Vous voulez tous les détails techniques ?
**→ Lire : [MIGRATION_RAILWAY.md](MIGRATION_RAILWAY.md)**
- Guide complet (20+ pages)
- Ordre des migrations et seeders
- Configuration détaillée Cloudflare R2
- Dépannage approfondi
- Checklist complète

---

## 📂 Structure de la Documentation

```
my_boat/
│
├── 📄 QUICK_START_RAILWAY.md         ← Commencez ici !
│   └─ Guide rapide en 3 étapes
│
├── 📄 DEPLOYMENT_FLOW.md             ← Comprendre le processus
│   └─ Flux détaillé du déploiement Railway
│
├── 📄 MIGRATION_RAILWAY.md           ← Référence complète
│   └─ Guide exhaustif avec tous les détails
│
├── 📄 .env.railway.example           ← Template de configuration
│   └─ Toutes les variables d'environnement Railway
│
├── 📁 scripts/
│   ├── 📄 README_RAILWAY.md          ← Documentation des scripts
│   ├── 🚀 complete-railway-setup.sh  ← Setup complet (migrations + photos)
│   └── 📦 fresh-railway-migration.sh ← Setup sans migration photos
│
└── 📁 railway/
    ├── 📄 README.md                  ← Architecture Railway
    └── 🔧 init-app.sh                ← Script exécuté à chaque déploiement
```

---

## 🚀 Workflow Recommandé

### Étape 1 : Lecture Rapide
**📖 Lire :** [QUICK_START_RAILWAY.md](QUICK_START_RAILWAY.md)
- ⏱️ 5 minutes
- Comprendre les 3 étapes principales

### Étape 2 : Préparation
**✅ Préparer :**
- Compte Railway créé
- Base MySQL Railway créée
- Credentials Cloudflare R2 obtenus

**📋 Template :** [.env.railway.example](.env.railway.example)
- Copier toutes les variables dans Railway
- Remplir les credentials R2

### Étape 3 : Configuration
**⚙️ Dans Railway → Variables :**
```env
# Base de données (auto)
DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
...

# Cloudflare R2 (manuel)
CLOUDFLARE_R2_ACCESS_KEY_ID=xxx
...

# PREMIÈRE INSTALLATION SEULEMENT
FRESH_DB=true
MIGRATE_PHOTOS_TO_R2=true
```

### Étape 4 : Déploiement
**🚢 Push vers GitHub :**
```bash
git add .
git commit -m "Setup Railway avec nouvelle base MySQL"
git push
```

**⏳ Attendre 12-15 minutes**
- Railway build
- Migrations + Seeders
- Migration photos vers R2

### Étape 5 : Vérification
**✅ Tester :**
- Page d'accueil : 55 bateaux visibles
- Admin : login avec admin@myboat.com
- Upload photo : test Cloudflare R2

### Étape 6 : Nettoyage
**🧹 Dans Railway → Variables :**
- **SUPPRIMER** `FRESH_DB=true`
- **SUPPRIMER** `MIGRATE_PHOTOS_TO_R2=true`

---

## 📖 Guide par Cas d'Usage

### Cas 1 : Première Installation
```
1. QUICK_START_RAILWAY.md     → Setup initial
2. DEPLOYMENT_FLOW.md          → Comprendre le processus
3. .env.railway.example        → Configuration
4. Push + déploiement          → Exécution
5. Vérifications               → Tests
```

### Cas 2 : Problème de Déploiement
```
1. DEPLOYMENT_FLOW.md          → Comprendre ce qui se passe
2. MIGRATION_RAILWAY.md        → Section "Dépannage"
3. Railway → Logs              → Identifier l'erreur
4. scripts/README_RAILWAY.md   → Commandes manuelles
```

### Cas 3 : Migration des Photos Échouée
```
1. MIGRATION_RAILWAY.md        → Section "Photos"
2. Ne pas paniquer              → Photos toujours sur myboat-oi.com
3. Migrer manuellement          → railway run php artisan photos:migrate-to-r2
```

### Cas 4 : Mise à Jour Future (après installation)
```
1. Coder votre feature          → Nouvelle fonctionnalité
2. Créer migration si besoin    → php artisan make:migration
3. Push vers GitHub             → git push
4. Railway déploie AUTO         → Mode normal (pas FRESH_DB)
```

---

## 🎓 Comprendre l'Architecture

### Modes de Déploiement

Le script `railway/init-app.sh` a **2 modes** :

#### Mode FRESH DATABASE
**Quand :** Première installation, reset complet
**Déclencheur :** Variable `FRESH_DB=true`
**Que fait-il :**
```
1. migrate:fresh        → Reset TOUTES les tables
2. FreshDatabaseSeeder  → Import complet (55 bateaux)
3. photos:migrate-to-r2 → Migration photos vers R2 (optionnel)
```

#### Mode NORMAL
**Quand :** Déploiements réguliers, updates
**Déclencheur :** Aucune variable (par défaut)
**Que fait-il :**
```
1. migrate              → Applique nouvelles migrations seulement
2. DatabaseSeeder       → Seeders idempotents (types, zones, etc.)
```

### Ordre des Migrations

**Tables créées dans cet ordre :**
```
1. users, cache, jobs     (Laravel framework)
2. types, zones, actions  (Référentiels)
3. bateaux                (Table principale)
4. medias, equipements    (Tables dépendantes)
5. bateau_equipement      (Table pivot)
6. settings               (Configuration)
```

### Ordre des Seeders

**Via FreshDatabaseSeeder :**
```
1. TypeSeeder          → 10 types (Catamaran, Voilier...)
2. ZoneSeeder          → 5 zones (Réunion, Maurice...)
3. ActionSeeder        → 4 actions (Coup de cœur, Vendu...)
4. EquipementSeeder    → 20 équipements (GPS, VHF...)
5. UserSeeder          → 1 admin (admin@myboat.com)
6. BateauSeeder        → 55 bateaux complets
7. BateauMediaSeeder   → ~150 images
```

---

## ⚙️ Variables Critiques

### Variables PERMANENTES (toujours)
```env
DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
FILESYSTEM_DISK=cloudflare
CLOUDFLARE_R2_URL=https://pub-xxx.r2.dev
```

### Variables TEMPORAIRES (première fois seulement)
```env
FRESH_DB=true                  ⚠️ Supprimer après !
MIGRATE_PHOTOS_TO_R2=true      ⚠️ Supprimer après !
```

---

## 🔗 Liens Utiles

### Documentation Externe
- [Railway Docs](https://docs.railway.app)
- [Cloudflare R2 Docs](https://developers.cloudflare.com/r2/)
- [Laravel Deployment](https://laravel.com/docs/11.x/deployment)

### Railway CLI
```bash
# Installation
npm i -g @railway/cli

# Connexion
railway login

# Lier projet
railway link

# Logs en direct
railway logs

# Shell interactif
railway shell

# Exécuter une commande
railway run php artisan tinker
```

---

## 📞 Checklist de Dépannage

### ❌ Erreur : Connection Refused
```
1. Vérifier : DB_HOST=${MYSQLHOST}
2. Vérifier : Base MySQL déployée et active
3. Tester : railway run php artisan db:show
```

### ❌ Erreur : FreshDatabaseSeeder not found
```
1. Vérifier : composer.json (autoload)
2. Tester : railway run composer dump-autoload
3. Tester : railway run php artisan db:seed --class=FreshDatabaseSeeder
```

### ❌ Erreur : R2 Upload Failed
```
1. Vérifier : CLOUDFLARE_R2_ACCESS_KEY_ID
2. Vérifier : CLOUDFLARE_R2_SECRET_ACCESS_KEY
3. Vérifier : Bucket existe et est public
4. Tester : railway run php artisan tinker --execute="Storage::disk('cloudflare')->put('test.txt', 'test');"
```

### ❌ Photos ne s'affichent pas
```
1. Vérifier : CLOUDFLARE_R2_URL configuré
2. Vérifier : Table medias (urls complètes ou relatives ?)
3. Tester : railway run php artisan tinker --execute="echo r2_url('test.jpg');"
```

---

## 🎯 Résumé Ultra-Rapide

### Pour Migrer MAINTENANT (TL;DR)

```bash
# 1. Créer base MySQL sur Railway (UI)
# 2. Configurer variables dans Railway (UI) :
#    - DB_* (auto)
#    - CLOUDFLARE_R2_* (manuel)
#    - FRESH_DB=true
#    - MIGRATE_PHOTOS_TO_R2=true

# 3. Push
git add .
git commit -m "Setup Railway"
git push

# 4. Attendre 12-15 min

# 5. Tester app

# 6. Supprimer FRESH_DB=true et MIGRATE_PHOTOS_TO_R2=true
```

**C'est tout ! 🎉**

---

**Dernière mise à jour :** 2025-01-15
**Auteur :** Claude Code (Assistant IA)
**Version :** 1.0
