# Middlewares & Optimisations - My Boat OI

## Date: 29 Janvier 2026

Ce document décrit les middlewares et optimisations ajoutés pour améliorer le SEO, la sécurité et le monitoring du site.

---

## 1. AdvancedTrafficLogger

**Fichier**: `app/Http/Middleware/AdvancedTrafficLogger.php`

### Objectif
Transformer les logs Laravel en outil de Business Intelligence temps réel pour Railway.

### Fonctionnalités

#### Classification automatique des visiteurs
- **[HUMAN]** : Visiteur réel avec User-Agent valide
- **[BOT-GOOGLE]**, **[BOT-BING]**, etc. : Bots identifiés (50+ signatures)
- **[BOT?]** : User-Agent suspect ou vide

#### Tracking SEO multilingue
- Détection de la langue dans l'URL : `[FR]`, `[EN]`, `[DE]`, `[NL]`, `[ES]`
- Marqueur **[404-SEO]** : quand un bot cherche une mauvaise variante (ex: `/en/bateaux`)
- Marqueur **[BOAT-404]** : 404 sur une route bateau

#### Métriques de performance
- Temps d'exécution exact : `[285ms]`
- Referrer simplifié : `[REF: google.fr]`

#### Filtrage intelligent
- **Ignoré** : fichiers statiques (images, CSS, JS) avec status 200
- **Loggé** : fichiers statiques avec status 404 (marqueur `[STATIC-404]`)

### Format de sortie

```
LOG: [200] [HUMAN] [FR] /bateaux/lagoon-42 [REF: google.fr] [285ms]
LOG: [404] [BOT-GOOGLE] [EN] [404-SEO] /en/bateaux [38ms]
LOG: [404] [HUMAN] [FR] /images/favicon.png [STATIC-404] [12ms]
```

### Bots détectés

| Catégorie | Bots |
|-----------|------|
| Search Engines | Google, Bing, Yandex, Baidu, DuckDuckGo, Yahoo |
| Social Media | Facebook, Twitter, LinkedIn, Pinterest, WhatsApp, Telegram |
| SEO Tools | Ahrefs, SEMrush, Majestic, Moz, Screaming Frog |
| AI Crawlers | GPTBot, ClaudeBot, ByteSpider |
| Monitoring | UptimeRobot, Pingdom, GTmetrix, Lighthouse |

---

## 2. RedirectMultilingualBoatRoutes

**Fichier**: `app/Http/Middleware/RedirectMultilingualBoatRoutes.php`

### Objectif
Rediriger les variantes incorrectes de routes "bateaux" vers la version correcte selon la langue.

### Mappings

| Langue | Route correcte |
|--------|----------------|
| FR | `/fr/bateaux` |
| EN | `/en/boats` |
| DE | `/de/boote` |
| NL | `/nl/boten` |
| ES | `/es/barcos` |

### Exemples de redirections 301

| Requête incorrecte | Redirection |
|-------------------|-------------|
| `/en/bateaux/` | `/en/boats/` |
| `/de/boats/` | `/de/boote/` |
| `/nl/bateaux/lagoon` | `/nl/boten/lagoon` |

---

## 3. CanonicalDomainRedirect

**Fichier**: `app/Http/Middleware/CanonicalDomainRedirect.php`

### Objectif
Rediriger tout le trafic des anciens domaines vers le domaine canonique (APP_URL).

### Configuration

Dans `.env` :
```env
APP_URL=https://myboat-oi.com
CANONICAL_REDIRECT_ENABLED=true
```

### Comportement
- Désactivé par défaut (`CANONICAL_REDIRECT_ENABLED=false`)
- Quand activé : redirection 301 de tout domaine non-canonique vers APP_URL
- Exclut les endpoints de santé (`/up`, `/health`)

### Cas d'usage
Migration Railway → domaine final :
1. Configurer le nouveau domaine DNS
2. Mettre à jour `APP_URL` avec le nouveau domaine
3. Activer `CANONICAL_REDIRECT_ENABLED=true`
4. Tout le trafic Railway sera redirigé en 301

---

## 4. Optimisation des logs 404

**Fichier**: `bootstrap/app.php`

### Modification
```php
->withExceptions(function (Exceptions $exceptions): void {
    $exceptions->dontReport([
        \Symfony\Component\HttpKernel\Exception\NotFoundHttpException::class,
    ]);
})
```

### Effet
- Les exceptions 404 ne saturent plus les logs Laravel
- Le middleware AdvancedTrafficLogger gère le logging intelligent des 404

---

## 5. Correction du favicon

**Fichier**: `resources/views/layouts/app.blade.php`

### Avant (erreur 404)
```html
<link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon-boat.svg') }}">
<link rel="alternate icon" type="image/png" href="{{ asset('images/favicon-boat.png') }}">
```

### Après (corrigé)
```html
<link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon-boat.svg') }}">
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
```

---

## Ordre d'exécution des middlewares

```
1. AdvancedTrafficLogger     (démarre timer, log à la fin)
2. CanonicalDomainRedirect   (redirige si domaine non-canonique)
3. RedirectMultilingualBoatRoutes (corrige routes multilingues)
4. ... autres middlewares Laravel ...
```

---

## Configuration ajoutée

**Fichier**: `config/app.php`

```php
'canonical_redirect_enabled' => env('CANONICAL_REDIRECT_ENABLED', false),
```

---

## Impact performance

| Middleware | Overhead |
|------------|----------|
| AdvancedTrafficLogger | ~0.5ms |
| RedirectMultilingualBoatRoutes | ~0.1ms |
| CanonicalDomainRedirect | ~0.1ms |

**Total**: < 1ms d'overhead sur les ~300ms de temps de réponse.
