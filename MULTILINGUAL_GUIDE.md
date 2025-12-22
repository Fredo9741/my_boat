# Guide Multilingue - My Boat

## Configuration actuelle

Votre site est maintenant disponible en **3 langues** :
- 🇫🇷 **Français** (par défaut)
- 🇬🇧 **Anglais**
- 🇳🇱 **Néerlandais**

## Comment ça fonctionne

### 1. URLs localisées

Les URLs incluent maintenant le code de langue :
- `http://localhost/fr/bateaux` - Version française
- `http://localhost/en/bateaux` - Version anglaise
- `http://localhost/nl/bateaux` - Version néerlandaise

### 2. Sélecteur de langue

Un sélecteur de langue a été ajouté dans le header (icône globe 🌍).
Il permet de basculer facilement entre les langues disponibles.

### 3. Fichiers de traduction

Les traductions sont stockées dans :
```
lang/
├── fr.json  (Français)
├── en.json  (Anglais)
└── nl.json  (Néerlandais)
```

## Comment ajouter des traductions

### Pour les textes statiques (interface)

1. **Dans les vues Blade**, utilisez la fonction `__()` :
   ```blade
   <!-- Avant -->
   <h1>Toutes les annonces</h1>

   <!-- Après -->
   <h1>{{ __('Toutes les annonces') }}</h1>
   ```

2. **Ajoutez la traduction dans les fichiers JSON** :
   ```json
   // lang/fr.json
   {
     "Toutes les annonces": "Toutes les annonces"
   }

   // lang/en.json
   {
     "Toutes les annonces": "All listings"
   }

   // lang/nl.json
   {
     "Toutes les annonces": "Alle advertenties"
   }
   ```

### Pour les contenus dynamiques (Types, Zones, Actions)

Les tables ont maintenant un champ `libelle_translations` (JSON) :

```php
// Exemple de structure :
{
  "en": "Sailboat",
  "nl": "Zeilboot"
}
```

**Pour afficher dans la bonne langue** :
```blade
{{ $type->libelle_translations[app()->getLocale()] ?? $type->libelle }}
```

## Ajouter une nouvelle langue

### Étape 1 : Configurer la langue

Dans `config/laravellocalization.php`, ajoutez la langue :
```php
'supportedLocales' => [
    'fr'          => ['name' => 'French',    'script' => 'Latn', 'native' => 'Français',    'regional' => 'fr_FR'],
    'en'          => ['name' => 'English',   'script' => 'Latn', 'native' => 'English',     'regional' => 'en_GB'],
    'nl'          => ['name' => 'Dutch',     'script' => 'Latn', 'native' => 'Nederlands',  'regional' => 'nl_NL'],
    'de'          => ['name' => 'German',    'script' => 'Latn', 'native' => 'Deutsch',     'regional' => 'de_DE'],  // Nouvelle langue
],
```

### Étape 2 : Créer le fichier de traduction

Créez `lang/de.json` et copiez le contenu de `lang/fr.json`, puis traduisez :
```json
{
    "Accueil": "Startseite",
    "Annonces": "Anzeigen",
    "Catégories": "Kategorien",
    ...
}
```

### Étape 3 : Tester

Visitez `http://localhost/de/bateaux` pour voir la nouvelle langue.

## Traduire automatiquement avec l'IA

### Méthode simple (recommandée)

1. Ouvrez `lang/fr.json`
2. Copiez tout le contenu
3. Demandez à une IA (ChatGPT, Claude) :
   > "Traduis ce fichier JSON en allemand, conserve les clés et traduis uniquement les valeurs"
4. Sauvegardez le résultat dans `lang/de.json`

### Exemple de prompt pour l'IA :
```
Traduis ce fichier JSON de traduction du français vers l'allemand.
Ne modifie PAS les clés (partie gauche), traduis UNIQUEMENT les valeurs (partie droite).
Conserve la structure JSON exacte.

[Coller le contenu de fr.json]
```

## Modifier un texte existant

### Si vous modifiez un texte dans une vue :

1. Modifiez la clé dans le fichier Blade :
   ```blade
   {{ __('Nouveau texte') }}
   ```

2. Ajoutez la traduction dans TOUS les fichiers JSON :
   ```json
   // lang/fr.json
   "Nouveau texte": "Nouveau texte"

   // lang/en.json
   "Nouveau texte": "New text"

   // lang/nl.json
   "Nouveau texte": "Nieuwe tekst"
   ```

### Si vous ajoutez un nouveau Type de bateau :

1. Créez le type normalement dans l'admin en français
2. Mettez à jour la base de données pour ajouter les traductions :
   ```sql
   UPDATE types
   SET libelle_translations = JSON_OBJECT(
       'en', 'Sailboat',
       'nl', 'Zeilboot'
   )
   WHERE libelle = 'Voilier';
   ```

## Commandes utiles

```bash
# Vider le cache
php artisan config:clear
php artisan view:clear
php artisan route:clear

# Voir toutes les routes localisées
php artisan route:list
```

## Prochaines étapes

Pour une gestion encore plus simple, vous pouvez :
1. ✅ Ajouter d'autres langues (Espagnol, Allemand, Créole, Malgache)
2. ⚡ Créer une interface admin pour gérer les traductions
3. 🔄 Utiliser une API de traduction automatique (DeepL, LibreTranslate)

## Support

Si vous avez des questions ou besoin d'aide pour ajouter des langues supplémentaires, n'hésitez pas !
