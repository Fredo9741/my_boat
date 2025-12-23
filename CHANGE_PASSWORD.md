# Changer le mot de passe administrateur

Il existe 3 méthodes pour changer le mot de passe de l'administrateur :

## 🌐 Méthode 1 : Interface Web (Recommandé)

Une fois connecté à l'administration :

1. Allez sur **Paramètres** depuis le menu admin
2. Descendez jusqu'à la section **"Sécurité - Changer le mot de passe"**
3. Remplissez le formulaire :
   - Mot de passe actuel
   - Nouveau mot de passe (min. 8 caractères)
   - Confirmation du nouveau mot de passe
4. Cliquez sur **"Changer le mot de passe"**

**URL directe** : `https://votre-domaine.railway.app/admin/settings`

---

## 💻 Méthode 2 : Ligne de commande interactive

Sur votre serveur Railway ou en local :

```bash
php artisan admin:change-password
```

La commande vous demandera :
1. L'email de l'administrateur (défaut : `admin@myboat.re`)
2. Le nouveau mot de passe
3. La confirmation du mot de passe

### Exemple :
```bash
$ php artisan admin:change-password

 Email de l'administrateur [admin@myboat.re]:
 > admin@myboat.re

 Nouveau mot de passe (min. 8 caractères):
 > ********

 Confirmer le mot de passe:
 > ********

✅ Mot de passe changé avec succès pour : admin@myboat.re
```

---

## ⚡ Méthode 3 : Ligne de commande avec paramètres

Pour un changement rapide (utile pour les scripts) :

```bash
php artisan admin:change-password admin@myboat.re --password="VotreNouveauMotDePasse"
```

**Attention** : Cette méthode affiche le mot de passe dans l'historique de commandes. À utiliser avec précaution.

---

## 🚀 Sur Railway (via la console)

1. Allez dans votre projet Railway
2. Cliquez sur votre service web
3. Ouvrez l'onglet **"Console"** ou **"Logs"**
4. Exécutez la commande :

```bash
php artisan admin:change-password admin@myboat.re --password="NouveauMotDePasse123!"
```

---

## 📝 Identifiants par défaut

Les identifiants créés par les seeders :

- **Email** : `admin@myboat.re`
- **Mot de passe** : `password123`

**⚠️ IMPORTANT** : Changez immédiatement ces identifiants en production !

---

## 🔒 Recommandations de sécurité

- Utilisez un mot de passe fort (min. 12 caractères)
- Mélangez majuscules, minuscules, chiffres et caractères spéciaux
- Ne partagez jamais votre mot de passe
- Changez votre mot de passe régulièrement

### Exemples de mots de passe forts :
```
MyBoat2024!Secure#
Admin_Re974$2024
Bateau@Reunion#2024
```

---

## ❓ Problèmes courants

### "Aucun utilisateur trouvé"
Vérifiez que l'email est correct. Pour lister tous les admins :
```bash
php artisan tinker
>>> User::all()->pluck('email');
```

### "Le mot de passe actuel est incorrect" (interface web)
Assurez-vous d'entrer correctement votre mot de passe actuel.

### Mot de passe oublié
Utilisez la méthode en ligne de commande (méthode 2 ou 3) qui ne demande pas l'ancien mot de passe.
