# 🚀 Quick Start - Migration Railway

Guide rapide pour migrer votre marketplace MyBoat vers Railway avec une nouvelle base MySQL.

---

## 📋 Checklist Pré-Migration

Avant de commencer, assurez-vous d'avoir :

- [ ] Compte Railway créé et projet existant
- [ ] Credentials Cloudflare R2 (Access Key, Secret, Bucket, URL)
- [ ] Railway CLI installé (`npm i -g @railway/cli`)

---

## 🎯 Migration en 3 Étapes

### ÉTAPE 1 : Créer la base MySQL sur Railway

1. Aller sur [Railway.app](https://railway.app)
2. Sélectionner votre projet
3. **New** → **Database** → **MySQL**
4. Attendre la provisioning (1-2 min)
5. ✅ Noter les credentials (auto-générés)

### ÉTAPE 2 : Configurer les variables

Dans Railway → Votre Service → **Variables** :

```env
# Database (Railway les génère automatiquement)
DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

# Cloudflare R2 (VOUS DEVEZ LES AJOUTER)
FILESYSTEM_DISK=cloudflare
CLOUDFLARE_R2_ACCESS_KEY_ID=votre_key
CLOUDFLARE_R2_SECRET_ACCESS_KEY=votre_secret
CLOUDFLARE_R2_BUCKET=myboat
CLOUDFLARE_R2_URL=https://pub-xxxxx.r2.dev
CLOUDFLARE_R2_ENDPOINT=https://xxxxx.r2.cloudflarestorage.com

# Application
APP_ENV=production
APP_DEBUG=false

# ⚠️ MIGRATION : Variables pour le premier déploiement
# Ajouter ces variables UNIQUEMENT pour la première installation :
FRESH_DB=true
MIGRATE_PHOTOS_TO_R2=true

# 💡 IMPORTANT : Après le premier déploiement réussi, SUPPRIMER ces 2 variables
#    pour éviter de reset la base à chaque push !
```

### ÉTAPE 3 : Déployer sur Railway

**🎯 Méthode AUTOMATIQUE (RECOMMANDÉE) - Via Railway Deploy** :

1. **Push votre code vers GitHub** :
   ```bash
   git add .
   git commit -m "Setup nouvelle base Railway avec migration auto"
   git push
   ```

2. **Railway détecte le push et déploie automatiquement**

3. **Le script `railway/init-app.sh` s'exécute automatiquement** :
   - ✅ Détecte `FRESH_DB=true`
   - ✅ Exécute `migrate:fresh` (crée toutes les tables)
   - ✅ Exécute `FreshDatabaseSeeder` (importe 55 bateaux + données)
   - ✅ Si `MIGRATE_PHOTOS_TO_R2=true` : télécharge et migre ~150 photos vers R2
   - ✅ Optimise Laravel (cache config, routes, vues)

4. **Durée totale : 12-15 minutes** (dont 10 min pour les photos)

5. **⚠️ APRÈS le premier déploiement réussi** :
   - Aller dans Railway → Variables
   - **SUPPRIMER** `FRESH_DB=true`
   - **SUPPRIMER** `MIGRATE_PHOTOS_TO_R2=true`
   - Sinon chaque push reset la base !

---

**🛠️ Méthode MANUELLE (Alternative) - Via Railway CLI** :

Si vous préférez contrôler manuellement :

```bash
# Migrations + Seeders
railway run php artisan migrate:fresh --force
railway run php artisan db:seed --class=FreshDatabaseSeeder --force

# Migration photos (IMPORTANT)
railway run php artisan photos:migrate-to-r2

# Optimisations
railway run php artisan optimize
```

---

## ✅ Vérifications

Après migration :

1. **Page d'accueil** : https://votre-app.up.railway.app
   - ✅ 55 bateaux visibles
   - ✅ Photos s'affichent

2. **Admin** : https://votre-app.up.railway.app/admin
   - Email : `admin@myboat.com`
   - Password : `password`
   - ✅ Login fonctionne

3. **Test upload photo** :
   - Aller dans Admin → Bateaux → Éditer
   - Uploader une image
   - ✅ Image visible immédiatement

---

## 📸 Comprendre les Photos

### Avant migration photos vers R2
```
Table medias → url = "https://www.myboat-oi.com/wp-content/uploads/..."
```
✅ Fonctionne mais dépend de myboat-oi.com

### Après migration photos vers R2
```
Table medias → url = "bateaux/123/photo.jpg"
Helper r2_url() → "https://pub-xxxxx.r2.dev/bateaux/123/photo.jpg"
```
✅ Hébergé sur VOTRE Cloudflare R2

---

## 🛠️ Ordre d'Exécution (Automatique)

Le script exécute dans cet ordre :

```
1. Migrations (18 fichiers)
   └─ Tables : users, types, zones, actions, bateaux, medias, etc.

2. Seeders (7 seeders via FreshDatabaseSeeder)
   ├─ TypeSeeder (10 types de bateaux)
   ├─ ZoneSeeder (5 zones géographiques)
   ├─ ActionSeeder (4 actions/slogans)
   ├─ EquipementSeeder (20 équipements)
   ├─ UserSeeder (1 admin)
   ├─ BateauSeeder (55 bateaux)
   └─ BateauMediaSeeder (150+ images)

3. Migration Photos (via commande)
   └─ Télécharge 150+ images depuis myboat-oi.com
   └─ Upload vers Cloudflare R2
   └─ Met à jour les URLs en base
```

---

## ⚠️ Problèmes Courants

### "Connection refused"
**Cause** : Variables MySQL mal configurées
**Solution** :
```bash
railway variables  # Vérifier les variables
railway run php artisan db:show  # Tester la connexion
```

### "Class FreshDatabaseSeeder not found"
**Cause** : Autoload pas à jour
**Solution** :
```bash
railway run composer dump-autoload
```

### Photos ne s'affichent pas
**Cause** : Variables R2 manquantes ou incorrectes
**Solution** :
```bash
railway run php artisan tinker --execute="echo env('CLOUDFLARE_R2_URL');"
```

### Migration photos échoue
**Cause** : Timeout ou connexion lente
**Solution** :
```bash
# Relancer la commande (elle skip les déjà migrées)
railway run php artisan photos:migrate-to-r2
```

---

## 📊 Résultats Attendus

Après une migration réussie :

```
📊 Statistiques de la base de données:

  → Utilisateurs : 1
  → Types de bateaux : 10
  → Zones : 5
  → Actions : 4
  → Équipements : 20
  → Bateaux : 55
  → Médias : 150+

📸 Photos sur R2 :
  → Photos migrées vers R2 : 150+
  → Photos externes (myboat-oi.com) : 0
```

---

## 🎉 Prochaines Étapes

1. **Changer le mot de passe admin**
   ```bash
   railway run php artisan tinker --execute="
   \$admin = \App\Models\User::first();
   \$admin->password = bcrypt('votre_nouveau_mdp');
   \$admin->save();
   "
   ```

2. **Configurer un domaine personnalisé**
   - Railway → Settings → Domains
   - Ajouter `myboat-oi.com` (ou autre)

3. **Activer les backups automatiques**
   - Railway fait des backups auto de MySQL
   - Configurer un export hebdomadaire (optionnel)

4. **Monitoring**
   - Activer les alertes Railway
   - Installer Sentry (optionnel)

---

## 📖 Documentation Complète

Pour plus de détails, consultez :
- [MIGRATION_RAILWAY.md](MIGRATION_RAILWAY.md) - Guide complet (détaillé)
- [scripts/complete-railway-setup.sh](scripts/complete-railway-setup.sh) - Script automatisé
- [scripts/fresh-railway-migration.sh](scripts/fresh-railway-migration.sh) - Script sans migration photos

---

**Dernière mise à jour :** 2025-01-15
**Temps estimé de migration :** 10-15 minutes
**Prérequis :** Railway CLI + Cloudflare R2 configuré
