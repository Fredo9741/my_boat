# 📜 Scripts de Migration Railway

Ce dossier contient les scripts d'automatisation pour la migration et le setup de votre application MyBoat sur Railway.

---

## 📋 Scripts Disponibles

### 🚀 `complete-railway-setup.sh` (RECOMMANDÉ)

**Script complet tout-en-un**

```bash
railway run bash scripts/complete-railway-setup.sh
```

**Ce qu'il fait :**
1. ✅ Vérifie la connexion MySQL
2. ✅ Vérifie la configuration Cloudflare R2
3. ✅ Exécute toutes les migrations
4. ✅ Importe tous les seeders (55 bateaux, types, zones, etc.)
5. ✅ Télécharge et migre ~150 photos vers Cloudflare R2
6. ✅ Optimise l'application (cache config, routes, vues)
7. ✅ Affiche les statistiques finales

**Durée estimée :** 10-15 minutes
**Prérequis :** Base MySQL créée + Variables R2 configurées

**Quand l'utiliser :**
- ✅ Première installation sur Railway
- ✅ Reset complet de la base de données
- ✅ Migration depuis une ancienne base

---

### 📦 `fresh-railway-migration.sh`

**Migration sans téléchargement de photos**

```bash
railway run bash scripts/fresh-railway-migration.sh
```

**Ce qu'il fait :**
1. ✅ Vérifie la connexion MySQL
2. ✅ Exécute toutes les migrations
3. ✅ Importe tous les seeders
4. ⏭️ **NE télécharge PAS les photos** (elles restent sur myboat-oi.com)
5. ✅ Optimise l'application
6. ✅ Affiche les statistiques

**Durée estimée :** 2-3 minutes
**Prérequis :** Base MySQL créée

**Quand l'utiliser :**
- ✅ Tests rapides
- ✅ Vous voulez migrer les photos plus tard
- ✅ Environnement de développement/staging

**⚠️ Important :** Les photos resteront hébergées sur myboat-oi.com
Vous devrez les migrer manuellement plus tard avec :
```bash
railway run php artisan photos:migrate-to-r2
```

---

## 🎯 Comparaison des Scripts

| Fonctionnalité | `complete-railway-setup.sh` | `fresh-railway-migration.sh` |
|----------------|----------------------------|------------------------------|
| Migrations | ✅ | ✅ |
| Seeders (bateaux, types, etc.) | ✅ | ✅ |
| Migration photos vers R2 | ✅ | ❌ |
| Vérification R2 | ✅ | ❌ |
| Optimisations | ✅ | ✅ |
| Durée | 10-15 min | 2-3 min |
| Photos dépendantes de myboat-oi.com | ❌ Non | ✅ Oui |

---

## 📚 Commandes Manuelles

Si vous préférez exécuter les commandes une par une :

### Migration complète

```bash
# 1. Migrations
railway run php artisan migrate:fresh --force

# 2. Seeders
railway run php artisan db:seed --class=FreshDatabaseSeeder --force

# 3. Photos (optionnel)
railway run php artisan photos:migrate-to-r2

# 4. Optimisations
railway run php artisan config:cache
railway run php artisan route:cache
railway run php artisan view:cache
```

### Vérifications

```bash
# Voir les tables et leurs données
railway run php artisan tinker --execute="
echo 'Bateaux: ' . \App\Models\Bateau::count();
echo PHP_EOL;
echo 'Médias: ' . \App\Models\Media::count();
"

# Vérifier la connexion DB
railway run php artisan db:show

# Voir les logs
railway logs
```

---

## ⚙️ Configuration Requise

Avant d'exécuter ces scripts, assurez-vous que :

### 1. Railway CLI est installé

```bash
npm i -g @railway/cli
railway login
railway link  # Lier votre projet
```

### 2. Base MySQL créée sur Railway

- Railway Dashboard → New → Database → MySQL
- Attendre la provisioning (1-2 min)

### 3. Variables d'environnement configurées

**Obligatoires :**
```env
# Base de données (auto-injectées par Railway)
DB_CONNECTION=mysql
DB_HOST=${MYSQLHOST}
DB_PORT=${MYSQLPORT}
DB_DATABASE=${MYSQLDATABASE}
DB_USERNAME=${MYSQLUSER}
DB_PASSWORD=${MYSQLPASSWORD}

# Cloudflare R2 (À AJOUTER MANUELLEMENT)
FILESYSTEM_DISK=cloudflare
CLOUDFLARE_R2_ACCESS_KEY_ID=votre_key
CLOUDFLARE_R2_SECRET_ACCESS_KEY=votre_secret
CLOUDFLARE_R2_BUCKET=myboat
CLOUDFLARE_R2_URL=https://pub-xxxxx.r2.dev
CLOUDFLARE_R2_ENDPOINT=https://xxxxx.r2.cloudflarestorage.com
```

**Référence complète :** voir [.env.railway.example](../.env.railway.example)

---

## 🐛 Dépannage

### Script bloqué à "Vérification de la connexion..."

**Cause :** Variables MySQL incorrectes ou base non créée

**Solution :**
```bash
# Vérifier les variables
railway variables

# Tester la connexion
railway run php artisan db:show
```

### "CLOUDFLARE_R2_URL n'est pas configuré"

**Cause :** Variables R2 manquantes

**Solution :**
1. Aller sur [Cloudflare Dashboard](https://dash.cloudflare.com)
2. R2 Storage → Créer un bucket
3. R2 API Tokens → Create API Token
4. Copier les credentials dans Railway → Variables

### Migration photos échoue (timeouts)

**Cause :** Connexion lente ou timeouts réseau

**Solution :**
```bash
# Relancer la commande (elle skip les déjà migrées)
railway run php artisan photos:migrate-to-r2

# Ou en local avec meilleure connexion
php artisan photos:migrate-to-r2
```

### "Class FreshDatabaseSeeder not found"

**Cause :** Autoload pas à jour

**Solution :**
```bash
railway run composer dump-autoload
```

---

## 📊 Résultats Attendus

Après une exécution réussie de `complete-railway-setup.sh` :

```
✅ SETUP COMPLET TERMINÉ AVEC SUCCÈS !

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

## 🔗 Documentation Complète

- [QUICK_START_RAILWAY.md](../QUICK_START_RAILWAY.md) - Guide rapide de migration
- [MIGRATION_RAILWAY.md](../MIGRATION_RAILWAY.md) - Guide complet et détaillé
- [.env.railway.example](../.env.railway.example) - Template de variables Railway

---

**Dernière mise à jour :** 2025-01-15
