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
# VIDAGE DES CACHES
# ============================================================================
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "🧹 Clearing application caches..."
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
php artisan optimize:clear || {
    echo "⚠️  Cache clearing failed, continuing anyway..."
}
echo "✅ Caches cleared!"
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
echo "🚀 Starting PHP-FPM + Caddy..."
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Make caddy executable and locate it
CADDY_BIN=$(which caddy 2>/dev/null || echo "/usr/local/bin/caddy")
chmod +x "$CADDY_BIN" 2>/dev/null || true
echo "Caddy binary: $CADDY_BIN"

# Allow PHP-FPM (nobody) to write to storage and bootstrap cache
chmod -R 777 /app/storage /app/bootstrap/cache
echo "✅ Storage permissions set"

# Start PHP-FPM (daemonized)
php-fpm -y /app/railway/php-fpm.conf
echo "✅ PHP-FPM started on 127.0.0.1:9000"

# Wait for PHP-FPM to be ready
sleep 1

# Start Caddy (foreground, keeps container alive)
exec "$CADDY_BIN" run --config /app/railway/Caddyfile --adapter caddyfile
