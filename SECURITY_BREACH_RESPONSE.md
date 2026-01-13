# 🚨 Security Breach Response - Action Required

**Date de détection**: 2026-01-13
**Statut**: CRITIQUE - Action immédiate requise

## ⚠️ Credentials exposés détectés par GitGuardian

Les secrets suivants ont été exposés publiquement dans l'historique Git :

### 1. MySQL Database Credentials (CRITIQUE)
- **Fichier**: `.mcp.json`
- **Exposé**:
  - Host: `switchback.proxy.rlwy.net:25756`
  - Username: `root`
  - Password: `BxusCmDafvlHNcUAEMUQZpDdQHWTPKAv`
  - Database: `railway`

### 2. Brave API Key (HIGH)
- **Fichier**: `.mcp.json`
- **Clé**: `BSAbUqMPMRMGRPCSc5-UdVmBVGcHsPP`

### 3. Backoffice Login Credentials (HIGH)
- **Fichier**: `scripts/scrape_backoffice.py`
- **Username**: `ghislain`
- **Password**: `myboat`
- **URL**: `https://www.myboat-oi.com/backoffice/`

### 4. Cloudflare R2 Storage Credentials (CRITIQUE)
- **Fichier**: `railway/README.md`
- **Exposé**:
  - Access Key ID: `3b40201c3df3c5640859889e1874c872`
  - Secret Access Key: `13132322a9edbef95ce049d6c7eefca5ac9af73c4d34d72d2f8a2e071cfaf382`
  - Bucket: `myboat`
  - Endpoint: `https://898047b4c422ffe9966cc1cb7493ceed.r2.cloudflarestorage.com`
  - Public URL: `https://files.fredlabs.org`

---

## ✅ Actions déjà effectuées

- [x] Suppression des fichiers sensibles du dépôt Git (commit 89afb44)
- [x] Création de fichiers d'exemple (`.mcp.json.example`, `scrape_backoffice.example.py`)
- [x] Mise à jour du `.gitignore` pour éviter de futurs commits

---

## 🔥 Actions URGENTES à faire IMMÉDIATEMENT

### 1. Railway Database (CRITIQUE)
⚠️ **Cette base de données est PUBLIQUEMENT ACCESSIBLE avec les credentials exposés**

```bash
# Connexion à Railway
railway login

# Changer le mot de passe root MySQL IMMÉDIATEMENT
railway run mysql -u root -p
# Puis exécutez:
ALTER USER 'root'@'%' IDENTIFIED BY 'NOUVEAU_MOT_DE_PASSE_FORT_ICI';
FLUSH PRIVILEGES;
```

**OU régénérer complètement la base de données:**
```bash
railway project delete  # Supprimer le projet
railway init  # Créer un nouveau projet avec nouveaux credentials
```

### 2. Brave API Key (HIGH)
Révoquer et régénérer la clé API :

1. Aller sur https://brave.com/search/api/
2. Se connecter à votre compte
3. Révoquer la clé `BSAbUqMPMRMGRPCSc5-UdVmBVGcHsPP`
4. Générer une nouvelle clé API
5. Mettre à jour votre fichier local `.mcp.json` (PAS DANS GIT!)

### 3. Backoffice MyBoat (HIGH)
Changer le mot de passe du compte `ghislain` :

1. Se connecter sur https://www.myboat-oi.com/backoffice/
2. Aller dans les paramètres du compte
3. Changer le mot de passe immédiatement
4. Mettre à jour votre script local `scripts/scrape_backoffice.py` (PAS DANS GIT!)

### 4. Cloudflare R2 Storage (CRITIQUE)
Révoquer et régénérer les credentials R2 :

1. Se connecter au Cloudflare Dashboard
2. Aller dans **R2** → **Manage R2 API Tokens**
3. Révoquer le token avec Access Key `3b40201c3df3c5640859889e1874c872`
4. Générer de nouveaux credentials R2
5. Mettre à jour les variables d'environnement dans Railway (services App, Cron, Worker)

---

## 🧹 Nettoyage de l'historique Git (OPTIONNEL mais RECOMMANDÉ)

**⚠️ ATTENTION**: Cette opération réécrit l'historique Git et nécessite un force push.

### Option 1: BFG Repo-Cleaner (Recommandé)

```bash
# Télécharger BFG depuis https://rtyley.github.io/bfg-repo-cleaner/
# Puis exécuter:

# Backup du repo
cp -r my_boat my_boat_backup

# Nettoyer les secrets
java -jar bfg.jar --delete-files .mcp.json my_boat
java -jar bfg.jar --delete-files scrape_backoffice.py my_boat

cd my_boat
git reflog expire --expire=now --all
git gc --prune=now --aggressive
```

### Option 2: Git Filter-Branch

```bash
# Backup du repo
cp -r my_boat my_boat_backup

cd my_boat

# Supprimer .mcp.json de tout l'historique
git filter-branch --force --index-filter \
  "git rm --cached --ignore-unmatch .mcp.json" \
  --prune-empty --tag-name-filter cat -- --all

# Supprimer scrape_backoffice.py de tout l'historique
git filter-branch --force --index-filter \
  "git rm --cached --ignore-unmatch scripts/scrape_backoffice.py" \
  --prune-empty --tag-name-filter cat -- --all

# Nettoyer
git reflog expire --expire=now --all
git gc --prune=now --aggressive
```

### Force Push (après nettoyage)

```bash
# ⚠️ ATTENTION: Cela va réécrire l'historique public!
git push origin --force --all
git push origin --force --tags
```

---

## 📋 Checklist de vérification

- [ ] Mot de passe Railway Database changé
- [ ] Brave API Key révoquée et régénérée
- [ ] Mot de passe backoffice MyBoat changé
- [ ] Cloudflare R2 credentials révoqués et régénérés
- [ ] Fichier local `.mcp.json` mis à jour avec nouveaux credentials
- [ ] Fichier local `scripts/scrape_backoffice.py` mis à jour
- [ ] Variables d'environnement Railway mises à jour avec nouveaux credentials R2
- [ ] (Optionnel) Historique Git nettoyé
- [ ] (Si nettoyage) Force push effectué
- [ ] GitGuardian incidents marqués comme résolus

---

## 🔐 Bonnes pratiques pour l'avenir

1. **Ne jamais commiter de secrets**
   - Utiliser `.env` pour les variables d'environnement
   - Toujours vérifier avec `git diff` avant de commit
   - Utiliser des outils comme `git-secrets` ou `pre-commit hooks`

2. **Utiliser des fichiers d'exemple**
   - Créer des `.example` files pour les templates
   - Documenter dans le README comment configurer

3. **Rotation régulière des secrets**
   - Changer les mots de passe tous les 90 jours
   - Utiliser un gestionnaire de mots de passe

4. **Monitoring**
   - Activer GitGuardian sur votre repo
   - Configurer des alertes de sécurité GitHub

---

## 📞 Support

Si vous avez besoin d'aide :
- Railway: https://railway.app/help
- Brave API: https://brave.com/search/api/contact/
- GitHub Security: https://docs.github.com/en/code-security

---

**⏰ TIMELINE**: Les credentials ont été exposés publiquement. Agissez dans les 24h pour minimiser les risques.
