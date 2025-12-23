# Guide : Résoudre les problèmes d'upload de photos

## 🔍 Diagnostic

Si les photos ne s'enregistrent pas lors de l'ajout d'un bateau, suivez ce guide.

---

## 📍 En local (XAMPP, Laragon, etc.)

### 1. Vérifier les limites PHP

Les limites par défaut de PHP sont trop basses (2MB). Nous les avons augmentées à 50MB.

**Fichiers créés** :
- `public/.htaccess` - Limites Apache/PHP
- `public/.user.ini` - Limites PHP-FPM
- `.user.ini` - Limites PHP globales

**Vérifier que les limites sont appliquées** :
```bash
php -r "echo 'upload_max_filesize: ' . ini_get('upload_max_filesize');"
```

Si toujours 2M, **redémarrez Apache/PHP-FPM**.

### 2. Vérifier le lien symbolique

```bash
# Vérifier
ls -la public/storage

# Si n'existe pas, créer
php artisan storage:link
```

### 3. Vérifier les permissions

Sur Windows (XAMPP) : généralement pas de problème.

Sur Linux/Mac :
```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 4. Tester l'upload

1. Allez sur `/admin/bateaux/create`
2. Uploadez une image **< 50MB**
3. Vérifiez que l'image apparaît dans :
   - Base de données : table `medias`
   - Fichier : `storage/app/public/images/{bateau_id}/`
   - Web : `public/storage/images/{bateau_id}/`

---

## ☁️ Sur Railway (Production)

### 🚨 CRITIQUE : Créer un Volume

**Sans volume, les photos disparaissent à chaque redéploiement !**

#### Étapes dans Railway Dashboard

1. Ouvrez votre projet Railway
2. Cliquez sur votre service web
3. Allez dans **Settings** → **Volumes**
4. Cliquez sur **"+ Add Volume"**
5. Configurez :
   ```
   Mount Path: /app/storage/app/public
   Size: 1 GB (minimum recommandé : 5-10 GB)
   ```
6. Sauvegardez et redéployez

### Vérifier que le volume fonctionne

Après déploiement, ouvrez la **Console Railway** et exécutez :

```bash
# Vérifier que le volume est monté
ls -la /app/storage/app/public

# Tester l'écriture
touch /app/storage/app/public/test.txt
ls /app/storage/app/public/test.txt
```

Si le fichier `test.txt` existe, le volume fonctionne ✅

### Variables d'environnement Railway

Assurez-vous que ces variables sont définies :

```env
FILESYSTEM_DISK=public
APP_URL=https://votre-domaine.railway.app
```

### Limites PHP sur Railway

Railway utilise les fichiers `.user.ini` qui définissent :
- `upload_max_filesize = 50M`
- `post_max_size = 60M`

Ces limites sont automatiquement appliquées.

---

## 🧪 Test rapide

### Créer une image de test

```bash
# Générer une petite image de test
php artisan tinker

>>> $faker = \Faker\Factory::create();
>>> $image = $faker->image(storage_path('app/public/test.jpg'), 640, 480);
>>> echo "Image créée : $image";
```

Vérifiez qu'elle est accessible :
- Local : `http://localhost/storage/test.jpg`
- Railway : `https://votre-domaine.railway.app/storage/test.jpg`

---

## ❌ Erreurs courantes

### "The file failed to upload"

**Cause** : Fichier trop gros ou mauvais format

**Solution** :
- Vérifiez que l'image est < 50MB
- Format accepté : JPEG, PNG, GIF, WebP

### "Class 'Intervention\Image\ImageManager' not found"

**Cause** : Package optionnel non installé

**Solution** :
```bash
composer require intervention/image
```
(Optionnel, pas obligatoire)

### Photos visibles en admin mais pas sur le site

**Cause** : Lien symbolique manquant

**Solution** :
```bash
php artisan storage:link
```

### Sur Railway : photos perdues après redéploiement

**Cause** : Pas de volume configuré

**Solution** : Voir section "Créer un Volume" ci-dessus

---

## 📊 Limites actuelles

| Paramètre | Valeur |
|-----------|--------|
| Taille max par image | 50 MB |
| Taille max du formulaire | 60 MB |
| Nombre max de fichiers | 20 |
| Formats acceptés | JPEG, JPG, PNG, GIF, WebP |
| Temps d'exécution max | 300 secondes |

---

## 🔧 Modifier les limites

Pour augmenter les limites, éditez ces fichiers :

**`public/.user.ini`** et **`.user.ini`** :
```ini
upload_max_filesize = 100M  ; Taille max par fichier
post_max_size = 120M        ; Taille max du formulaire
max_execution_time = 600    ; Timeout
```

**Puis redémarrez PHP/Apache**

---

## ✅ Checklist de vérification

Local :
- [ ] Lien symbolique créé (`public/storage` → `storage/app/public`)
- [ ] Limites PHP augmentées (50MB)
- [ ] Dossier `storage/app/public/images` existe et est accessible en écriture

Railway :
- [ ] Volume créé et monté sur `/app/storage/app/public`
- [ ] `APP_URL` configuré correctement
- [ ] `FILESYSTEM_DISK=public` dans les variables d'environnement
- [ ] Lien symbolique créé au déploiement (via `storage:link` dans nixpacks.toml)

---

## 🆘 Support

Si le problème persiste :

1. **Vérifiez les logs** :
   - Local : `storage/logs/laravel.log`
   - Railway : Console → Logs

2. **Activez le debug** :
   ```env
   APP_DEBUG=true
   ```
   Puis essayez à nouveau l'upload et notez l'erreur exacte.

3. **Testez manuellement** :
   ```bash
   php artisan tinker

   >>> Storage::disk('public')->put('test.txt', 'Hello World');
   >>> Storage::disk('public')->exists('test.txt');
   ```
