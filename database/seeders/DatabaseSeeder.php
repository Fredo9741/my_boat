<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

/**
 * DatabaseSeeder - Orchestration des Seeders de la Marketplace
 *
 * CONFIGURATION ACTUELLE : Production (Railway)
 * ÉTAT : 55 bateaux en base, import initial terminé
 *
 * Pour comprendre le workflow complet, consultez :
 * database/seeders/README_SEEDER_WORKFLOW.md
 *
 * @see database/seeders/README_SEEDER_WORKFLOW.md
 */
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * IMPORTANT : Ce fichier est exécuté automatiquement par Railway
     * à chaque déploiement via : php artisan db:seed --force
     */
    public function run(): void
    {
        $mode = env('SEEDER_MODE', 'production');

        // ============================================================================
        // 🟢 CATÉGORIE 1 : SEEDERS ESSENTIELS (Toujours Actifs)
        // ============================================================================
        // Ces seeders sont IDEMPOTENTS et peuvent être exécutés à chaque déploiement
        // Ils vérifient l'existence des données avant de créer pour éviter les doublons
        // ✅ SÉCURISÉ pour production - Ne pas commenter
        // ============================================================================

        $this->call([
            TypeSeeder::class,          // Types de bateaux (Catamaran, Voilier, etc.)
            ZoneSeeder::class,          // Zones géographiques (Réunion, Maurice, etc.)
            ActionSeeder::class,        // Slogans/Actions (Coup de coeur, Vendu, etc.)
            EquipementSeeder::class,    // Équipements disponibles (GPS, VHF, etc.)
            UserSeeder::class,          // Utilisateur admin par défaut
        ]);

        // ============================================================================
        // 🔵 CATÉGORIE 2 : IMPORT INITIAL (Exécution Unique)
        // ============================================================================
        // ⚠️ DANGER : Ces seeders sont DESTRUCTIFS et ont déjà été exécutés
        // Désactivés le : 27/12/2025 après import réussi
        // Résultat : 55 bateaux + 457 images importés avec succès
        //
        // ⛔ NE DÉCOMMENTEZ JAMAIS EN PRODUCTION sauf si vous voulez :
        //    - Supprimer tous les bateaux existants (CleanBateauxSeeder)
        //    - Réimporter tous les bateaux depuis le JSON (BateauSeeder)
        //    - Réimporter toutes les images (BateauMediaSeeder)
        //
        // 💡 Pour installation fraîche uniquement, puis RE-COMMENTER immédiatement
        // ============================================================================

        // $this->call([
        //     CleanBateauxSeeder::class,   // ⚠️ SUPPRIME tous les bateaux et médias
        //     BateauSeeder::class,         // Importe 55 bateaux depuis JSON
        //     BateauMediaSeeder::class,    // Importe 457 images
        // ]);

        // ============================================================================
        // 🟡 CATÉGORIE 3 : MISES À JOUR PONCTUELLES (Activation Temporaire)
        // ============================================================================
        // Ces seeders sont NON DESTRUCTIFS et IDEMPOTENTS
        // Ils ne font que MODIFIER des champs spécifiques sur les bateaux existants
        // ✅ SÉCURISÉ : Peuvent être décommentés temporairement sans danger
        //
        // MÉTHODE RECOMMANDÉE : Utiliser une commande directe au lieu de décommenter
        //   • php artisan db:seed --class=UpdateDescriptionsSeeder
        //   • php artisan boat:update-descriptions (commande custom)
        //   • railway run php artisan boat:update-descriptions
        //
        // MÉTHODE ALTERNATIVE : Décommenter ci-dessous, déployer, puis RE-COMMENTER
        // ============================================================================

        // ──────────────────────────────────────────────────────────────────────────
        // UpdatePublishedDatesSeeder
        // ──────────────────────────────────────────────────────────────────────────
        // Dernière exécution : 28/12/2025
        // Action : Met à jour le champ 'published_at' des bateaux depuis le JSON
        // Statut : ✅ Exécuté avec succès, désactivé
        // ──────────────────────────────────────────────────────────────────────────
        // $this->call([
        //     UpdatePublishedDatesSeeder::class,
        // ]);

        // ──────────────────────────────────────────────────────────────────────────
        // UpdateDescriptionsSeeder
        // ──────────────────────────────────────────────────────────────────────────
        // Dernière exécution : 2025-12-28 ✅ Succès
        // Action : Met à jour uniquement le champ 'description' des bateaux
        // Comportement : Idempotent, affiche un rapport détaillé
        // Sécurité : Ne crée ni ne supprime de bateaux
        //
        // Pour exécuter à nouveau sans modifier ce fichier :
        //   railway run php artisan db:seed --class=UpdateDescriptionsSeeder
        //   OU
        //   railway run php artisan boat:update-descriptions
        // ──────────────────────────────────────────────────────────────────────────
        // $this->call([
        //     UpdateDescriptionsSeeder::class,
        // ]);

        // ============================================================================
        // 🔧 MODE SEEDER (Optionnel - Variable d'environnement)
        // ============================================================================
        // Alternative à la gestion manuelle des commentaires
        // Utilisez SEEDER_MODE dans .env pour contrôler les seeders actifs
        //
        // Valeurs possibles :
        //   • production (défaut) : Seeders essentiels uniquement
        //   • fresh : Import complet (essentiels + import initial)
        //   • update : Seeders essentiels + seeders de mise à jour
        //   • development : Tous les seeders activés
        //
        // Configuration Railway :
        //   railway variables set SEEDER_MODE=production
        //
        // Décommentez le bloc ci-dessous pour activer cette fonctionnalité :
        // ============================================================================

        /*
        // Import initial si mode 'fresh' ou 'development'
        if (in_array($mode, ['fresh', 'development'])) {
            $this->call([
                CleanBateauxSeeder::class,
                BateauSeeder::class,
                BateauMediaSeeder::class,
            ]);
        }

        // Mises à jour si mode 'update' ou 'development'
        if (in_array($mode, ['update', 'development'])) {
            $this->call([
                UpdateDescriptionsSeeder::class,
                UpdatePublishedDatesSeeder::class,
            ]);
        }
        */

        // ============================================================================
        // 📚 DOCUMENTATION COMPLÈTE
        // ============================================================================
        // Pour tous les détails sur :
        //   • Les catégories de seeders
        //   • Les workflows par scénario (installation, production, update)
        //   • Les règles de sécurité
        //   • L'exécution sur Railway
        //   • Le dépannage
        //
        // Consultez : database/seeders/README_SEEDER_WORKFLOW.md
        // ============================================================================
    }
}

