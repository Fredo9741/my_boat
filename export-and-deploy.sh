#!/bin/bash

# Script pour exporter les données locales et les déployer sur Railway

echo "=========================================="
echo "Export et Déploiement des Données"
echo "=========================================="
echo ""

# Étape 1 : Export des données
echo "[1/5] Export des données locales vers les seeders..."
php artisan db:export-to-seeders
if [ $? -ne 0 ]; then
    echo "❌ Erreur lors de l'export !"
    exit 1
fi
echo ""

# Étape 2 : Test local
echo "[2/5] Test de l'import en local..."
read -p "Voulez-vous tester l'import en local ? (O/N) " test_local
if [[ "$test_local" =~ ^[Oo]$ ]]; then
    echo "⚠️  Attention : Cela va réinitialiser votre base locale !"
    read -p "Confirmer ? (O/N) " confirm
    if [[ "$confirm" =~ ^[Oo]$ ]]; then
        php artisan migrate:fresh --seed
        if [ $? -ne 0 ]; then
            echo "❌ Erreur lors du test local !"
            exit 1
        fi
        echo "✅ Test local réussi !"
    fi
fi
echo ""

# Étape 3 : Git add
echo "[3/5] Ajout des seeders à Git..."
git add database/seeders/
git status --short
echo ""

# Étape 4 : Git commit
echo "[4/5] Création du commit..."
read -p "Entrez le message de commit (ou appuyez sur Entrée pour le message par défaut) : " commit_msg
if [ -z "$commit_msg" ]; then
    commit_msg="Update production seeders with local data"
fi
git commit -m "$commit_msg"
if [ $? -ne 0 ]; then
    echo "⚠️  Aucun changement à commiter ou erreur lors du commit"
    echo ""
fi

# Étape 5 : Git push
echo "[5/5] Push vers Railway..."
read -p "Voulez-vous pusher vers Railway maintenant ? (O/N) " do_push
if [[ "$do_push" =~ ^[Oo]$ ]]; then
    git push
    if [ $? -ne 0 ]; then
        echo "❌ Erreur lors du push !"
        exit 1
    fi
    echo ""
    echo "=========================================="
    echo "✅ Déploiement lancé sur Railway !"
    echo "=========================================="
    echo ""
    echo "Suivez le déploiement sur : https://railway.app"
else
    echo "Push annulé. Vous pouvez le faire manuellement avec : git push"
fi

echo ""
echo "✅ Script terminé !"
