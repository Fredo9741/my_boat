# Guide Rapide des Seeders - Référence Quotidienne

> Guide de référence rapide pour les opérations courantes avec les seeders

---

## Commandes les Plus Utilisées

### Mise à jour des descriptions

```bash
# RECOMMANDÉ : Via commande custom
php artisan boat:update-descriptions

# Sur Railway
railway run php artisan boat:update-descriptions

# Aperçu sans modification (dry-run)
php artisan boat:update-descriptions --dry-run

# Voir les 10 premiers bateaux qui seront modifiés
php artisan boat:update-descriptions --preview=10

# Exécuter sans confirmation
php artisan boat:update-descriptions --no-confirm
```

### Exécuter un seeder spécifique

```bash
# En local
php artisan db:seed --class=UpdateDescriptionsSeeder
php artisan db:seed --class=UpdatePublishedDatesSeeder

# Sur Railway
railway run php artisan db:seed --class=UpdateDescriptionsSeeder --force
```

### Exécuter tous les seeders actifs

```bash
# En local
php artisan db:seed

# Sur Railway (automatique à chaque déploiement)
railway run php artisan db:seed --force
```

---

## Workflows Rapides

### Je veux mettre à jour les descriptions en production

**Option 1 : Commande directe (RECOMMANDÉ)**
```bash
railway run php artisan boat:update-descriptions
```

**Option 2 : Via DatabaseSeeder**
1. Décommenter `UpdateDescriptionsSeeder` dans `DatabaseSeeder.php`
2. Commit et push
3. Railway exécute automatiquement
4. RE-COMMENTER et re-push

### Je veux tester en local

```bash
# 1. Reset complet
php artisan migrate:fresh

# 2. Seed complet
php artisan db:seed

# 3. Tester une mise à jour
php artisan boat:update-descriptions --dry-run
```

### Je veux faire un backup avant modification

```bash
# Via Railway CLI
railway run mysqldump -u root -p database_name > backup_$(date +%Y%m%d).sql

# Ou via Railway Dashboard
# Database > Backups > Create Backup
```

---

## Checklist de Sécurité

Avant de déployer en production :

- [ ] Les seeders d'import initial sont COMMENTÉS
- [ ] Seuls les seeders essentiels sont actifs
- [ ] Un backup existe si modification importante
- [ ] J'ai testé en local d'abord
- [ ] Je sais ce que chaque seeder fait

---

## État Actuel de la Production

| Élément | Valeur |
|---------|--------|
| Bateaux en base | 55 |
| Images | 457 |
| Dernier import | 27/12/2025 |
| Seeders actifs | Essentiels uniquement |

---

## En Cas de Problème

### Tous mes bateaux ont disparu !

```bash
# 1. Restaurer le backup Railway
railway backup restore <backup-id>

# 2. Ou ré-importer (si vous avez le JSON)
# Dans DatabaseSeeder.php, décommenter temporairement :
# - CleanBateauxSeeder
# - BateauSeeder
# - BateauMediaSeeder
# Puis exécuter : php artisan db:seed
# PUIS RE-COMMENTER !
```

### Les seeders créent des doublons

```bash
# Vérifier que les seeders essentiels ont bien leurs protections
# Voir : TypeSeeder, ZoneSeeder, ActionSeeder, etc.
# Ils doivent vérifier l'existence avant de créer
```

### Erreur "JSON file not found"

```bash
# Vérifier que le fichier existe
ls database/seeders/bateaux_scraped_data.json

# S'il manque, vérifier qu'il est bien commité dans git
git status database/seeders/bateaux_scraped_data.json
```

---

## Variables d'Environnement

### Sur Railway

```bash
# Voir toutes les variables
railway variables

# Définir SEEDER_MODE
railway variables set SEEDER_MODE=production

# Autres valeurs possibles :
railway variables set SEEDER_MODE=update    # Pour mises à jour
railway variables set SEEDER_MODE=fresh     # ⚠️ DANGER : réinitialisation complète
```

---

## Aide Rapide

| Je veux... | Commande |
|-----------|----------|
| Mettre à jour les descriptions | `php artisan boat:update-descriptions` |
| Voir ce qui va changer | `php artisan boat:update-descriptions --dry-run` |
| Exécuter un seeder spécifique | `php artisan db:seed --class=NomDuSeeder` |
| Voir les logs Railway | `railway logs` |
| Créer un backup | Railway Dashboard > Database > Backups |
| Documentation complète | `database/seeders/README_SEEDER_WORKFLOW.md` |

---

## Bonnes Pratiques

1. **Toujours tester en local d'abord**
2. **Faire un backup avant toute modification importante**
3. **Utiliser --dry-run pour prévisualiser**
4. **Préférer les commandes directes aux modifications de DatabaseSeeder**
5. **Documenter chaque exécution importante**

---

## Contacts

- Documentation complète : `database/seeders/README_SEEDER_WORKFLOW.md`
- Commande custom : `app/Console/Commands/UpdateBoatDescriptions.php`
- Seeder principal : `database/seeders/DatabaseSeeder.php`

---

**Dernière mise à jour** : 28 décembre 2025
