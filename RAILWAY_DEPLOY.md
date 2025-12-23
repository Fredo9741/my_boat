# Déploiement sur Railway - My Boat Marketplace

## 📋 Prérequis

- Compte Railway.app
- Base de données PostgreSQL ou MySQL provisionnée sur Railway
- Variables d'environnement configurées

## 🔧 Variables d'environnement à configurer sur Railway

```env
# Application
APP_NAME="My Boat"
APP_ENV=production
APP_KEY=base64:VOTRE_CLE_ICI
APP_DEBUG=false
APP_URL=https://votre-domaine.railway.app

# Locale
APP_LOCALE=fr
APP_FALLBACK_LOCALE=fr

# Base de données (Railway fournit automatiquement DATABASE_URL)
DB_CONNECTION=mysql
DB_HOST=${MYSQL_HOST}
DB_PORT=${MYSQL_PORT}
DB_DATABASE=${MYSQL_DATABASE}
DB_USERNAME=${MYSQL_USER}
DB_PASSWORD=${MYSQL_PASSWORD}

# Session & Cache
SESSION_DRIVER=database
CACHE_STORE=database
QUEUE_CONNECTION=database

# Mail (optionnel)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=votre-email@gmail.com
MAIL_PASSWORD=votre-mot-de-passe-app
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=votre-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

## 🚀 Étapes de déploiement

### 1. Créer un nouveau projet Railway

1. Allez sur [Railway.app](https://railway.app)
2. Cliquez sur "New Project"
3. Sélectionnez "Deploy from GitHub repo"
4. Choisissez votre repository

### 2. Ajouter une base de données

1. Dans votre projet Railway, cliquez sur "+ New"
2. Sélectionnez "Database" → "MySQL" (ou PostgreSQL)
3. Railway créera automatiquement la base de données

### 3. Configurer les variables d'environnement

1. Cliquez sur votre service web
2. Allez dans l'onglet "Variables"
3. Ajoutez toutes les variables listées ci-dessus
4. **Important** : Générez une nouvelle `APP_KEY` avec : `php artisan key:generate --show`

### 4. Déployer

Railway déploiera automatiquement votre application à chaque push sur la branche principale.

Le script de déploiement va automatiquement :
- ✅ Installer les dépendances Composer
- ✅ Compiler les assets (npm build)
- ✅ Exécuter les migrations
- ✅ Exécuter les seeders (si la base est vide)
- ✅ Optimiser l'application
- ✅ Démarrer le serveur

## 🔍 Vérification post-déploiement

Après le déploiement, vérifiez :

1. **Page d'accueil** : `https://votre-domaine.railway.app`
2. **Admin** : `https://votre-domaine.railway.app/login`
3. **Listings bateaux** : `https://votre-domaine.railway.app/bateaux`

### Identifiants admin par défaut (à changer !)

```
Email: admin@myboat.re
Password: password123
```

**⚠️ Important** : Changez immédiatement le mot de passe admin après le premier déploiement !

## 🐛 Dépannage

### Erreur "No application encryption key"
```bash
# Sur Railway, ajoutez la variable d'environnement APP_KEY
# Générez-la localement avec :
php artisan key:generate --show
```

### Base de données vide après déploiement
Les seeders s'exécutent automatiquement. Si la base reste vide :
1. Vérifiez les logs Railway
2. Redéployez manuellement depuis le dashboard

### Erreur de permission sur storage/
Railway gère automatiquement les permissions. Si problème :
```bash
# Les dossiers storage/ sont gitignorés mais Laravel les recrée automatiquement
```

### Erreur 500
1. Activez temporairement `APP_DEBUG=true` dans les variables d'environnement
2. Consultez les logs Railway
3. Remettez `APP_DEBUG=false` après diagnostic

## 📝 Notes importantes

- **Seeders** : Ne s'exécutent qu'une seule fois (vérifie si la base est vide)
- **Assets** : Compilés automatiquement avec `npm run build`
- **Cache** : Nettoyé et régénéré à chaque déploiement
- **Migrations** : S'exécutent automatiquement à chaque déploiement

## 🔄 Mises à jour

Pour déployer des mises à jour :
```bash
git add .
git commit -m "Description des changements"
git push origin main
```

Railway redéploiera automatiquement votre application.
