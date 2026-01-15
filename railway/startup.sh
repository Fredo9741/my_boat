#!/bin/bash
# Startup script that runs AFTER deployment, when environment variables are available

echo "🚀 Starting application..."

# ============================================================================
# NETTOYAGE DES DESCRIPTIONS (OPTIONNEL - AU PREMIER DÉMARRAGE)
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
echo "🚀 Starting Laravel Octane with FrankenPHP..."
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Start Octane (this will block and keep the container running)
exec php artisan octane:start --server=frankenphp --host=0.0.0.0 --port=$PORT
