#!/bin/bash
# Make sure this file has executable permissions, run `chmod +x railway/init-app.sh`

# Exit the script if any command fails
set -e

echo "🚀 Starting My Boat deployment..."

# ============================================================================
# MODE 1 : NOUVELLE BASE DE DONNÉES (FRESH SETUP)
# ============================================================================
# Utilisez cette section pour la PREMIÈRE installation sur une nouvelle base
# Définir FRESH_DB=true dans Railway pour activer ce mode
# ============================================================================
if [ "$FRESH_DB" = "true" ]; then
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
    echo "🆕 MODE FRESH DATABASE - Setup complet"
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

    # Migrations complètes (reset + create)
    echo "📋 Running migrations (fresh)..."
    php artisan migrate:fresh --force

    # Import TOUT via FreshDatabaseSeeder
    echo "🌱 Seeding complete database (types, zones, bateaux, medias)..."
    php artisan db:seed --class=FreshDatabaseSeeder --force

    # Migration photos vers R2 (optionnel)
    if [ "$MIGRATE_PHOTOS_TO_R2" = "true" ]; then
        echo "📸 Migrating photos to Cloudflare R2..."
        echo "⏳ This may take 5-10 minutes..."
        php artisan photos:migrate-to-r2 || {
            echo "⚠️  Photo migration failed, continuing anyway..."
            echo "💡 You can retry manually: railway run php artisan photos:migrate-to-r2"
        }
    else
        echo "⏭️  Photo migration skipped (MIGRATE_PHOTOS_TO_R2 not set)"
        echo "💡 Photos will load from myboat-oi.com temporarily"
        echo "💡 Run later: railway run php artisan photos:migrate-to-r2"
    fi

    echo "✅ Fresh database setup complete!"

# ============================================================================
# MODE 2 : DÉPLOIEMENT NORMAL (MIGRATIONS SEULEMENT)
# ============================================================================
# Ce mode s'exécute par défaut pour les déploiements réguliers
# Il applique seulement les nouvelles migrations sans toucher aux données
# ============================================================================
else
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
    echo "🔄 MODE NORMAL - Déploiement régulier"
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

    # Migrations incrémentales uniquement
    echo "📊 Running new migrations..."
    php artisan migrate --force

    # Seeders essentiels (idempotents - vérifient l'existence)
    echo "🌱 Seeding essential data (types, zones, actions)..."
    php artisan db:seed --force

    # Legacy: Support pour SEED_BOATS (deprecated)
    if [ "$SEED_BOATS" = "true" ]; then
        echo "⚠️  SEED_BOATS is deprecated, use FRESH_DB=true instead"
        echo "🚤 Importing boats from JSON..."
        php artisan db:seed --class=CleanBateauxSeeder --force
        php artisan db:seed --class=BateauSeeder --force
        php artisan db:seed --class=BateauMediaSeeder --force
        echo "✅ Boats imported!"
    fi

    echo "✅ Deployment migrations complete!"
fi

# ============================================================================
# NETTOYAGE DES DESCRIPTIONS (OPTIONNEL)
# ============================================================================
# Nettoie les descriptions des bateaux (remplace \n par de vrais sauts de ligne)
# Définir CLEAN_DESCRIPTIONS=true dans Railway pour activer
# ============================================================================
if [ "$CLEAN_DESCRIPTIONS" = "true" ]; then
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
    echo "🧹 NETTOYAGE DES DESCRIPTIONS"
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

    echo "🚤 Cleaning boat descriptions..."
    php artisan boats:clean-descriptions || {
        echo "⚠️  Description cleaning failed, continuing anyway..."
        echo "💡 You can retry manually: railway run php artisan boats:clean-descriptions"
    }

    echo "✅ Descriptions cleaned!"
else
    echo "⏭️  Description cleaning skipped (CLEAN_DESCRIPTIONS not set)"
fi

# ============================================================================
# OPTIMISATIONS (TOUJOURS EXÉCUTÉES)
# ============================================================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "⚡ Optimizing Laravel..."
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Clear cache
php artisan optimize:clear

# Cache components
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache

echo "✅ Optimization complete!"
echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "🎉 Deployment ready!"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
