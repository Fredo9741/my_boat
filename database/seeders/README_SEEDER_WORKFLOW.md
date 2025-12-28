# Guide Complet des Seeders - Marketplace Bateaux

> **Version** : 1.0
> **Dernière mise à jour** : 28 décembre 2025
> **Environnement** : Production (Railway MySQL + 55 bateaux)

---

## Table des Matières

1. [Vue d'ensemble](#vue-densemble)
2. [Catégories de Seeders](#catégories-de-seeders)
3. [Inventaire Complet des Seeders](#inventaire-complet-des-seeders)
4. [Workflows par Scénario](#workflows-par-scénario)
5. [Règles de Sécurité](#règles-de-sécurité)
6. [Exécution sur Railway](#exécution-sur-railway)
7. [Dépannage](#dépannage)
8. [Variables d'Environnement](#variables-denvironnement)

---

## Vue d'ensemble

### Philosophie

Le système de seeders est conçu pour **éviter le chaos** en production. Chaque seeder a un rôle précis et une catégorie qui détermine quand il doit être exécuté.

### Principes Fondamentaux

1. **Production First** : Par défaut, les seeders sont configurés pour la production
2. **Idempotence** : Les seeders essentiels peuvent être exécutés plusieurs fois sans danger
3. **Tracabilité** : Chaque exécution affiche des logs détaillés
4. **Sécurité** : Les seeders destructifs sont désactivés par défaut

---

## Catégories de Seeders

### 🟢 Catégorie 1 : ESSENTIELS (Toujours actifs)

**Caractéristiques** :
- Exécutés à chaque déploiement
- Idempotents (ne créent pas de doublons)
- Nécessaires au fonctionnement de l'application
- Protégés contre la re-création

**Seeders** :
- `TypeSeeder` - Types de bateaux (Catamaran, Voilier, etc.)
- `ZoneSeeder` - Zones géographiques (Réunion, Maurice, Madagascar)
- `ActionSeeder` - Actions/Slogans (Coup de coeur, Vendu, etc.)
- `EquipementSeeder` - Équipements disponibles
- `UserSeeder` - Utilisateur admin par défaut

**Statut** : ✅ **TOUJOURS ACTIFS** dans `DatabaseSeeder.php`

---

### 🔵 Catégorie 2 : IMPORT INITIAL (Exécution unique)

**Caractéristiques** :
- Exécutés UNE SEULE FOIS lors de l'installation initiale
- Peuplent la base de données avec les bateaux et médias
- **DESTRUCTIFS** si ré-exécutés
- Commentés après la première utilisation

**Seeders** :
- `CleanBateauxSeeder` - Nettoie complètement les tables bateaux et médias
- `BateauSeeder` - Importe les 55 bateaux depuis le JSON
- `BateauMediaSeeder` - Importe les 457 images

**Statut** : 🔒 **COMMENTÉS** depuis le 27/12/2025 (import réussi)

**⚠️ DANGER** : Ne JAMAIS décommenter en production sauf si vous voulez TOUT réinitialiser

---

### 🟡 Catégorie 3 : MISES À JOUR (Selon besoin)

**Caractéristiques** :
- Exécutés ponctuellement pour mettre à jour des données spécifiques
- **NON destructifs** - ne créent ni ne suppriment
- Modifient uniquement certains champs
- Idempotents et sécurisés

**Seeders** :
- `UpdatePublishedDatesSeeder` - Met à jour les dates de publication
- `UpdateDescriptionsSeeder` - Met à jour uniquement les descriptions

**Statut** : 💤 **COMMENTÉS** par défaut, activés selon besoin

**✅ SAFE** : Peuvent être décommentés temporairement sans risque

---

## Inventaire Complet des Seeders

### 📋 Détails de chaque seeder

#### TypeSeeder.php
```
Catégorie : ESSENTIEL
Description : Crée les types de bateaux (Catamaran à voile, Bateau Moteur, etc.)
Protection : Vérifie l'existence avant création
Données : ~8 types
Statut : ✅ Actif
```

#### ZoneSeeder.php
```
Catégorie : ESSENTIEL
Description : Crée les zones géographiques de l'océan Indien
Protection : Vérifie l'existence avant création
Données : Réunion, Maurice, Madagascar, Mayotte, Seychelles
Statut : ✅ Actif
```

#### ActionSeeder.php
```
Catégorie : ESSENTIEL
Description : Crée les actions/slogans pour les bateaux
Protection : Vérifie l'existence avant création
Données : Coup de coeur, Vendu, Nouveauté, Prix en baisse
Statut : ✅ Actif
```

#### EquipementSeeder.php
```
Catégorie : ESSENTIEL
Description : Crée tous les équipements disponibles pour les bateaux
Protection : Vérifie l'existence avant création
Données : GPS, VHF, Pilote automatique, etc.
Statut : ✅ Actif
```

#### UserSeeder.php
```
Catégorie : ESSENTIEL
Description : Crée l'utilisateur admin par défaut
Protection : Vérifie l'existence par email
Données : 1 admin
Statut : ✅ Actif
```

#### CleanBateauxSeeder.php
```
Catégorie : IMPORT INITIAL
Description : SUPPRIME tous les bateaux et médias
Protection : ⚠️ AUCUNE - Destructif par nature
Danger : 🔴 EXTRÊME
Statut : 🔒 Commenté depuis 27/12/2025
```

#### BateauSeeder.php
```
Catégorie : IMPORT INITIAL
Description : Importe les bateaux depuis bateaux_scraped_data.json
Source : database/seeders/bateaux_scraped_data.json
Données : 55 bateaux
Taille : ~2285 lignes de JSON
Statut : 🔒 Commenté depuis 27/12/2025
```

#### BateauMediaSeeder.php
```
Catégorie : IMPORT INITIAL
Description : Importe toutes les images des bateaux
Données : 457 images
Statut : 🔒 Commenté depuis 27/12/2025
```

#### UpdatePublishedDatesSeeder.php
```
Catégorie : MISE À JOUR
Description : Met à jour les dates de publication depuis le JSON
Action : Modification du champ published_at uniquement
Protection : Ne crée pas de bateaux, ignore si non trouvé
Statut : 🔒 Commenté (exécuté le 28/12/2025)
```

#### UpdateDescriptionsSeeder.php
```
Catégorie : MISE À JOUR
Description : Met à jour uniquement les descriptions des bateaux
Action : Modification du champ description uniquement
Protection : Ne crée ni ne supprime, idempotent
Rapport : Affiche statistiques détaillées
Statut : 💤 Disponible mais commenté
```

---

## Workflows par Scénario

### Scénario 1 : Installation Fraîche (Nouveau Projet)

**Contexte** : Base de données vide, première installation

**Étapes** :

```bash
# 1. Créer la base de données
php artisan migrate:fresh

# 2. Dans DatabaseSeeder.php, décommenter TOUT :
# - Seeders essentiels (déjà actifs)
# - Seeders d'import initial (à décommenter)

# 3. Exécuter
php artisan db:seed

# 4. Résultat attendu :
# ✅ Types, Zones, Actions, Équipements, Users créés
# ✅ 55 bateaux importés
# ✅ 457 images importées

# 5. IMPORTANT : Re-commenter les seeders d'import !
```

**DatabaseSeeder.php pour installation fraîche** :
```php
public function run(): void
{
    // Essentiels - Toujours actifs
    $this->call([
        TypeSeeder::class,
        ZoneSeeder::class,
        ActionSeeder::class,
        EquipementSeeder::class,
        UserSeeder::class,
    ]);

    // DÉCOMMENTER POUR INSTALLATION FRAÎCHE UNIQUEMENT
    $this->call([
        CleanBateauxSeeder::class,
        BateauSeeder::class,
        BateauMediaSeeder::class,
    ]);

    // Puis RE-COMMENTER après exécution !
}
```

---

### Scénario 2 : Déploiement Production (Défaut actuel)

**Contexte** : Railway, 55 bateaux déjà en base, déploiement normal

**Étapes** :

```bash
# 1. Railway exécute automatiquement :
php artisan migrate --force
php artisan db:seed --force

# 2. Configuration actuelle de DatabaseSeeder.php (CORRECTE) :
```

**DatabaseSeeder.php pour production** :
```php
public function run(): void
{
    // ✅ ACTIFS - Seeders essentiels (idempotents)
    $this->call([
        TypeSeeder::class,
        ZoneSeeder::class,
        ActionSeeder::class,
        EquipementSeeder::class,
        UserSeeder::class,
    ]);

    // 🔒 COMMENTÉS - Import initial (déjà exécuté le 27/12/2025)
    // $this->call([
    //     CleanBateauxSeeder::class,
    //     BateauSeeder::class,
    //     BateauMediaSeeder::class,
    // ]);

    // 🔒 COMMENTÉS - Mises à jour ponctuelles
    // $this->call([
    //     UpdatePublishedDatesSeeder::class,
    //     UpdateDescriptionsSeeder::class,
    // ]);
}
```

**Résultat** :
- ✅ Seeders essentiels ré-exécutés (sans doublon grâce aux protections)
- ✅ Bateaux et médias préservés
- ✅ Déploiement sécurisé

---

### Scénario 3 : Mise à Jour des Descriptions

**Contexte** : Vous avez modifié le JSON et voulez mettre à jour les descriptions en production

**Option A : Via DatabaseSeeder (Temporaire)**

```bash
# 1. Sur votre machine locale, éditez DatabaseSeeder.php
# 2. Décommentez UpdateDescriptionsSeeder
# 3. Commitez et pushez sur Railway
# 4. Railway exécute automatiquement db:seed
# 5. Vérifiez les logs Railway pour voir le rapport
# 6. RE-COMMENTEZ le seeder et re-commitez
```

**DatabaseSeeder.php (temporaire)** :
```php
public function run(): void
{
    $this->call([
        TypeSeeder::class,
        ZoneSeeder::class,
        ActionSeeder::class,
        EquipementSeeder::class,
        UserSeeder::class,
    ]);

    // ✅ DÉCOMMENTÉ TEMPORAIREMENT pour mise à jour
    $this->call([
        UpdateDescriptionsSeeder::class,
    ]);
}
```

**Option B : Via Commande Artisan Directe (RECOMMANDÉ)**

```bash
# Sur Railway CLI :
railway run php artisan db:seed --class=UpdateDescriptionsSeeder

# OU via commande custom (si créée) :
railway run php artisan boat:update-descriptions
```

**Avantages Option B** :
- ✅ Pas besoin de modifier DatabaseSeeder.php
- ✅ Exécution unique et ciblée
- ✅ Pas de risque d'oubli de re-commentage

---

### Scénario 4 : Développement Local

**Contexte** : Tests, développement de nouvelles fonctionnalités

**Étapes** :

```bash
# 1. Reset complet (safe en local)
php artisan migrate:fresh

# 2. Seed complet
php artisan db:seed

# 3. Pour tester les updates :
php artisan db:seed --class=UpdateDescriptionsSeeder

# 4. Ou commande custom :
php artisan boat:update-descriptions
```

**Configuration** : Vous pouvez décommenter tous les seeders en local sans risque

---

## Règles de Sécurité

### ⚠️ Règles d'Or en Production

1. **JAMAIS** décommenter `CleanBateauxSeeder` en production
2. **TOUJOURS** faire un backup avant de modifier les seeders actifs
3. **VÉRIFIER** deux fois avant de pusher sur Railway
4. **PRÉFÉRER** les commandes directes (`--class=`) aux modifications de DatabaseSeeder
5. **DOCUMENTER** chaque modification dans les commentaires

### 🔒 Checklist Avant Déploiement

```
□ Les seeders essentiels sont actifs
□ Les seeders d'import initial sont COMMENTÉS
□ Les seeders de mise à jour sont COMMENTÉS (sauf si voulu)
□ Les commentaires indiquent clairement l'état actuel
□ Un backup de la base existe (si modification importante)
```

### 📊 Backup Railway

```bash
# Avant toute opération importante, exportez la base :
railway run mysqldump -u root -p database_name > backup_$(date +%Y%m%d).sql

# Ou via Railway dashboard :
# 1. Aller dans la base de données
# 2. Cliquer sur "Backups"
# 3. Créer un backup manuel
```

---

## Exécution sur Railway

### Commandes Railway Essentielles

```bash
# 1. Exécuter tous les seeders (DatabaseSeeder)
railway run php artisan db:seed --force

# 2. Exécuter un seeder spécifique
railway run php artisan db:seed --class=UpdateDescriptionsSeeder --force

# 3. Reset complet (⚠️ DANGER)
railway run php artisan migrate:fresh --seed --force

# 4. Voir les logs
railway logs

# 5. Se connecter à la base
railway run mysql
```

### Configuration Railway

**Fichier** : `railway.json` (ou configuration deploy)

```json
{
  "build": {
    "builder": "NIXPACKS"
  },
  "deploy": {
    "startCommand": "php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=$PORT",
    "restartPolicyType": "ON_FAILURE",
    "restartPolicyMaxRetries": 10
  }
}
```

**Note** : Le `db:seed --force` est exécuté automatiquement à chaque déploiement

---

## Dépannage

### Problème : "Seeders créent des doublons"

**Cause** : Le seeder n'a pas de protection contre les doublons

**Solution** :
```php
// Dans le seeder, ajouter :
if (Type::where('libelle', 'Catamaran')->exists()) {
    return; // ou skip
}
```

### Problème : "Tous mes bateaux ont disparu"

**Cause** : `CleanBateauxSeeder` a été exécuté

**Solution** :
1. Restaurer depuis backup Railway
2. Ou ré-importer avec `BateauSeeder` et `BateauMediaSeeder`
3. **Prévention** : Ne JAMAIS décommenter CleanBateauxSeeder en prod

### Problème : "Foreign key constraint fails"

**Cause** : Ordre d'exécution incorrect

**Solution** :
```php
// Respecter l'ordre :
1. Types, Zones, Actions (référencés par Bateaux)
2. Equipements (référencés par pivot)
3. Users
4. Bateaux
5. Medias (référencent Bateaux)
```

### Problème : "JSON file not found"

**Cause** : Le fichier `bateaux_scraped_data.json` n'est pas dans `database/seeders/`

**Solution** :
```bash
# Vérifier :
ls database/seeders/bateaux_scraped_data.json

# Si absent, vérifier le .gitignore
# Assurer que le JSON est commité
```

---

## Variables d'Environnement

### SEEDER_MODE (Optionnel)

Permet de contrôler le comportement des seeders via `.env`

**Valeurs** :
- `production` (défaut) : Seeders essentiels uniquement
- `fresh` : Import complet
- `update` : Seeders de mise à jour activés
- `development` : Tous les seeders activés

**Configuration** :

```env
# .env
SEEDER_MODE=production
```

**Utilisation dans DatabaseSeeder.php** :

```php
public function run(): void
{
    $mode = env('SEEDER_MODE', 'production');

    // Essentiels - Toujours actifs
    $this->call([
        TypeSeeder::class,
        ZoneSeeder::class,
        ActionSeeder::class,
        EquipementSeeder::class,
        UserSeeder::class,
    ]);

    // Import initial - Selon mode
    if ($mode === 'fresh' || $mode === 'development') {
        $this->call([
            CleanBateauxSeeder::class,
            BateauSeeder::class,
            BateauMediaSeeder::class,
        ]);
    }

    // Mises à jour - Selon mode
    if ($mode === 'update' || $mode === 'development') {
        $this->call([
            UpdateDescriptionsSeeder::class,
        ]);
    }
}
```

**Sur Railway** :

```bash
# Définir la variable d'environnement
railway variables set SEEDER_MODE=production

# Pour une mise à jour ponctuelle :
railway variables set SEEDER_MODE=update
railway up  # Déclenche le déploiement
# Puis remettre :
railway variables set SEEDER_MODE=production
```

---

## Historique des Exécutions

### Journal des Seeders

| Date | Seeder | Action | Résultat |
|------|--------|--------|----------|
| 27/12/2025 | Import Initial | Première exécution complète | ✅ 55 bateaux, 457 images |
| 28/12/2025 | UpdatePublishedDatesSeeder | Mise à jour dates | ✅ Dates mises à jour |
| - | UpdateDescriptionsSeeder | - | 💤 Pas encore exécuté |

---

## Commandes Artisan Custom

### boat:update-descriptions

**Fichier** : `app/Console/Commands/UpdateBoatDescriptions.php`

```bash
# Utilisation :
php artisan boat:update-descriptions

# Sur Railway :
railway run php artisan boat:update-descriptions

# Avec confirmation :
php artisan boat:update-descriptions --confirm
```

**Avantages** :
- Interface claire et intuitive
- Rapport détaillé
- Pas besoin de modifier DatabaseSeeder
- Peut être exécuté à tout moment

---

## Contacts et Support

**Développeur** : Votre équipe
**Dernière révision** : 28 décembre 2025
**Version Laravel** : 11.x
**Base de données** : MySQL (Railway)

---

## Annexe : Schéma des Dépendances

```
TypeSeeder ────────────┐
                       │
ZoneSeeder ────────────┼───> BateauSeeder ───> BateauMediaSeeder
                       │
ActionSeeder ──────────┤
                       │
EquipementSeeder ──────┘

UserSeeder (indépendant)

UpdateDescriptionsSeeder (dépend de Bateaux existants)
UpdatePublishedDatesSeeder (dépend de Bateaux existants)
```

---

## Conclusion

Ce système de seeders est conçu pour **sécurité et clarté**. En suivant ce guide, vous éviterez le "sacré bordel" et maintiendrez une base de données propre et stable.

**Principe final** : _En cas de doute, NE TOUCHEZ À RIEN et utilisez une commande directe._

---

**🎯 Prochaines Étapes Recommandées** :

1. ✅ Créer la commande Artisan `boat:update-descriptions`
2. ✅ Implémenter `SEEDER_MODE` dans DatabaseSeeder
3. ✅ Documenter dans `.env.example`
4. ✅ Tester en local avant déploiement Railway
5. ✅ Créer un backup automatique avant chaque seed important

---

_Gardez ce fichier à jour à chaque modification importante du système de seeders._
