# Liste de choses à faire - MyBoat

## Audit post-1 mois d'inactivité (Mars 2026)

---

## RÉSUMÉ EXÉCUTIF

### ✅ FAIT aujourd'hui (7 mars 2026)
1. ~~Google Site Verification~~ - Balise ajoutée, propriété validée
2. ~~Correction hreflang~~ - Plus de redirections /fr/, cohérence HTML/sitemap
3. ~~Schema Organization avec logo~~ - 3 items valides dans Rich Results Test
4. ~~Analyse rapport d'indexation GSC~~ - 763 pages indexées, problème hreflang identifié et corrigé

### 🔴 Priorité HAUTE (à faire maintenant)
1. **Améliorer og:image sur fiches bateaux** - Ajouter @stack('head') dans app.blade.php
2. **Vérifier facturation Railway/Supabase** - Éviter les surprises

### 🟡 Priorité MOYENNE
3. **Améliorer position Ile Maurice** - Gros potentiel non exploité
4. **Ajouter ItemList schema** sur index.blade.php pour les recherches filtrées
5. **Audit sécurité** - `composer audit` + `npm audit`

### 🟢 Quick Wins (facile à faire)
6. Ajouter les icônes Apple touch
7. Supprimer les services Railway inutilisés
8. Demander réindexation des pages importantes dans GSC

### ⚪ Pas urgent
9. Images /images/produit/ 404 - Ancien site, disparaîtront naturellement de l'index

---

## 1. INFRASTRUCTURE & FACTURATION

- [ ] **Vérifier la facture Railway** - Combien as-tu dépensé ce mois ?
- [ ] **Vérifier la facture Supabase** - Espace disque, requêtes, bandwidth
- [ ] **Vérifier que le projet Supabase n'est pas en pause** (free tier = pause après inactivité)
- [ ] **Supprimer les services Railway inutilisés** :
  - `MySQL-Y18J` (SLEEPING)
  - `MySQL-21ux` (STOPPED)
  - `MySQL-Test` (SLEEPING)
  - `mairaicher-mvp` (SLEEPING)

---

## 2. SEO - CORRECTIONS RESTANTES

### og:image sur les fiches bateaux (Priorité haute)

**Problème** : Les fiches bateaux utilisent `@push('head')` mais app.blade.php n'a pas `@stack('head')`

**Fix** : Dans `resources/views/layouts/app.blade.php`, ajouter après og:image :
```php
@stack('head')
```

Cela permettra aux fiches bateaux d'injecter leur propre og:image (photo du bateau).

### ItemList schema pour les recherches filtrées

**Problème** : Quand quelqu'un cherche "catamaran mauritius", Google prend une image aléatoire.

**Fix** : Ajouter dans `bateaux/index.blade.php` un schema ItemList dynamique basé sur les filtres.

### Améliorer position Ile Maurice

- "bateau a vendre ile maurice" → position 10.86
- "achat bateau ile maurice" → position 23.07
- → Créer du contenu spécifique Maurice (page dédiée ou article)

---

## 3. SEO - FAIT ✅

### Google Search Console
- [x] **Balise de vérification** - `khnsY4EOXA9a9-F07reTdBySXwmf-m8xFoCYo8sDscY`
- [x] **Propriété validée** - Accès complet à GSC

### Hreflang corrigés
- [x] **Avant** : `hreflang="fr" href="/fr/bateaux"` → Redirection 301 → "Page avec redirection"
- [x] **Après** : `hreflang="fr" href="/bateaux"` → URL finale directe

### Schema Organization
- [x] **Logo ajouté** : `https://www.myboat-oi.com/images/logo-myboat.svg`
- [x] **Rich Results Test** : 3 items valides (Organization x2, Local business x1)

---

## 4. STATISTIQUES GSC (Référence)

### Indexation (7 mars 2026)
- **763 pages indexées**
- Répartition : NL 154, EN 154, IT 153, DE 152, ES 149, FR 1

### Trafic (3 derniers mois)
- **3 120 clics** | **51 905 impressions** | **CTR 6%** | **Position 14**

### Top pays
| Pays | Clics | CTR |
|------|-------|-----|
| France | 1 314 | 5.3% |
| Réunion | 497 | 18.8% |
| Madagascar | 363 | 9.6% |
| Maurice | 221 | 6.3% |
| Mayotte | 123 | 25.6% |

### Mobile vs Desktop
- **Mobile : 66%** (2 050 clics)
- Desktop : 31% (970 clics)

---

## 5. SÉCURITÉ

- [ ] **Audit des dépendances PHP** : `composer audit`
- [ ] **Audit des dépendances NPM** : `npm audit`
- [ ] **Vérifier le certificat SSL** (HTTPS)

---

## 6. MONITORING À METTRE EN PLACE

- [ ] **Uptime monitoring** - UptimeRobot ou similaire (gratuit)
- [ ] **Alertes Supabase** - Espace disque, quotas

---

## 7. PROCHAINES ACTIONS RECOMMANDÉES

1. **Demander réindexation dans GSC** des pages prioritaires :
   - `https://www.myboat-oi.com/`
   - `https://www.myboat-oi.com/bateaux`
   - 2-3 fiches bateaux populaires

2. **Ajouter @stack('head')** pour les og:image des fiches

3. **Créer une page Ile Maurice** ou article dédié pour améliorer le positionnement

4. **Vérifier la facturation** Railway et Supabase

---

## Notes

- **Commit stable de référence** : `3cab35761d38bc23947f3eb6838f0d5fb26a59e3`
- **Ne pas utiliser Octane** avec laravel-localization (voir CLAUDE.md)
- **Toujours tester en local** avant de push

---

*Dernière mise à jour : 7 mars 2026 - 18h00*
