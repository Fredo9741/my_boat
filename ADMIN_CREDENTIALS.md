# Informations de connexion - My Boat Administration

## URL de connexion
http://localhost:8000/login

## Comptes administrateurs

### 1. Administrateur Principal
- **Email**: admin@myboat.re
- **Mot de passe**: MyBoat2025!
- **Rôle**: Accès complet à toutes les fonctionnalités

### 2. Courtier Maritime
- **Email**: courtier@myboat.re
- **Mot de passe**: Courtier2025!
- **Rôle**: Gestion des annonces et clients

### 3. Gestionnaire Annonces
- **Email**: gestion@myboat.re
- **Mot de passe**: Gestion2025!
- **Rôle**: Gestion des bateaux et contenu

## Fonctionnalités admin disponibles

✅ **Dashboard** - Statistiques et vue d'ensemble
✅ **Bateaux** - CRUD complet (Créer, Lire, Modifier, Supprimer)
✅ **Types de bateaux** - Gestion des catégories (Catamaran, Voilier, etc.)
✅ **Zones géographiques** - Gestion des localisations (Réunion, Maurice, etc.)
✅ **Slogans** - Gestion des messages commerciaux (Prix en baisse!, etc.)

## Routes admin

- `/login` - Page de connexion
- `/admin/dashboard` - Tableau de bord
- `/admin/bateaux` - Liste des bateaux
- `/admin/bateaux/create` - Ajouter un bateau
- `/admin/bateaux/{id}/edit` - Modifier un bateau
- `/admin/types` - Gestion des types
- `/admin/zones` - Gestion des zones
- `/admin/actions` - Gestion des slogans

## Note technique

Tous les utilisateurs ont été créés via le seeder `UserSeeder.php`
Les mots de passe sont hashés avec bcrypt pour la sécurité.
