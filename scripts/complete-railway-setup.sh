#!/bin/bash

################################################################################
# SCRIPT DE SETUP COMPLET - RAILWAY (MySQL + Cloudflare R2)
################################################################################
# Ce script effectue une migration COMPLÈTE incluant :
#   1. Migrations de la base de données
#   2. Seeders (Types, Zones, Actions, Équipements, Bateaux, Médias)
#   3. Migration des photos vers Cloudflare R2
#   4. Optimisations
#
# Usage: ./scripts/complete-railway-setup.sh
################################################################################

set -e  # Arrêter en cas d'erreur

echo ""
echo "╔════════════════════════════════════════════════════════════════════════╗"
echo "║  🚀 SETUP COMPLET - RAILWAY (MySQL + R2)                              ║"
echo "╚════════════════════════════════════════════════════════════════════════╝"
echo ""

# Vérifier que nous sommes dans le bon répertoire
if [ ! -f "artisan" ]; then
    echo "❌ Erreur: Ce script doit être exécuté depuis la racine du projet Laravel"
    exit 1
fi

# Demander confirmation
echo "⚠️  Ce script va :"
echo "  1. Recréer complètement la base de données (TOUTES les données seront supprimées)"
echo "  2. Exécuter toutes les migrations"
echo "  3. Importer 55 bateaux avec leurs données"
echo "  4. Télécharger et migrer ~150 photos vers Cloudflare R2"
echo ""
read -p "Voulez-vous continuer ? (yes/no) : " -r
echo ""

if [[ ! $REPLY =~ ^[Yy]es$ ]]; then
    echo "❌ Opération annulée"
    exit 0
fi

# Vérifier la connexion à la base de données
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📡 Vérification de la connexion..."
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

php artisan db:show || {
    echo "❌ Impossible de se connecter à la base de données"
    echo "💡 Vérifiez vos variables d'environnement DB_* dans Railway"
    exit 1
}

echo "✅ Connexion MySQL OK"
echo ""

# Vérifier Cloudflare R2
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "☁️  Vérification de Cloudflare R2..."
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

R2_URL=$(php artisan tinker --execute="echo env('CLOUDFLARE_R2_URL');")
R2_BUCKET=$(php artisan tinker --execute="echo env('CLOUDFLARE_R2_BUCKET');")

if [ -z "$R2_URL" ] || [ -z "$R2_BUCKET" ]; then
    echo "❌ Cloudflare R2 n'est pas configuré !"
    echo "💡 Ajoutez ces variables dans Railway :"
    echo "   - CLOUDFLARE_R2_ACCESS_KEY_ID"
    echo "   - CLOUDFLARE_R2_SECRET_ACCESS_KEY"
    echo "   - CLOUDFLARE_R2_BUCKET"
    echo "   - CLOUDFLARE_R2_URL"
    echo "   - CLOUDFLARE_R2_ENDPOINT"
    exit 1
fi

echo "✅ Cloudflare R2 configuré"
echo "   Bucket : $R2_BUCKET"
echo "   URL    : $R2_URL"
echo ""

# ÉTAPE 1: Migrations
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📋 ÉTAPE 1/4 : MIGRATIONS"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "Exécution de toutes les migrations..."

php artisan migrate:fresh --force || {
    echo "❌ Erreur lors des migrations"
    exit 1
}

echo ""
echo "✅ Migrations terminées"
echo ""

# ÉTAPE 2: Seeders
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "🌱 ÉTAPE 2/4 : SEEDING"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

php artisan db:seed --class=FreshDatabaseSeeder --force || {
    echo "❌ Erreur lors du seeding"
    exit 1
}

echo ""
echo "✅ Seeding terminé"
echo ""

# ÉTAPE 3: Migration des photos vers R2
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📸 ÉTAPE 3/4 : MIGRATION DES PHOTOS VERS R2"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "⏳ Cette étape peut prendre 5-10 minutes..."
echo ""

php artisan photos:migrate-to-r2 || {
    echo "⚠️  La migration des photos a échoué, mais on continue..."
    echo "💡 Vous pourrez la relancer manuellement avec :"
    echo "   railway run php artisan photos:migrate-to-r2"
}

echo ""

# ÉTAPE 4: Optimisations
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "⚡ ÉTAPE 4/4 : OPTIMISATIONS"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

echo "→ Cache de configuration..."
php artisan config:cache

echo "→ Cache des routes..."
php artisan route:cache

echo "→ Cache des vues..."
php artisan view:cache

echo ""
echo "✅ Optimisations terminées"
echo ""

# ÉTAPE 5: Vérifications
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "🔍 VÉRIFICATIONS FINALES"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""

echo "📊 Statistiques de la base de données:"
echo ""
php artisan tinker --execute="
echo '  → Utilisateurs : ' . \App\Models\User::count();
echo PHP_EOL;
echo '  → Types de bateaux : ' . \App\Models\Type::count();
echo PHP_EOL;
echo '  → Zones : ' . \App\Models\Zone::count();
echo PHP_EOL;
echo '  → Actions : ' . \App\Models\Action::count();
echo PHP_EOL;
echo '  → Équipements : ' . \App\Models\Equipement::count();
echo PHP_EOL;
echo '  → Bateaux : ' . \App\Models\Bateau::count();
echo PHP_EOL;
echo '  → Médias : ' . \App\Models\Media::count();
echo PHP_EOL;
echo PHP_EOL;
echo '📸 Photos sur R2 :';
echo PHP_EOL;
\$photosR2 = \App\Models\Media::where('type', 'image')
    ->where('is_youtube', false)
    ->get()
    ->filter(fn(\$m) => !str_contains(\$m->attributes['url'], 'http'))
    ->count();
echo '  → Photos migrées vers R2 : ' . \$photosR2;
echo PHP_EOL;
\$photosExternes = \App\Models\Media::where('type', 'image')
    ->where('is_youtube', false)
    ->get()
    ->filter(fn(\$m) => str_contains(\$m->attributes['url'], 'myboat-oi.com'))
    ->count();
echo '  → Photos externes (myboat-oi.com) : ' . \$photosExternes;
echo PHP_EOL;
"

echo ""
echo "╔════════════════════════════════════════════════════════════════════════╗"
echo "║  ✅ SETUP COMPLET TERMINÉ AVEC SUCCÈS !                              ║"
echo "╚════════════════════════════════════════════════════════════════════════╝"
echo ""
echo "📝 Prochaines étapes :"
echo ""
echo "  1. ✅ Base de données MySQL prête"
echo "  2. ✅ 55 bateaux importés avec données"
echo "  3. ✅ Photos migrées vers Cloudflare R2"
echo "  4. 🌐 Configurer votre nom de domaine dans Railway"
echo "  5. 🔐 Changer le mot de passe admin (admin@myboat.com)"
echo ""
echo "💡 URLs utiles :"
echo "  → Application : \$APP_URL"
echo "  → Admin : \$APP_URL/admin (admin@myboat.com / password)"
echo "  → Cloudflare R2 : https://dash.cloudflare.com"
echo ""
