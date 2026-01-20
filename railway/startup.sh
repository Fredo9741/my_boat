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
echo "🚀 Starting PHP-FPM + Caddy..."
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"

# Create PHP-FPM config
mkdir -p /tmp/php-fpm
cat > /tmp/php-fpm/www.conf << 'FPMCONF'
[www]
user = nobody
group = nobody
listen = 127.0.0.1:9000
pm = dynamic
pm.max_children = 10
pm.start_servers = 2
pm.min_spare_servers = 1
pm.max_spare_servers = 4
pm.max_requests = 500
clear_env = no
FPMCONF

# Start PHP-FPM in background
php-fpm -y /tmp/php-fpm/www.conf &

# Wait for PHP-FPM to start
sleep 2

# Start Caddy (blocks and keeps container running)
exec caddy run --config /app/Caddyfile --adapter caddyfile
