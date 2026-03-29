# Roadmap Performance — myboat-oi.com
> Audit PageSpeed du 29/03/2026 — Score mobile initial : **63/100**
> Objectif : **80+/100**

---

## Scores initiaux (mobile, Moto G Power, 4G lente)
| Métrique | Avant | Objectif |
|---|---|---|
| Score Perf | 63 | 80+ |
| FCP | 3,9 s | < 2,0 s |
| LCP | 8,5 s | < 3,5 s |
| TBT | 100 ms | < 100 ms |
| CLS | 0 | 0 |
| Speed Index | 5,3 s | < 3,5 s |

---

## P0 — Corrections code (gain estimé : +20 pts)

- [x] **Fix 1 — Preconnect CDN images** (`app.blade.php`)
  - Supprimé `preconnect` vers `files.fredlabs.org` (inutilisé)
  - Ajouté `preconnect` vers `images.myboat-oi.com` (hero image)
  - **Gain estimé : −330 ms LCP**

- [x] **Fix 2 — Google Fonts non-bloquant** (`app.blade.php`)
  - Remplacé `rel="stylesheet"` par `rel="preload" as="style" onload=...`
  - **Gain estimé : −750 ms FCP/LCP**

- [x] **Fix 3 — Logo SVG width/height explicites** (`header.blade.php` + `footer.blade.php`)
  - Ajouté `width="160" height="48"` sur le logo header
  - Ajouté `width="140" height="40"` sur le logo footer
  - **Gain estimé : stabilisation CLS**

---

## P1 — Optimisations images (gain estimé : +15 pts)

- [ ] **Fix 4 — Hero image trop lourde** (`herosmart.webp`)
  - Taille actuelle : **382 KB** → cible : **< 150 KB**
  - Action : Recompresser en WebP qualité 75-80 via Squoosh / imagemin
  - Le "Délai d'affichage de l'élément" est 2 020 ms — killer #1 du LCP
  - Uploader sur le R2 bucket en remplacement

- [ ] **Fix 5 — Images bateaux JPEG sans srcset** (`boat-card.blade.php`)
  - 4 images × ~200 KB chacune affichées en 378px mais servies en 1280-1600px
  - Option A : Générer un thumb 450px WebP à l'upload (côté Laravel/Spatie Media Library)
  - Option B : Utiliser Cloudflare Image Resizing si activé (`/cdn-cgi/image/width=450,format=webp/...`)
  - **Gain estimé : −730 KB** sur la page d'accueil

---

## P2 — Ressources tierces et cache (gain estimé : +5 pts)

- [ ] **Fix 6 — Désactiver Email Obfuscation Cloudflare**
  - `email-decode.min.js` est dans la chaîne critique (408 ms, TTL 47 min)
  - Dashboard CF → Speed → Optimization → Email Obfuscation → **Off**
  - **Gain estimé : sortie du chemin critique**

- [ ] **Fix 7 — Font Awesome : charger uniquement les icônes utilisées**
  - Actuellement : `all.min.css` = 18 KB CSS + 299 KB WOFF2 (fa-solid, fa-brands, fa-regular)
  - Option : Passer sur un kit FA avec subset, ou inliner les SVG des icônes critiques
  - **Gain estimé : −18 KB CSS bloquant**

- [ ] **Fix 8 — ContentSquare : évaluer la nécessité**
  - 137 KB JS sans TTL cache → rechargé à chaque visite
  - 141 ms sur le thread principal + 2 long tasks (90 ms + 59 ms)
  - Si trial non utilisé activement : supprimer le script jusqu'à besoin réel

---

## P3 — Diagnostics secondaires

- [ ] **Fix 9 — Forced layout reflow 46 ms**
  - Source : JavaScript interrogeant `offsetWidth` après modification DOM
  - À investiguer dans DevTools → Performance → "Forced reflow"

- [ ] **Fix 10 — DOM size 566 éléments**
  - Acceptable mais à surveiller (profondeur max : 11, nav avec 10 enfants)
  - Pas d'action immédiate requise

---

## Ordre d'exécution recommandé

```
Session 1 (fait) : Fix 1 + Fix 2 + Fix 3  → push ✅
Session 2        : Fix 4 (recompression hero)
Session 3        : Fix 6 (Cloudflare dashboard)
Session 4        : Fix 5 (srcset bateaux)
Session 5        : Fix 7 (Font Awesome subset)
Session 6        : Fix 8 (arbitrage ContentSquare)
```

---

## Notes techniques

- **URL de test** : https://pagespeed.web.dev/analysis/https-www-myboat-oi-com/5zlpkzvtz2?form_factor=mobile
- **Émulation** : Moto G Power, Lighthouse 13.0.1, 4G lente
- **LCP element** : `<img src="https://images.myboat-oi.com/hero/herosmart.webp">`
- **Chaîne critique** : html → email-decode.min.js → Google Fonts CSS → Inter WOFF2 (693 ms total)
- **3 scripts tiers** : ContentSquare (141 ms) + GA (103 ms) + Clarity (66 ms) = 310 ms thread principal
