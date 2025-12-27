# 🔧 Correction des Catégories d'Équipements

## Problème

Les équipements ont des catégories en **majuscules** dans la base de données :
- Navigation, Confort, Sécurité, Électronique, Manœuvre, Loisirs

Mais le code attend des catégories en **minuscules** :
- navigation, confort, securite, electronique, manoeuvre, loisirs

Résultat : Les équipements ne s'affichent pas sur les pages d'annonces.

## Solution

### En Local (XAMPP)

```bash
php artisan equipements:fix-categories
```

### Sur Railway (Production)

#### Option 1 : Via Railway CLI
```bash
railway run php artisan equipements:fix-categories
```

#### Option 2 : Via Railway Shell
1. Allez sur Railway Dashboard
2. Cliquez sur votre service
3. Ouvrez le Shell
4. Exécutez : `php artisan equipements:fix-categories`

## Ce que fait la commande

✅ Convertit toutes les catégories de majuscules vers minuscules
✅ Préserve tous vos équipements existants
✅ Préserve les libellés et icônes
✅ Affiche le nombre d'équipements mis à jour par catégorie

## Résultat attendu

```
🔧 Fixing equipment categories...
  ✓ Updated 6 equipments from 'Navigation' to 'navigation'
  ✓ Updated 9 equipments from 'Confort' to 'confort'
  ✓ Updated 8 equipments from 'Sécurité' to 'securite'
  ✓ Updated 9 equipments from 'Électronique' to 'electronique'
  ✓ Updated 8 equipments from 'Manœuvre' to 'manoeuvre'
  ✓ Updated 10 equipments from 'Loisirs' to 'loisirs'
✅ Total: 50 equipment categories fixed!
```

## Après la correction

Après avoir exécuté cette commande :
1. Les équipements s'afficheront correctement dans le formulaire d'admin
2. Les équipements s'afficheront sur les pages d'annonces
3. Vous n'aurez PLUS JAMAIS besoin de relancer cette commande

## Important

⚠️ **À exécuter UNE SEULE FOIS**
⚠️ **Ne supprime AUCUN équipement**
⚠️ **Ne modifie que les catégories**

## Vérification

Pour vérifier que les catégories sont bien en minuscules :

```bash
php artisan tinker --execute="echo App\Models\Equipement::select('categorie', DB::raw('count(*) as total'))->groupBy('categorie')->get();"
```

Vous devriez voir :
```json
[
  {"categorie":"navigation","total":6},
  {"categorie":"confort","total":9},
  {"categorie":"securite","total":8},
  {"categorie":"electronique","total":9},
  {"categorie":"manoeuvre","total":8},
  {"categorie":"loisirs","total":10}
]
```

Si vous voyez des catégories avec majuscules (Navigation, Confort, etc.), relancez la commande.
