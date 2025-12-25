# Railway Deployment Configuration

Ce dossier contient les scripts nécessaires pour déployer My Boat sur Railway.

## Architecture

L'application suit une architecture "Majestic Monolith" avec 4 services :

1. **App Service** - Application Laravel principale (HTTP)
2. **Cron Service** - Tâches planifiées (Laravel Scheduler)
3. **Worker Service** - Traitement des jobs en arrière-plan
4. **MySQL Service** - Base de données MySQL

## Scripts

### `init-app.sh`
Script de pré-déploiement pour le service App :
- Exécute les migrations
- Nettoie et optimise le cache Laravel

**Configuration Railway** :
- **Pre-Deploy Command**: `chmod +x ./railway/init-app.sh && sh ./railway/init-app.sh`

### `run-cron.sh`
Démarre le scheduler Laravel (toutes les 60 secondes).

**Configuration Railway** :
- **Custom Start Command**: `chmod +x ./railway/run-cron.sh && sh ./railway/run-cron.sh`

### `run-worker.sh`
Démarre le worker pour traiter les jobs de la queue.

**Configuration Railway** :
- **Custom Start Command**: `chmod +x ./railway/run-worker.sh && sh ./railway/run-worker.sh`

## Variables d'environnement Railway

### Service App, Cron et Worker

```bash
# Application
APP_KEY=<générer avec: php artisan key:generate>
APP_ENV=production
APP_DEBUG=false
APP_URL=<URL de votre service Railway>

# Database (MySQL)
DB_CONNECTION=mysql
DB_HOST=${{MySQL.MYSQLHOST}}
DB_PORT=${{MySQL.MYSQLPORT}}
DB_DATABASE=${{MySQL.MYSQLDATABASE}}
DB_USERNAME=${{MySQL.MYSQLUSER}}
DB_PASSWORD=${{MySQL.MYSQLPASSWORD}}

# Queue
QUEUE_CONNECTION=database

# Logging (Railway)
LOG_CHANNEL=stderr
LOG_STDERR_FORMATTER=\Monolog\Formatter\JsonFormatter

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
```

## Instructions de déploiement

### 1. Créer le service MySQL
1. Sur Railway, créez un nouveau service MySQL
2. Déployez-le

### 2. Créer le service App
1. Créez un nouveau service et connectez votre repo GitHub
2. Dans **Settings → Build** :
   - Custom Build Command: `npm run build`
3. Dans **Settings → Deploy** :
   - Pre-Deploy Command: `chmod +x ./railway/init-app.sh && sh ./railway/init-app.sh`
4. Dans **Variables**, ajoutez toutes les variables ci-dessus
5. Dans **Networking**, générez un domaine public
6. Déployez

### 3. Créer le service Cron
1. Créez un nouveau service et connectez le même repo
2. Dans **Settings → Deploy** :
   - Custom Start Command: `chmod +x ./railway/run-cron.sh && sh ./railway/run-cron.sh`
3. Dans **Variables**, ajoutez les mêmes variables que App
4. Déployez

### 4. Créer le service Worker
1. Créez un nouveau service et connectez le même repo
2. Dans **Settings → Deploy** :
   - Custom Start Command: `chmod +x ./railway/run-worker.sh && sh ./railway/run-worker.sh`
3. Dans **Variables**, ajoutez les mêmes variables que App
4. Déployez

### 5. Peupler la base de données (une seule fois)
Via Railway Shell sur le service App :
```bash
php artisan db:seed --force
```

## Notes importantes

- ✅ Les migrations s'exécutent automatiquement à chaque déploiement du service App
- ❌ Les seeders NE s'exécutent PAS automatiquement (à lancer manuellement)
- 📦 Chaque service partage le même code mais a un rôle différent
- 🔒 Seul le service App doit avoir un domaine public
