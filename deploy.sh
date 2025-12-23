#!/bin/bash
set -e

echo "🚀 Starting deployment..."

# Run migrations
echo "📦 Running migrations..."
php artisan migrate --force

# Check if database is empty (no bateaux)
BATEAU_COUNT=$(php artisan tinker --execute="echo \App\Models\Bateau::count();")

if [ "$BATEAU_COUNT" -eq "0" ]; then
    echo "🌱 Database is empty, running seeders..."
    php artisan db:seed --force
else
    echo "✅ Database already seeded, skipping..."
fi

# Optimize application
echo "⚡ Optimizing application..."
php artisan optimize
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "✅ Deployment completed successfully!"

# Start the application
echo "🌐 Starting web server..."
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
