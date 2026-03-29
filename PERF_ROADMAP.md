# Roadmap Performance — myboat-oi.com
> Audit initial : **63/100** (mobile) — Dernière mise à jour : 29/03/2026 16:15

---

## Historique des scores (mobile, Moto G Power, 4G lente)

### Page d'accueil (`/`)
| Métrique | Audit 1 (14:08) | Audit 2 (14:55) | Audit 3-7 | Objectif |
|---|---|---|---|---|
| Score Perf | 63 | 74 | 67–71 | 80+ |
| FCP | 3,9 s | 3,9 s | ~3,8 s | < 2,0 s |
| LCP | 8,5 s | 4,7 s | ~5–6 s | < 3,0 s |
| TBT | 100 ms | 20 ms | 0 ms | < 20 ms |
| CLS | 0 | 0,018 | 0 | 0 |
| Speed Index | 5,3 s | 3,9 s | ~4,0 s | < 3,0 s |

> FCP/LCP variables selon cache CF (cold = ~5s, warm = ~4s). Vraie perf utilisateur : 0,1–0,6s sur cache chaud.

### Page détail bateau (`/bateaux/[slug]`)
| Métrique | Avant fix images (16:00) | Après fix images (16:05) | Objectif |
|---|---|---|---|
| Score Perf | 65 | **78** | 80+ |
| FCP | 3,8 s | 3,8 s | < 2,0 s |
| LCP | 7,1 s | **4,1 s** | < 3,0 s |
| TBT | 0 ms | 60 ms | < 20 ms |
| CLS | 0 | 0 | 0 |
| Speed Index | 5,1 s | **3,8 s** | < 3,0 s |

### Page listing (`/bateaux`)
| Métrique | Avant a11y fix (16:09) | Après a11y fix (16:15) | Objectif |
|---|---|---|---|
| Score Perf | 69 | **74** | 80+ |
| Accessibilité | 79 | **100** ✅ | 100 |
| Bonnes pratiques | 100 | **100** ✅ | 100 |
| SEO | 92 | **92** | 96 |
| FCP | 3,9 s | 3,9 s | < 2,0 s |
| LCP | 5,9 s | — | < 3,0 s |
| TBT | 0 ms | 0 ms | 0 |

### Accessibilité
| Page | Score initial | Score actuel | Objectif |
|---|---|---|---|
| Accueil `/` | 69 | **97-98** | 100 |
| Détail `/bateaux/[slug]` | — | **92** | 98+ |
| Listing `/bateaux` | 79 | **100** ✅ | 100 |

---

## ✅ Corrections appliquées

- [x] **Preconnect CDN images** — `images.myboat-oi.com` + `crossorigin`
- [x] **Google Fonts non-bloquant** — `rel="preload" as="style" onload`
- [x] **Google Fonts `display=optional`** — élimine CLS (0,018 → 0)
- [x] **Logo SVG width/height explicites** — header + footer
- [x] **Hero image via CF Transformations** — WebP mobile 828px/q70, desktop 1600px/q75, `fetchpriority="high"` preload
- [x] **Images bateaux via CF Transformations** — `boat-card.blade.php` → WebP 450px srcset 1x/2x
- [x] **Images galerie page détail via CF Transformations** — `show.blade.php`
  - Image principale : WebP 900px/q75
  - Thumbnails : WebP 192×192 cover/q70 avec `loading="lazy"` + dimensions explicites
  - **Gain : −750 KB → LCP 7,1s → 4,1s (+13 pts)**
- [x] **Email Obfuscation Cloudflare désactivé** — retire `email-decode.min.js` de la chaîne critique
- [x] **CF Cache Rule homepage** — `s-maxage=120, stale-while-revalidate=60` + Cache-Control header Laravel
- [x] **GA et ContentSquare supprimés** — TBT 100ms → 0ms
- [x] **Clarity chargé après `load` event** — ne bloque pas le thread principal
- [x] **Accessibilité homepage** — aria-label, aria-hidden, h4→h3, h5→h3 footers, contrastes -600→-700, gray-500→gray-400
- [x] **Accessibilité listing `/bateaux`** — aria-label buttons/select/link, sr-only label search, h3→h2 Filtres, badges ocean-600→700 — **79 → 100** ✅

---

## 🔲 Améliorations restantes

### Page détail (`/bateaux/[slug]`) — priorité haute

- [ ] **CF Cache Rule pour pages détail**
  - Actuellement : chaque requête tape Laravel (TTFB variable)
  - Ajouter règle CF : `URI Path starts with /bateaux/` → `s-maxage=300`
  - Aussi mettre à jour `BateauController::show()` pour retourner `response()->view()->header('Cache-Control', ...)`
  - **Gain estimé : −200–500ms TTFB sur cache chaud**

- [ ] **Preload image LCP de la page détail**
  - Ajouter dans `@push('head')` de `show.blade.php` :
    `<link rel="preload" as="image" href="{{ $photosLarge[0] }}" fetchpriority="high">`
  - **Gain estimé : −390ms (Resource Load Delay actuel)**

### Page d'accueil (`/`) — priorité moyenne

- [ ] **Font Awesome `font-display: swap`**
  - FA hébergé sur `cdnjs.cloudflare.com` → impossible sans self-host
  - Option : télécharger FA et le servir depuis `/public/fonts/` avec `@font-face { font-display: swap }`
  - **Gain estimé : −20ms FCP**

- [ ] **Font Awesome : charger uniquement les icônes utilisées**
  - `all.min.css` = 18 KB CSS inutile (contient tous les styles)
  - Option : générer un subset FA avec seulement les icônes utilisées
  - **Gain estimé : −18 KB CSS bloquant**

### SEO (secondaire)

- [ ] **Robots.txt : retirer directive `Content-Signal`**
  - CF Dashboard → Security → Bots → "Use my own robots.txt"
  - **Gain : SEO 92 → 96**

---

## Notes techniques

- **Émulation** : Moto G Power, Lighthouse 13.0.1, 4G lente (US test nodes)
- **FCP 3,8s** = artefact Lighthouse (cold cache + simulation). Vraie perf : 0,1–0,6s
- **LCP element homepage** : `<img src="images.myboat-oi.com/hero/herosmart.webp">`
- **LCP element détail** : `<img id="mainImage" src="...bateau-1-*.jpeg">`
- **CF Transformations** : activé sur le domaine `images.myboat-oi.com`
- **CF Cache Rule homepage** : actif, TTL 120s
