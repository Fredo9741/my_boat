#!/bin/bash

################################################################################
# SCRIPT DE MIGRATION COMPLÈTE - NOUVELLE BASE RAILWAY (MySQL)
################################################################################
# Ce script effectue une migration complète avec migrations + seeders
# Usage: ./scripts/fresh-railway-migration.sh
################################################################################

set -e  # Arrêter en cas d'erreur

echo ""
echo "╔════════════════════════════════════════════════════════════════════════╗"
echo "║  🚀 MIGRATION COMPLÈTE - NOUVELLE BASE RAILWAY (MySQL)                ║"
echo "╚════════════════════════════════════════════════════════════════════════╝"
echo ""

# Vérifier que nous sommes dans le bon répertoire
if [ ! -f "artisan" ]; then
    echo "❌ Erreur: Ce script doit être exécuté depuis la racine du projet Laravel"
    exit 1
fi

# Vérifier la connexion à la base de données
echo "📡 Vérification de la connexion à la base de données MySQL..."
php artisan db:show || {
    echo "❌ Impossible de se connecter à la base de données"
    echo "💡 Vérifiez vos variables d'environnement DB_* dans Railway"
    exit 1
}

echo "✅ Connexion à la base de données OK"
echo ""

# ÉTAPE 1: Migrations
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "📋 ÉTAPE 1/3 : MIGRATIONS"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "Exécution de toutes les migrations dans l'ordre..."

php artisan migrate:fresh --force || {
    echo "❌ Erreur lors des migrations"
    exit 1
}

echo ""
echo "✅ Migrations terminées avec succès"
echo ""

# ÉTAPE 2: Seeders
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "🌱 ÉTAPE 2/3 : SEEDING DE LA BASE"
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo ""
echo "Exécution du FreshDatabaseSeeder..."
echo ""

php artisan db:seed --class=FreshDatabaseSeeder --force || {
    echo "❌ Erreur lors du seeding"
    exit 1
}

echo ""
echo "✅ Seeding terminé avec succès"
echo ""

# ÉTAPE 3: Optimisations
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━"
echo "⚡ ÉTAPE 3/3 : OPTIMISATIONS"
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

# ÉTAPE 4: Vérifications
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
"

echo ""
echo "╔════════════════════════════════════════════════════════════════════════╗"
echo "║  ✅ MIGRATION TERMINÉE AVEC SUCCÈS !                                  ║"
echo "╚════════════════════════════════════════════════════════════════════════╝"
echo ""
echo "📝 Prochaines étapes recommandées:"
echo ""
echo "  1. Vérifier que l'application fonctionne sur Railway"
echo "  2. Tester l'upload de photos (vérifier config Cloudflare R2)"
echo "  3. Vérifier l'affichage des bateaux existants"
echo "  4. Configurer votre nom de domaine personnalisé"
echo ""
echo "💡 Notes sur les photos:"
echo "  → Photos seedées : pointent vers myboat-oi.com (temporaire)"
echo "  → Nouvelles photos : seront uploadées sur votre Cloudflare R2"
echo "  → Les deux systèmes cohabitent grâce au helper r2_url()"
echo ""
