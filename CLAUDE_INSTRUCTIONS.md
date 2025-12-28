# Instructions Permanentes pour Claude Code

> **IMPORTANT** : Ce fichier contient des instructions critiques à suivre lors de toute modification du projet My Boat. Claude doit lire et respecter ces règles avant toute opération.

---

## 🔴 RÈGLES CRITIQUES - SEEDERS

### ⛔ NE JAMAIS FAIRE

1. **NE JAMAIS décommenter les seeders d'import initial en production**
   - `CleanBateauxSeeder` ❌ DESTRUCTIF - Supprime tous les bateaux
   - `BateauSeeder` ❌ Réimporte tout
   - `BateauMediaSeeder` ❌ Réimporte toutes les images

2. **NE JAMAIS modifier DatabaseSeeder sans documentation**
   - Toute modification doit être documentée
   - Toujours vérifier l'impact en production
   - Utiliser les commandes directes plutôt que décommenter

3. **NE JAMAIS exécuter de seeder destructif sans backup**
   - Toujours demander confirmation à l'utilisateur
   - Vérifier qu'un backup existe
   - Documenter la raison

### ✅ WORKFLOW À SUIVRE

#### Pour mettre à jour des données (ex: descriptions)

**Option 1 - RECOMMANDÉE** : Commande Artisan directe
```bash
# Local
php artisan boat:update-descriptions --preview=10
php artisan boat:update-descriptions --dry-run
php artisan boat:update-descriptions

# Railway
railway run php artisan boat:update-descriptions
```

**Option 2** : Seeder direct
```bash
php artisan db:seed --class=UpdateDescriptionsSeeder
railway run php artisan db:seed --class=UpdateDescriptionsSeeder --force
```

**Option 3** : Temporairement via DatabaseSeeder
1. ⚠️ Demander confirmation à l'utilisateur
2. Décommenter le seeder spécifique (ex: `UpdateDescriptionsSeeder`)
3. Commit et push
4. Vérifier l'exécution sur Railway
5. **IMPORTANT** : RE-COMMENTER immédiatement
6. Commit et push à nouveau

#### Pour créer un nouveau seeder de mise à jour

1. **Créer le seeder** dans `database/seeders/`
   - Le nommer clairement (ex: `UpdateFieldNameSeeder.php`)
   - Le rendre IDEMPOTENT (peut s'exécuter plusieurs fois)
   - Ajouter des logs/output détaillés
   - Utiliser des transactions
   - NE PAS créer ou supprimer de bateaux

2. **Créer une commande Artisan** dans `app/Console/Commands/`
   - Nommer: `Update{Field}Command.php`
   - Ajouter `--dry-run`, `--preview`, `--force` options
   - Ajouter des confirmations
   - Afficher des rapports détaillés

3. **Documenter** dans `database/seeders/DatabaseSeeder.php`
   - Ajouter dans la section "CATÉGORIE 3"
   - Expliquer l'action
   - Indiquer la dernière exécution
   - Donner les commandes directes

4. **Mettre à jour la documentation**
   - `database/seeders/README_SEEDER_WORKFLOW.md`
   - `database/seeders/QUICK_REFERENCE.md`
   - Ajouter dans l'inventaire

---

## 📊 ÉTAT ACTUEL DE LA PRODUCTION

### Base de données Railway (MySQL)
- **Bateaux** : 55
- **Images** : 457
- **Dernier import** : 2025-12-27
- **Seeders actifs** : Essentiels uniquement (Types, Zones, Actions, Equipement, User)

### Fichiers de référence
- **Source JSON** : `database/seeders/bateaux_scraped_data.json`
- **Seeder principal** : `database/seeders/BateauSeeder.php`
- **Database seeder** : `database/seeders/DatabaseSeeder.php`

### Scripts disponibles
- `scripts/clean_boat_descriptions.php` - Nettoie les descriptions dans le JSON
- `scripts/generate_description_update_sql.py` - Génère SQL de migration
- `database/migrations/update_boat_descriptions.sql` - Migration SQL MySQL

---

## 🛠️ MODIFICATIONS DE DONNÉES

### Workflow pour modifier les données de bateaux

1. **Modifier le fichier source**
   - Éditer `database/seeders/bateaux_scraped_data.json`
   - OU utiliser un script de nettoyage/transformation

2. **Régénérer le seeder PHP**
   ```bash
   python scripts/regenerate_seeder.py
   ```

3. **Créer un seeder de mise à jour**
   - Suivre le workflow "Pour créer un nouveau seeder" ci-dessus
   - Exemple : `UpdateDescriptionsSeeder.php`

4. **Tester localement**
   ```bash
   php artisan boat:update-{field} --dry-run
   ```

5. **Appliquer en production**
   ```bash
   railway run php artisan boat:update-{field}
   ```

6. **Vérifier**
   ```bash
   railway logs --follow
   ```

### Workflow pour ajouter de nouveaux bateaux

1. **Ajouter au JSON**
   - Éditer `database/seeders/bateaux_scraped_data.json`
   - Respecter la structure existante

2. **Régénérer le seeder**
   ```bash
   python scripts/regenerate_seeder.py
   ```

3. **Créer un seeder d'ajout**
   - NE PAS utiliser `BateauSeeder` (réimporte tout)
   - Créer `AddNewBoatsSeeder.php` qui ajoute uniquement les nouveaux
   - Vérifier par slug si le bateau existe déjà

4. **Exécuter**
   ```bash
   railway run php artisan db:seed --class=AddNewBoatsSeeder --force
   ```

---

## 🔐 RÈGLES DE SÉCURITÉ

### Avant toute opération de seeding

- [ ] Vérifier quel seeder va s'exécuter
- [ ] Lire la documentation du seeder
- [ ] Comprendre si c'est destructif ou non
- [ ] Tester en local d'abord (si possible)
- [ ] Vérifier qu'un backup existe (si destructif)
- [ ] Demander confirmation à l'utilisateur (si doute)

### Catégories de seeders

| Catégorie | Sécurité | Fréquence | Commenté |
|-----------|----------|-----------|----------|
| **Essentiels** | ✅ Sûr | Chaque déploiement | ❌ Non |
| **Import Initial** | ⛔ Destructif | Une fois | ✅ Oui |
| **Mises à jour** | ✅ Sûr | Sur demande | ✅ Oui |

### Messages à l'utilisateur

Quand l'utilisateur demande de modifier des données :

1. **Analyser la demande**
   - Quel type de modification ?
   - Combien de bateaux affectés ?
   - Risque de perte de données ?

2. **Proposer la méthode la plus sûre**
   - Privilégier les commandes directes
   - Éviter de décommenter dans DatabaseSeeder si possible
   - Expliquer les options disponibles

3. **Demander confirmation si risque**
   ```
   ⚠️ Cette opération va [ACTION].
   Voulez-vous continuer ?
   Options disponibles :
   1. [Option sûre]
   2. [Option alternative]
   ```

---

## 📁 STRUCTURE DES FICHIERS

### Seeders (`database/seeders/`)
```
├── DatabaseSeeder.php           # Orchestrateur principal
├── bateaux_scraped_data.json    # Source de données
├── BateauSeeder.php             # Import complet (commenté)
├── BateauMediaSeeder.php        # Import images (commenté)
├── CleanBateauxSeeder.php       # Nettoyage (commenté)
├── UpdateDescriptionsSeeder.php # MAJ descriptions
├── UpdatePublishedDatesSeeder.php # MAJ dates
├── TypeSeeder.php               # Toujours actif
├── ZoneSeeder.php               # Toujours actif
├── ActionSeeder.php             # Toujours actif
├── EquipementSeeder.php         # Toujours actif
├── UserSeeder.php               # Toujours actif
├── README_SEEDER_WORKFLOW.md    # Documentation complète
├── QUICK_REFERENCE.md           # Référence rapide
├── SYSTEM_OVERVIEW.md           # Vue d'ensemble
└── FILES_CREATED.md             # Inventaire
```

### Commandes Artisan (`app/Console/Commands/`)
```
├── UpdateBoatDescriptions.php   # php artisan boat:update-descriptions
└── [Futures commandes]
```

### Scripts (`scripts/`)
```
├── clean_boat_descriptions.php         # Nettoie le JSON
├── generate_description_update_sql.py  # Génère migration SQL
└── regenerate_seeder.py                # Régénère BateauSeeder.php
```

---

## 🚀 COMMANDES RAILWAY UTILES

### Seeders
```bash
# Voir les logs en temps réel
railway logs --follow

# Exécuter un seeder spécifique
railway run php artisan db:seed --class=NomDuSeeder --force

# Exécuter une commande custom
railway run php artisan boat:update-descriptions

# Lister toutes les commandes disponibles
railway run php artisan list | grep boat
```

### Base de données
```bash
# Se connecter à MySQL
railway run mysql

# Exécuter un fichier SQL
railway run mysql < database/migrations/update_boat_descriptions.sql

# Voir les variables d'environnement
railway variables

# Définir une variable
railway variables set SEEDER_MODE=production
```

### Déploiement
```bash
# Push et déploiement auto
git push origin main

# Voir le statut du déploiement
railway status

# Redémarrer l'application
railway restart
```

---

## 📝 DOCUMENTATION DE RÉFÉRENCE

### Fichiers à consulter avant toute opération

1. **Ce fichier** : `CLAUDE_INSTRUCTIONS.md` - Instructions permanentes
2. **README principal** : `database/seeders/README_SEEDER_WORKFLOW.md` - Workflow complet
3. **Référence rapide** : `database/seeders/QUICK_REFERENCE.md` - Commandes courantes
4. **Vue système** : `database/seeders/SYSTEM_OVERVIEW.md` - Architecture

### En cas de doute

1. Lire la documentation
2. Vérifier l'état actuel en production
3. Tester en local si possible
4. Demander confirmation à l'utilisateur
5. Documenter toute modification

---

## 🎯 PRINCIPES GÉNÉRAUX

### Toujours privilégier

✅ Sécurité avant rapidité
✅ Documentation claire
✅ Opérations idempotentes
✅ Confirmations utilisateur
✅ Logs détaillés
✅ Transactions avec rollback
✅ Tests avant production

### Toujours éviter

❌ Modifications non documentées
❌ Seeders destructifs en production
❌ Opérations sans backup
❌ Modifications du DatabaseSeeder sans raison
❌ Commit de seeders décommentés
❌ Opérations irréversibles sans confirmation

---

## 🔄 CHANGELOG DE CE FICHIER

| Date | Action | Auteur |
|------|--------|--------|
| 2025-12-28 | Création du fichier d'instructions permanentes | Claude |

---

> **NOTE POUR CLAUDE** : Ce fichier doit être lu au début de chaque session concernant les seeders, la base de données, ou les modifications de données de bateaux. En cas de doute, TOUJOURS se référer à ce document et demander confirmation à l'utilisateur.
