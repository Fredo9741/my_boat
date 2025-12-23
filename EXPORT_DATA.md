# Export et Import des Données de Production

Ce guide explique comment exporter vos données locales et les utiliser comme seeders pour la production.

## 📋 Vue d'ensemble

Vous avez créé des données personnalisées en local (types de bateaux, badges, bateaux, etc.) et vous souhaitez utiliser ces données réelles au lieu des données de test par défaut lors du déploiement sur Railway.

## 🚀 Processus d'Export

### 1. Exporter toutes les données

```bash
php artisan db:export-to-seeders
```

Cette commande va :
- ✅ Exporter les types de bateaux vers `database/seeders/TypeSeeder.php`
- ✅ Exporter les zones vers `database/seeders/ZoneSeeder.php`
- ✅ Exporter les actions/badges vers `database/seeders/ActionSeeder.php`
- ✅ Exporter les équipements vers `database/seeders/EquipementSeeder.php`
- ✅ Exporter les bateaux vers `database/seeders/BateauSeeder.php`
- ✅ Exporter les médias vers `database/seeders/MediaSeeder.php`

### 2. Exporter des tables spécifiques

Si vous voulez exporter seulement certaines tables :

```bash
# Exporter uniquement les types
php artisan db:export-to-seeders --tables=types

# Exporter plusieurs tables
php artisan db:export-to-seeders --tables=types --tables=actions --tables=bateaux
```

## 📊 Ce qui est exporté

### Types de bateaux
- Libellé (français par défaut)
- Slug unique
- Traductions JSON (si disponibles)
- Photo associée
- Icône Font Awesome

### Zones géographiques
- Libellé (ex: La Réunion, Maurice, Madagascar)
- Slug unique
- Traductions JSON

### Actions/Badges
- Libellé (ex: Nouveauté, Promotion, Exclusivité)
- Slug unique
- Couleur (pour l'affichage)
- Traductions JSON

### Bateaux
- **Informations générales** : modèle, slug, prix, description
- **Caractéristiques techniques** : dimensions, année, matériaux
- **Motorisation** : type moteur, puissance, heures moteur
- **Confort** : nombre de cabines, passagers
- **Relations** : type_id, zone_id, slogan_id

### Médias
- Photos et vidéos associées aux bateaux
- URL, ordre d'affichage, légendes

## ✅ Tester l'import en local

Avant de déployer sur Railway, testez que vos seeders fonctionnent :

```bash
# Réinitialiser la base et réimporter
php artisan migrate:fresh --seed
```

Vérifiez ensuite sur http://localhost:8000 que toutes vos données sont présentes.

## 🚂 Déploiement sur Railway

### Étape 1 : Commit des seeders

```bash
git add database/seeders/
git commit -m "Update seeders with production data"
git push
```

### Étape 2 : Railway va automatiquement

Railway va exécuter automatiquement lors du déploiement (via `nixpacks.toml`) :

```bash
php artisan migrate --force
php artisan db:seed --force
```

### Étape 3 : Vérification

1. Attendez la fin du déploiement sur Railway
2. Ouvrez votre site de production
3. Vérifiez que vos données sont présentes

## 🔄 Mettre à jour les données de production

Si vous modifiez des données en local et voulez les réexporter :

```bash
# 1. Exporter les nouvelles données
php artisan db:export-to-seeders

# 2. Tester en local
php artisan migrate:fresh --seed

# 3. Commit et push
git add database/seeders/
git commit -m "Update production data"
git push
```

⚠️ **Attention** : Sur Railway, les seeders ne tournent que si la base est vide. Pour forcer un re-seed en production :

```bash
# Via Railway CLI ou interface web
php artisan migrate:fresh --seed --force
```

## 📁 Structure des fichiers générés

```
database/seeders/
├── TypeSeeder.php         # Types de bateaux (7 types)
├── ZoneSeeder.php         # Zones géographiques (5 zones)
├── ActionSeeder.php       # Actions/badges (14 actions)
├── EquipementSeeder.php   # Équipements (vide pour l'instant)
├── BateauSeeder.php       # Bateaux (8 bateaux)
├── MediaSeeder.php        # Photos et vidéos
├── UserSeeder.php         # Utilisateur admin
└── DatabaseSeeder.php     # Orchestrateur (appelle tous les seeders)
```

## 💡 Conseils

### Gestion des photos

Les seeders incluent les chemins vers les photos (ex: `types/photo.jpg`). Assurez-vous que :

1. **En local** : Les photos sont dans `storage/app/public/`
2. **Sur Railway** : Un volume est configuré pour persister les fichiers uploadés

### Relations entre tables

L'ordre d'exécution des seeders est important :

1. **Types** (aucune dépendance)
2. **Zones** (aucune dépendance)
3. **Actions** (aucune dépendance)
4. **Équipements** (aucune dépendance)
5. **Bateaux** (dépend de Types, Zones, Actions)
6. **Médias** (dépend de Bateaux)
7. **Users** (aucune dépendance)

Cet ordre est respecté dans `DatabaseSeeder.php`.

### Données sensibles

⚠️ Les seeders sont commitées dans Git. **Ne jamais** y mettre :
- Mots de passe en clair
- Clés API
- Informations personnelles sensibles

Le `UserSeeder.php` utilise déjà un mot de passe hashé sécurisé.

## 🆘 Dépannage

### "Column not found" lors de l'export

Si vous obtenez une erreur de colonne manquante, c'est que votre structure de base locale diffère des migrations. Solution :

```bash
# Remettre la base à jour avec les dernières migrations
php artisan migrate:fresh
php artisan db:seed
```

Ensuite ajoutez vos données manuellement via l'interface admin, puis réexportez.

### Les seeders ne s'exécutent pas sur Railway

Vérifiez dans les logs Railway que :
```
php artisan db:seed --force
```

est bien exécuté. Si la base n'est pas vide, les seeders peuvent ne rien faire.

### Les photos ne s'affichent pas

Sur Railway, assurez-vous que :

1. Un volume est configuré dans les settings Railway
2. `php artisan storage:link` a été exécuté
3. Le dossier `storage/app/public` est bien monté

Voir `RAILWAY_DEPLOY.md` pour plus de détails.

---

✅ **Résultat** : Vos données réelles sont maintenant utilisées comme seeders et seront automatiquement importées lors de chaque nouveau déploiement Railway !
