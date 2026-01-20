#!/bin/bash
# Startup script for Laravel with PHP-FPM + Caddy

echo "🚀 Starting application..."

# ============================================================================
# MIGRATIONS
# ============================================================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📊 Running database migrations..."
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
php artisan migrate --force || {
    echo "⚠️  Migration failed, continuing anyway..."
}
echo "✅ Migrations complete!"
echo ""

# ============================================================================
# NETTOYAGE DES DESCRIPTIONS (OPTIONNEL)
# ============================================================================
echo "🔍 DEBUG: CLEAN_DESCRIPTIONS = '$CLEAN_DESCRIPTIONS'"

if [ "$CLEAN_DESCRIPTIONS" = "true" ]; then
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
    echo "🧹 NETTOYAGE DES DESCRIPTIONS (au démarrage)"
    echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

    echo "🚤 Cleaning boat descriptions..."
    php artisan boats:clean-descriptions || {
        echo "⚠️  Description cleaning failed, continuing anyway..."
    }

    echo "✅ Descriptions cleaned!"
    echo "💡 N'oubliez pas de retirer CLEAN_DESCRIPTIONS=true après le premier démarrage"
else
    echo "⏭️  Description cleaning skipped (CLEAN_DESCRIPTIONS = '$CLEAN_DESCRIPTIONS')"
fi

echo ""
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "🚀 Starting Laravel server..."
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Start Laravel with built-in server (simple and works on Railway)
exec php artisan serve --host=0.0.0.0 --port=$PORT
