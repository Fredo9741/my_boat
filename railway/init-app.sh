#!/bin/bash
# Make sure this file has executable permissions, run `chmod +x railway/init-app.sh`

# Exit the script if any command fails
set -e

echo "🚀 Starting My Boat deployment..."

# Run migrations
echo "📊 Running database migrations..."
php artisan migrate --force

# Clear cache
echo "🧹 Clearing Laravel cache..."
php artisan optimize:clear

# Cache the various components of the Laravel application
echo "⚡ Optimizing Laravel..."
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment preparation complete!"
