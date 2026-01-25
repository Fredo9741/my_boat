<?php

/**
 * Redirections 301 - Migration myboat-oi.com
 * Symfony (ancien) -> Laravel (nouveau)
 *
 * Optimisé avec données Search Console & Google Analytics 4
 * Généré le 2026-01-24
 *
 * Pour utiliser ce fichier, incluez-le dans routes/web.php :
 * require __DIR__ . '/redirects.php';
 */

use Illuminate\Support\Facades\Route;

// ==========================================
// TOP PERFORMANCE - MONEY PAGES (Zones à haute conversion)
// Sources: Search Console + GA4
// Priorisation: Madagascar, Réunion, Mayotte, Maurice
// ==========================================

// MADAGASCAR (Top 1 - Conversion élevée)
Route::permanentRedirect('/acheter-bateau-madagascar', '/bateaux?zone=madagascar');
Route::permanentRedirect('/acheter-bateau-madagascar.html', '/bateaux?zone=madagascar');
Route::permanentRedirect('/acheter/acheter-bateau-madagascar.html', '/bateaux?zone=madagascar');
Route::permanentRedirect('/acheter/acheter-bateau-madagascar', '/bateaux?zone=madagascar');

// LA RÉUNION (Top 2 - Volume élevé)
Route::permanentRedirect('/acheter-bateau-reunion', '/bateaux?zone=la-reunion');
Route::permanentRedirect('/acheter-bateau-reunion.html', '/bateaux?zone=la-reunion');
Route::permanentRedirect('/acheter/acheter-bateau-reunion.html', '/bateaux?zone=la-reunion');
Route::permanentRedirect('/acheter/acheter-bateau-reunion', '/bateaux?zone=la-reunion');
Route::permanentRedirect('/acheter-bateau-la-reunion', '/bateaux?zone=la-reunion');
Route::permanentRedirect('/acheter-bateau-la-reunion.html', '/bateaux?zone=la-reunion');

// MAYOTTE (Top 3 - Niche rentable)
Route::permanentRedirect('/acheter-bateau-mayotte', '/bateaux?zone=mayotte');
Route::permanentRedirect('/acheter-bateau-mayotte.html', '/bateaux?zone=mayotte');
Route::permanentRedirect('/acheter/acheter-bateau-mayotte.html', '/bateaux?zone=mayotte');
Route::permanentRedirect('/acheter/acheter-bateau-mayotte', '/bateaux?zone=mayotte');

// MAURICE (Top 4 - Marché premium)
Route::permanentRedirect('/acheter-bateau-maurice', '/bateaux?zone=maurice');
Route::permanentRedirect('/acheter-bateau-maurice.html', '/bateaux?zone=maurice');
Route::permanentRedirect('/acheter/acheter-bateau-maurice.html', '/bateaux?zone=maurice');
Route::permanentRedirect('/acheter/acheter-bateau-maurice', '/bateaux?zone=maurice');
Route::permanentRedirect('/acheter-bateau-ile-maurice', '/bateaux?zone=maurice');
Route::permanentRedirect('/acheter-bateau-ile-maurice.html', '/bateaux?zone=maurice');

// ==========================================
// AUTRES ZONES GÉOGRAPHIQUES
// ==========================================

// Seychelles
Route::permanentRedirect('/acheter-bateau-seychelles', '/bateaux?zone=seychelles');
Route::permanentRedirect('/acheter-bateau-seychelles.html', '/bateaux?zone=seychelles');
Route::permanentRedirect('/acheter/acheter-bateau-seychelles.html', '/bateaux?zone=seychelles');
Route::permanentRedirect('/acheter/acheter-bateau-seychelles', '/bateaux?zone=seychelles');

// Hors océan indien (anciennement "Pacifique")
Route::permanentRedirect('/acheter-bateau-pacifique', '/bateaux?zone=hors-ocean-indien');
Route::permanentRedirect('/acheter-bateau-pacifique.html', '/bateaux?zone=hors-ocean-indien');
Route::permanentRedirect('/acheter/acheter-bateau-pacifique.html', '/bateaux?zone=hors-ocean-indien');
Route::permanentRedirect('/acheter/acheter-bateau-pacifique', '/bateaux?zone=hors-ocean-indien');

// Métropole
Route::permanentRedirect('/acheter-bateau-metropole', '/bateaux?zone=metropole');
Route::permanentRedirect('/acheter-bateau-metropole.html', '/bateaux?zone=metropole');
Route::permanentRedirect('/acheter/acheter-bateau-metropole.html', '/bateaux?zone=metropole');
Route::permanentRedirect('/acheter/acheter-bateau-metropole', '/bateaux?zone=metropole');
Route::permanentRedirect('/acheter-bateau-france', '/bateaux?zone=metropole');
Route::permanentRedirect('/acheter-bateau-france.html', '/bateaux?zone=metropole');

// Zanzibar
Route::permanentRedirect('/acheter-bateau-Zanzibar', '/bateaux?zone=zanzibar');
Route::permanentRedirect('/acheter-bateau-zanzibar', '/bateaux?zone=zanzibar');
Route::permanentRedirect('/acheter-bateau-Zanzibar.html', '/bateaux?zone=zanzibar');
Route::permanentRedirect('/acheter-bateau-zanzibar.html', '/bateaux?zone=zanzibar');
Route::permanentRedirect('/acheter/acheter-bateau-zanzibar.html', '/bateaux?zone=zanzibar');

// ==========================================
// REDIRECTIONS DES TYPES DE BATEAUX
// Format ancien: /acheter/{type}.html
// ==========================================

Route::permanentRedirect('/acheter/monocoque.html', '/bateaux?type=voilier-monocoque');
Route::permanentRedirect('/acheter/monocoque', '/bateaux?type=voilier-monocoque');
Route::permanentRedirect('/acheter/multicoques.html', '/bateaux?type=catamaran-a-voile');
Route::permanentRedirect('/acheter/multicoques', '/bateaux?type=catamaran-a-voile');
Route::permanentRedirect('/acheter/multihull.html', '/bateaux?type=catamaran-a-voile');
Route::permanentRedirect('/acheter/catamaran.html', '/bateaux?type=catamaran-a-voile');
Route::permanentRedirect('/acheter/catamaran', '/bateaux?type=catamaran-a-voile');
Route::permanentRedirect('/acheter/bateau-moteur.html', '/bateaux?type=bateau-moteur');
Route::permanentRedirect('/acheter/bateau-moteur', '/bateaux?type=bateau-moteur');
Route::permanentRedirect('/acheter/bateau-neuf.html', '/bateaux?occasion=0');
Route::permanentRedirect('/acheter/bateau-neuf', '/bateaux?occasion=0');
Route::permanentRedirect('/acheter.html', '/bateaux');
Route::permanentRedirect('/acheter', '/bateaux');

// ==========================================
// GESTION DES ESPACES DANS LES URLs (ANOMALIES)
// Format: /bateau moteur/ (avec espace) et variantes encodées
// ==========================================

// Espace non encodé (capturé par Route::any)
Route::any('/bateau moteur', function () {
    return redirect('/bateaux?type=bateau-moteur', 301);
});
Route::any('/bateau moteur/', function () {
    return redirect('/bateaux?type=bateau-moteur', 301);
});

// Espace encodé en %20
Route::permanentRedirect('/bateau%20moteur', '/bateaux?type=bateau-moteur');
Route::permanentRedirect('/bateau%20moteur/', '/bateaux?type=bateau-moteur');
Route::permanentRedirect('/acheter/bateau%20moteur', '/bateaux?type=bateau-moteur');
Route::permanentRedirect('/acheter/bateau%20moteur/', '/bateaux?type=bateau-moteur');
Route::permanentRedirect('/acheter/bateau%20moteur.html', '/bateaux?type=bateau-moteur');

// Espace encodé en + (parfois dans les formulaires)
Route::permanentRedirect('/bateau+moteur', '/bateaux?type=bateau-moteur');
Route::permanentRedirect('/acheter/bateau+moteur', '/bateaux?type=bateau-moteur');

// ==========================================
// URLs PROFONDES HIGH TRAFFIC
// Format: /acheter/{categorie}/{slug}.html
// Mapping dynamique vers /bateaux/{slug}-{id}
// ==========================================

// --- MONOCOQUES (voiliers) ---
Route::permanentRedirect('/acheter/monocoque/galapagos-431604.html', '/bateaux/galapagos-431604-176');
Route::permanentRedirect('/acheter/monocoque/galapagos-431604', '/bateaux/galapagos-431604-176');
Route::permanentRedirect('/acheter/monocoque/nouanni-44-deriveur-alu1801.html', '/bateaux/nouanni-44-deriveur-alu1801-46');
Route::permanentRedirect('/acheter/monocoque/nouanni-44-deriveur-alu1801', '/bateaux/nouanni-44-deriveur-alu1801-46');
Route::permanentRedirect('/acheter/monocoque/petit-prince0901.html', '/bateaux/petit-prince0901-125');
Route::permanentRedirect('/acheter/monocoque/petit-prince0901', '/bateaux/petit-prince0901-125');
Route::permanentRedirect('/acheter/monocoque/hunraken-ct-431710.html', '/bateaux/hunraken-ct-431710-4');
Route::permanentRedirect('/acheter/monocoque/hunraken-ct-431710', '/bateaux/hunraken-ct-431710-4');
Route::permanentRedirect('/acheter/monocoque/suspens1910.html', '/bateaux/suspens1910-5');
Route::permanentRedirect('/acheter/monocoque/suspens1910', '/bateaux/suspens1910-5');
Route::permanentRedirect('/acheter/monocoque/evasion-341910.html', '/bateaux/evasion-341910-6');
Route::permanentRedirect('/acheter/monocoque/evasion-341910', '/bateaux/evasion-341910-6');
Route::permanentRedirect('/acheter/monocoque/jeanneau-4512101.html', '/bateaux/jeanneau-4512101-17');
Route::permanentRedirect('/acheter/monocoque/jeanneau-4512101', '/bateaux/jeanneau-4512101-17');
Route::permanentRedirect('/acheter/monocoque/via-42-deriveur-alu2001.html', '/bateaux/via-42-deriveur-alu2001-15');
Route::permanentRedirect('/acheter/monocoque/via-42-deriveur-alu2001', '/bateaux/via-42-deriveur-alu2001-15');
Route::permanentRedirect('/acheter/monocoque/sun-odyssee2111.html', '/bateaux/sun-odyssee2111-34');
Route::permanentRedirect('/acheter/monocoque/sun-odyssee2111', '/bateaux/sun-odyssee2111-34');
Route::permanentRedirect('/acheter/monocoque/sun-odyssey-331301.html', '/bateaux/sun-odyssey-331301-40');
Route::permanentRedirect('/acheter/monocoque/sun-odyssey-331301', '/bateaux/sun-odyssey-331301-40');
Route::permanentRedirect('/acheter/monocoque/sun-odyssey-4190405.html', '/bateaux/sun-odyssey-4190405-65');
Route::permanentRedirect('/acheter/monocoque/sun-odyssey-4190405', '/bateaux/sun-odyssey-4190405-65');
Route::permanentRedirect('/acheter/monocoque/sun-odyssey-349-limited-edition2602.html', '/bateaux/sun-odyssey-349-limited-edition2602-130');
Route::permanentRedirect('/acheter/monocoque/sun-odyssey-349-limited-edition2602', '/bateaux/sun-odyssey-349-limited-edition2602-130');
Route::permanentRedirect('/acheter/monocoque/sun-odyssey-39-i1911.html', '/bateaux/sun-odyssey-39-i1911-188');
Route::permanentRedirect('/acheter/monocoque/sun-odyssey-39-i1911', '/bateaux/sun-odyssey-39-i1911-188');
Route::permanentRedirect('/acheter/monocoque/gib-sea-432405.html', '/bateaux/gib-sea-432405-68');
Route::permanentRedirect('/acheter/monocoque/gib-sea-432405', '/bateaux/gib-sea-432405-68');
Route::permanentRedirect('/acheter/monocoque/gib-sea-432307.html', '/bateaux/gib-sea-432307-142');
Route::permanentRedirect('/acheter/monocoque/gib-sea-432307', '/bateaux/gib-sea-432307-142');
Route::permanentRedirect('/acheter/monocoque/first-41s3004.html', '/bateaux/first-41s3004-62');
Route::permanentRedirect('/acheter/monocoque/first-41s3004', '/bateaux/first-41s3004-62');
Route::permanentRedirect('/acheter/monocoque/first-2112006.html', '/bateaux/first-2112006-108');
Route::permanentRedirect('/acheter/monocoque/first-2112006', '/bateaux/first-2112006-108');
Route::permanentRedirect('/acheter/monocoque/bavaria-500806.html', '/bateaux/bavaria-500806-135');
Route::permanentRedirect('/acheter/monocoque/bavaria-500806', '/bateaux/bavaria-500806-135');
Route::permanentRedirect('/acheter/monocoque/dufour-413001.html', '/bateaux/dufour-413001-168');
Route::permanentRedirect('/acheter/monocoque/dufour-413001', '/bateaux/dufour-413001-168');
Route::permanentRedirect('/acheter/monocoque/harmony-471202.html', '/bateaux/harmony-471202-173');
Route::permanentRedirect('/acheter/monocoque/harmony-471202', '/bateaux/harmony-471202-173');
Route::permanentRedirect('/acheter/monocoque/swan-380511.html', '/bateaux/swan-380511-81');
Route::permanentRedirect('/acheter/monocoque/swan-380511', '/bateaux/swan-380511-81');
Route::permanentRedirect('/acheter/monocoque/hunter-332504.html', '/bateaux/hunter-332504-94');
Route::permanentRedirect('/acheter/monocoque/hunter-332504', '/bateaux/hunter-332504-94');
Route::permanentRedirect('/acheter/monocoque/hunter-2351906.html', '/bateaux/hunter-2351906-106');
Route::permanentRedirect('/acheter/monocoque/hunter-2351906', '/bateaux/hunter-2351906-106');
Route::permanentRedirect('/acheter/monocoque/north-wind-470607.html', '/bateaux/north-wind-470607-136');
Route::permanentRedirect('/acheter/monocoque/north-wind-470607', '/bateaux/north-wind-470607-136');
Route::permanentRedirect('/acheter/monocoque/vandame-501401.html', '/bateaux/vandame-501401-44');
Route::permanentRedirect('/acheter/monocoque/vandame-501401', '/bateaux/vandame-501401-44');
Route::permanentRedirect('/acheter/monocoque/etap-32-s2203.html', '/bateaux/etap-32-s2203-58');
Route::permanentRedirect('/acheter/monocoque/etap-32-s2203', '/bateaux/etap-32-s2203-58');
Route::permanentRedirect('/acheter/monocoque/efo-oyster-343005.html', '/bateaux/efo-oyster-343005-132');
Route::permanentRedirect('/acheter/monocoque/efo-oyster-343005', '/bateaux/efo-oyster-343005-132');
Route::permanentRedirect('/acheter/monocoque/grand-large-570801.html', '/bateaux/grand-large-570801-39');
Route::permanentRedirect('/acheter/monocoque/grand-large-570801', '/bateaux/grand-large-570801-39');
Route::permanentRedirect('/acheter/monocoque/bruce-farr-540412.html', '/bateaux/bruce-farr-540412-123');
Route::permanentRedirect('/acheter/monocoque/bruce-farr-540412', '/bateaux/bruce-farr-540412-123');
Route::permanentRedirect('/acheter/monocoque/aventurin-542807.html', '/bateaux/aventurin-542807-74');
Route::permanentRedirect('/acheter/monocoque/aventurin-542807', '/bateaux/aventurin-542807-74');
Route::permanentRedirect('/acheter/monocoque/trinidad-482807.html', '/bateaux/trinidad-482807-110');
Route::permanentRedirect('/acheter/monocoque/trinidad-482807', '/bateaux/trinidad-482807-110');
Route::permanentRedirect('/acheter/monocoque/offshore-cruiser-461906.html', '/bateaux/offshore-cruiser-461906-107');
Route::permanentRedirect('/acheter/monocoque/offshore-cruiser-461906', '/bateaux/offshore-cruiser-461906-107');
Route::permanentRedirect('/acheter/monocoque/venezia-421911.html', '/bateaux/venezia-421911-162');
Route::permanentRedirect('/acheter/monocoque/venezia-421911', '/bateaux/venezia-421911-162');
Route::permanentRedirect('/acheter/monocoque/iris-372502.html', '/bateaux/iris-372502-174');
Route::permanentRedirect('/acheter/monocoque/iris-372502', '/bateaux/iris-372502-174');
Route::permanentRedirect('/acheter/monocoque/deriveur-45-alu1511.html', '/bateaux/deriveur-45-alu1511-82');
Route::permanentRedirect('/acheter/monocoque/deriveur-45-alu1511', '/bateaux/deriveur-45-alu1511-82');
Route::permanentRedirect('/acheter/monocoque/goelette1808.html', '/bateaux/goelette1808-28');
Route::permanentRedirect('/acheter/monocoque/goelette1808', '/bateaux/goelette1808-28');
Route::permanentRedirect('/acheter/monocoque/goelette-14m0907.html', '/bateaux/goelette-14m0907-97');
Route::permanentRedirect('/acheter/monocoque/goelette-14m0907', '/bateaux/goelette-14m0907-97');
Route::permanentRedirect('/acheter/monocoque/goelette-german-fres1809.html', '/bateaux/goelette-german-fres1809-113');
Route::permanentRedirect('/acheter/monocoque/goelette-german-fres1809', '/bateaux/goelette-german-fres1809-113');
Route::permanentRedirect('/acheter/monocoque/schooner-500502.html', '/bateaux/schooner-500502-126');
Route::permanentRedirect('/acheter/monocoque/schooner-500502', '/bateaux/schooner-500502-126');
Route::permanentRedirect('/acheter/monocoque/cotre-acier2007.html', '/bateaux/cotre-acier2007-100');
Route::permanentRedirect('/acheter/monocoque/cotre-acier2007', '/bateaux/cotre-acier2007-100');
Route::permanentRedirect('/acheter/monocoque/marquise-561711.html', '/bateaux/marquise-561711-122');
Route::permanentRedirect('/acheter/monocoque/marquise-561711', '/bateaux/marquise-561711-122');

// --- MULTICOQUES (catamarans, trimarans) ---
Route::permanentRedirect('/acheter/multicoques/leopard-382202.html', '/bateaux/leopard-382202-129');
Route::permanentRedirect('/acheter/multicoques/leopard-382202', '/bateaux/leopard-382202-129');
Route::permanentRedirect('/acheter/multicoques/leopard-462101.html', '/bateaux/leopard-462101-18');
Route::permanentRedirect('/acheter/multicoques/leopard-462101', '/bateaux/leopard-462101-18');
Route::permanentRedirect('/acheter/multicoques/leopard-47-de-2004-a-rentrer2101.html', '/bateaux/leopard-47-de-2004-a-rentrer2101-19');
Route::permanentRedirect('/acheter/multicoques/leopard-47-de-2004-a-rentrer2101', '/bateaux/leopard-47-de-2004-a-rentrer2101-19');
Route::permanentRedirect('/acheter/multicoques/leopard-472908.html', '/bateaux/leopard-472908-149');
Route::permanentRedirect('/acheter/multicoques/leopard-472908', '/bateaux/leopard-472908-149');
Route::permanentRedirect('/acheter/multicoques/leopard-532309.html', '/bateaux/leopard-532309-150');
Route::permanentRedirect('/acheter/multicoques/leopard-532309', '/bateaux/leopard-532309-150');
Route::permanentRedirect('/acheter/multicoques/leopard-53-20202409.html', '/bateaux/leopard-53-20202409-151');
Route::permanentRedirect('/acheter/multicoques/leopard-53-20202409', '/bateaux/leopard-53-20202409-151');
Route::permanentRedirect('/acheter/multicoques/edel-cat-35-sport1705.html', '/bateaux/edel-cat-35-sport1705-24');
Route::permanentRedirect('/acheter/multicoques/edel-cat-35-sport1705', '/bateaux/edel-cat-35-sport1705-24');
Route::permanentRedirect('/acheter/multicoques/edel-cat-35-open1710.html', '/bateaux/edel-cat-35-open1710-159');
Route::permanentRedirect('/acheter/multicoques/edel-cat-35-open1710', '/bateaux/edel-cat-35-open1710-159');
Route::permanentRedirect('/acheter/multicoques/edel-350311.html', '/bateaux/edel-350311-115');
Route::permanentRedirect('/acheter/multicoques/edel-350311', '/bateaux/edel-350311-115');
Route::permanentRedirect('/acheter/multicoques/lagoon-472505.html', '/bateaux/lagoon-472505-25');
Route::permanentRedirect('/acheter/multicoques/lagoon-472505', '/bateaux/lagoon-472505-25');
Route::permanentRedirect('/acheter/multicoques/lagoon-4501102.html', '/bateaux/lagoon-4501102-50');
Route::permanentRedirect('/acheter/multicoques/lagoon-4501102', '/bateaux/lagoon-4501102-50');
Route::permanentRedirect('/acheter/multicoques/lagoon-4701602.html', '/bateaux/lagoon-4701602-54');
Route::permanentRedirect('/acheter/multicoques/lagoon-4701602', '/bateaux/lagoon-4701602-54');
Route::permanentRedirect('/acheter/multicoques/lagoon-390405.html', '/bateaux/lagoon-390405-64');
Route::permanentRedirect('/acheter/multicoques/lagoon-390405', '/bateaux/lagoon-390405-64');
Route::permanentRedirect('/acheter/multicoques/lagoon-391810.html', '/bateaux/lagoon-391810-80');
Route::permanentRedirect('/acheter/multicoques/lagoon-391810', '/bateaux/lagoon-391810-80');
Route::permanentRedirect('/acheter/multicoques/lagoon-410-s21702.html', '/bateaux/lagoon-410-s21702-89');
Route::permanentRedirect('/acheter/multicoques/lagoon-410-s21702', '/bateaux/lagoon-410-s21702-89');
Route::permanentRedirect('/acheter/multicoques/lagoon-400s21305.html', '/bateaux/lagoon-400s21305-95');
Route::permanentRedirect('/acheter/multicoques/lagoon-400s21305', '/bateaux/lagoon-400s21305-95');
Route::permanentRedirect('/acheter/multicoques/lagoon-380s21504.html', '/bateaux/lagoon-380s21504-131');
Route::permanentRedirect('/acheter/multicoques/lagoon-380s21504', '/bateaux/lagoon-380s21504-131');
Route::permanentRedirect('/acheter/multicoques/lagoon-4203105.html', '/bateaux/lagoon-4203105-134');
Route::permanentRedirect('/acheter/multicoques/lagoon-4203105', '/bateaux/lagoon-4203105-134');
Route::permanentRedirect('/acheter/multicoques/lagoon-462409.html', '/bateaux/lagoon-462409-152');
Route::permanentRedirect('/acheter/multicoques/lagoon-462409', '/bateaux/lagoon-462409-152');
Route::permanentRedirect('/acheter/multicoques/lagoon-423001.html', '/bateaux/lagoon-423001-169');
Route::permanentRedirect('/acheter/multicoques/lagoon-423001', '/bateaux/lagoon-423001-169');
Route::permanentRedirect('/acheter/multicoques/lagoon-403001.html', '/bateaux/lagoon-403001-170');
Route::permanentRedirect('/acheter/multicoques/lagoon-403001', '/bateaux/lagoon-403001-170');
Route::permanentRedirect('/acheter/multicoques/lagoon-3803001.html', '/bateaux/lagoon-3803001-171');
Route::permanentRedirect('/acheter/multicoques/lagoon-3803001', '/bateaux/lagoon-3803001-171');
Route::permanentRedirect('/acheter/multicoques/lagoon-4503001.html', '/bateaux/lagoon-4503001-172');
Route::permanentRedirect('/acheter/multicoques/lagoon-4503001', '/bateaux/lagoon-4503001-172');
Route::permanentRedirect('/acheter/multicoques/lagoon-52s1103.html', '/bateaux/lagoon-52s1103-175');
Route::permanentRedirect('/acheter/multicoques/lagoon-52s1103', '/bateaux/lagoon-52s1103-175');
Route::permanentRedirect('/acheter/multicoques/africat-4200901.html', '/bateaux/africat-4200901-9');
Route::permanentRedirect('/acheter/multicoques/africat-4200901', '/bateaux/africat-4200901-9');
Route::permanentRedirect('/acheter/multicoques/dean-3651705.html', '/bateaux/dean-3651705-23');
Route::permanentRedirect('/acheter/multicoques/dean-3651705', '/bateaux/dean-3651705-23');
Route::permanentRedirect('/acheter/multicoques/dean-3650908.html', '/bateaux/dean-3650908-27');
Route::permanentRedirect('/acheter/multicoques/dean-3650908', '/bateaux/dean-3650908-27');
Route::permanentRedirect('/acheter/multicoques/dean-3652410.html', '/bateaux/dean-3652410-102');
Route::permanentRedirect('/acheter/multicoques/dean-3652410', '/bateaux/dean-3652410-102');
Route::permanentRedirect('/acheter/multicoques/dean-4400909.html', '/bateaux/dean-4400909-101');
Route::permanentRedirect('/acheter/multicoques/dean-4400909', '/bateaux/dean-4400909-101');
Route::permanentRedirect('/acheter/multicoques/dean-4410611.html', '/bateaux/dean-4410611-117');
Route::permanentRedirect('/acheter/multicoques/dean-4410611', '/bateaux/dean-4410611-117');
Route::permanentRedirect('/acheter/multicoques/dean-4401911.html', '/bateaux/dean-4401911-163');
Route::permanentRedirect('/acheter/multicoques/dean-4401911', '/bateaux/dean-4401911-163');
Route::permanentRedirect('/acheter/multicoques/belize-431512.html', '/bateaux/belize-431512-35');
Route::permanentRedirect('/acheter/multicoques/belize-431512', '/bateaux/belize-431512-35');
Route::permanentRedirect('/acheter/multicoques/belize-430903.html', '/bateaux/belize-430903-57');
Route::permanentRedirect('/acheter/multicoques/belize-430903', '/bateaux/belize-430903-57');
Route::permanentRedirect('/acheter/multicoques/fontaine-pajot-cumberland-462109.html', '/bateaux/fontaine-pajot-cumberland-462109-114');
Route::permanentRedirect('/acheter/multicoques/fontaine-pajot-cumberland-462109', '/bateaux/fontaine-pajot-cumberland-462109-114');
Route::permanentRedirect('/acheter/multicoques/helia-440405.html', '/bateaux/helia-440405-66');
Route::permanentRedirect('/acheter/multicoques/helia-440405', '/bateaux/helia-440405-66');
Route::permanentRedirect('/acheter/multicoques/eleuthera-600405.html', '/bateaux/eleuthera-600405-67');
Route::permanentRedirect('/acheter/multicoques/eleuthera-600405', '/bateaux/eleuthera-600405-67');
Route::permanentRedirect('/acheter/multicoques/bahia-462707.html', '/bateaux/bahia-462707-144');
Route::permanentRedirect('/acheter/multicoques/bahia-462707', '/bateaux/bahia-462707-144');
Route::permanentRedirect('/acheter/multicoques/nautitech-401509.html', '/bateaux/nautitech-401509-30');
Route::permanentRedirect('/acheter/multicoques/nautitech-401509', '/bateaux/nautitech-401509-30');
Route::permanentRedirect('/acheter/multicoques/athena-380803.html', '/bateaux/athena-380803-56');
Route::permanentRedirect('/acheter/multicoques/athena-380803', '/bateaux/athena-380803-56');
Route::permanentRedirect('/acheter/multicoques/mahe-360202.html', '/bateaux/mahe-360202-48');
Route::permanentRedirect('/acheter/multicoques/mahe-360202', '/bateaux/mahe-360202-48');
Route::permanentRedirect('/acheter/multicoques/mahe-361809.html', '/bateaux/mahe-361809-111');
Route::permanentRedirect('/acheter/multicoques/mahe-361809', '/bateaux/mahe-361809-111');
Route::permanentRedirect('/acheter/multicoques/previlege-121409.html', '/bateaux/previlege-121409-29');
Route::permanentRedirect('/acheter/multicoques/previlege-121409', '/bateaux/previlege-121409-29');
Route::permanentRedirect('/acheter/multicoques/wharram-naria-mk-iv2202.html', '/bateaux/wharram-naria-mk-iv2202-55');
Route::permanentRedirect('/acheter/multicoques/wharram-naria-mk-iv2202', '/bateaux/wharram-naria-mk-iv2202-55');
Route::permanentRedirect('/acheter/multicoques/wharram-nakai-mk-iv0210.html', '/bateaux/wharram-nakai-mk-iv0210-156');
Route::permanentRedirect('/acheter/multicoques/wharram-nakai-mk-iv0210', '/bateaux/wharram-nakai-mk-iv0210-156');
Route::permanentRedirect('/acheter/multicoques/wharram1712.html', '/bateaux/wharram1712-164');
Route::permanentRedirect('/acheter/multicoques/wharram1712', '/bateaux/wharram1712-164');
Route::permanentRedirect('/acheter/multicoques/dragonfly-280510.html', '/bateaux/dragonfly-280510-78');
Route::permanentRedirect('/acheter/multicoques/dragonfly-280510', '/bateaux/dragonfly-280510-78');
Route::permanentRedirect('/acheter/multicoques/triswood2607.html', '/bateaux/triswood2607-73');
Route::permanentRedirect('/acheter/multicoques/triswood2607', '/bateaux/triswood2607-73');
Route::permanentRedirect('/acheter/multicoques/trimaki1711.html', '/bateaux/trimaki1711-120');
Route::permanentRedirect('/acheter/multicoques/trimaki1711', '/bateaux/trimaki1711-120');
Route::permanentRedirect('/acheter/multicoques/tiki-261411.html', '/bateaux/tiki-261411-187');
Route::permanentRedirect('/acheter/multicoques/tiki-261411', '/bateaux/tiki-261411-187');
Route::permanentRedirect('/acheter/multicoques/prao1501.html', '/bateaux/prao1501-45');
Route::permanentRedirect('/acheter/multicoques/prao1501', '/bateaux/prao1501-45');
Route::permanentRedirect('/acheter/multicoques/hammercat-35-neuf0807.html', '/bateaux/hammercat-35-neuf0807-138');
Route::permanentRedirect('/acheter/multicoques/hammercat-35-neuf0807', '/bateaux/hammercat-35-neuf0807-138');
Route::permanentRedirect('/acheter/multicoques/djerba-4702907.html', '/bateaux/djerba-4702907-183');
Route::permanentRedirect('/acheter/multicoques/djerba-4702907', '/bateaux/djerba-4702907-183');
Route::permanentRedirect('/acheter/multicoques/power-cat-361410.html', '/bateaux/power-cat-361410-185');
Route::permanentRedirect('/acheter/multicoques/power-cat-361410', '/bateaux/power-cat-361410-185');
Route::permanentRedirect('/acheter/multicoques/trawler-cat0602.html', '/bateaux/trawler-cat0602-127');
Route::permanentRedirect('/acheter/multicoques/trawler-cat0602', '/bateaux/trawler-cat0602-127');
Route::permanentRedirect('/acheter/multicoques/astus-205-sport0602.html', '/bateaux/astus-205-sport0602-128');
Route::permanentRedirect('/acheter/multicoques/astus-205-sport0602', '/bateaux/astus-205-sport0602-128');
Route::permanentRedirect('/acheter/multicoques/sangaree-421602.html', '/bateaux/sangaree-421602-53');
Route::permanentRedirect('/acheter/multicoques/sangaree-421602', '/bateaux/sangaree-421602-53');
Route::permanentRedirect('/acheter/multicoques/polycoque-caraibe0812.html', '/bateaux/polycoque-caraibe0812-83');
Route::permanentRedirect('/acheter/multicoques/polycoque-caraibe0812', '/bateaux/polycoque-caraibe0812-83');

// --- BATEAUX MOTEUR ---
Route::permanentRedirect('/acheter/bateau-moteur/beneteau-flyer-650-open2010.html', '/bateaux/beneteau-flyer-650-open2010-7');
Route::permanentRedirect('/acheter/bateau-moteur/beneteau-flyer-650-open2010', '/bateaux/beneteau-flyer-650-open2010-7');
Route::permanentRedirect('/acheter/bateau-moteur/beneteau-gran-turismo-401107.html', '/bateaux/beneteau-gran-turismo-401107-140');
Route::permanentRedirect('/acheter/bateau-moteur/beneteau-gran-turismo-401107', '/bateaux/beneteau-gran-turismo-401107-140');
Route::permanentRedirect('/acheter/bateau-moteur/beneteau-flyer-7-8-9-neuf1107.html', '/bateaux/beneteau-flyer-7-8-9-neuf1107-141');
Route::permanentRedirect('/acheter/bateau-moteur/beneteau-flyer-7-8-9-neuf1107', '/bateaux/beneteau-flyer-7-8-9-neuf1107-141');
Route::permanentRedirect('/acheter/bateau-moteur/prestige-421802.html', '/bateaux/prestige-421802-22');
Route::permanentRedirect('/acheter/bateau-moteur/prestige-421802', '/bateaux/prestige-421802-22');
Route::permanentRedirect('/acheter/bateau-moteur/fairline-squadron-472912.html', '/bateaux/fairline-squadron-472912-36');
Route::permanentRedirect('/acheter/bateau-moteur/fairline-squadron-472912', '/bateaux/fairline-squadron-472912-36');
Route::permanentRedirect('/acheter/bateau-moteur/cap-camara-77-wa2101.html', '/bateaux/cap-camara-77-wa2101-16');
Route::permanentRedirect('/acheter/bateau-moteur/cap-camara-77-wa2101', '/bateaux/cap-camara-77-wa2101-16');
Route::permanentRedirect('/acheter/bateau-moteur/jeanneau-cap-camarat-105-cc2605.html', '/bateaux/jeanneau-cap-camarat-105-cc2605-180');
Route::permanentRedirect('/acheter/bateau-moteur/jeanneau-cap-camarat-105-cc2605', '/bateaux/jeanneau-cap-camarat-105-cc2605-180');
Route::permanentRedirect('/acheter/bateau-moteur/tropical-boat1801.html', '/bateaux/tropical-boat1801-14');
Route::permanentRedirect('/acheter/bateau-moteur/tropical-boat1801', '/bateaux/tropical-boat1801-14');
Route::permanentRedirect('/acheter/bateau-moteur/tropical-boat1712.html', '/bateaux/tropical-boat1712-86');
Route::permanentRedirect('/acheter/bateau-moteur/tropical-boat1712', '/bateaux/tropical-boat1712-86');
Route::permanentRedirect('/acheter/bateau-moteur/tropical-boat2112.html', '/bateaux/tropical-boat2112-87');
Route::permanentRedirect('/acheter/bateau-moteur/tropical-boat2112', '/bateaux/tropical-boat2112-87');
Route::permanentRedirect('/acheter/bateau-moteur/tropical-boat-14m802804.html', '/bateaux/tropical-boat-14m802804-177');
Route::permanentRedirect('/acheter/bateau-moteur/tropical-boat-14m802804', '/bateaux/tropical-boat-14m802804-177');
Route::permanentRedirect('/acheter/bateau-moteur/luhrs-360801.html', '/bateaux/luhrs-360801-38');
Route::permanentRedirect('/acheter/bateau-moteur/luhrs-360801', '/bateaux/luhrs-360801-38');
Route::permanentRedirect('/acheter/bateau-moteur/antares-9051502.html', '/bateaux/antares-9051502-51');
Route::permanentRedirect('/acheter/bateau-moteur/antares-9051502', '/bateaux/antares-9051502-51');
Route::permanentRedirect('/acheter/bateau-moteur/princess3009.html', '/bateaux/princess3009-76');
Route::permanentRedirect('/acheter/bateau-moteur/princess3009', '/bateaux/princess3009-76');
Route::permanentRedirect('/acheter/bateau-moteur/azimut-43s0901.html', '/bateaux/azimut-43s0901-167');
Route::permanentRedirect('/acheter/bateau-moteur/azimut-43s0901', '/bateaux/azimut-43s0901-167');
Route::permanentRedirect('/acheter/bateau-moteur/sessa-432409.html', '/bateaux/sessa-432409-153');
Route::permanentRedirect('/acheter/bateau-moteur/sessa-432409', '/bateaux/sessa-432409-153');
Route::permanentRedirect('/acheter/bateau-moteur/riviera-30000510.html', '/bateaux/riviera-30000510-77');
Route::permanentRedirect('/acheter/bateau-moteur/riviera-30000510', '/bateaux/riviera-30000510-77');
Route::permanentRedirect('/acheter/bateau-moteur/trawler-island-gispy-442103.html', '/bateaux/trawler-island-gispy-442103-91');
Route::permanentRedirect('/acheter/bateau-moteur/trawler-island-gispy-442103', '/bateaux/trawler-island-gispy-442103-91');
Route::permanentRedirect('/acheter/bateau-moteur/vedette-habitable0302.html', '/bateaux/vedette-habitable0302-105');
Route::permanentRedirect('/acheter/bateau-moteur/vedette-habitable0302', '/bateaux/vedette-habitable0302-105');
Route::permanentRedirect('/acheter/bateau-moteur/vedette-pro1012.html', '/bateaux/vedette-pro1012-190');
Route::permanentRedirect('/acheter/bateau-moteur/vedette-pro1012', '/bateaux/vedette-pro1012-190');
Route::permanentRedirect('/acheter/bateau-moteur/ocqueteau-olympique-7002909.html', '/bateaux/ocqueteau-olympique-7002909-31');
Route::permanentRedirect('/acheter/bateau-moteur/ocqueteau-olympique-7002909', '/bateaux/ocqueteau-olympique-7002909-31');
Route::permanentRedirect('/acheter/bateau-moteur/rio-8302905.html', '/bateaux/rio-8302905-69');
Route::permanentRedirect('/acheter/bateau-moteur/rio-8302905', '/bateaux/rio-8302905-69');
Route::permanentRedirect('/acheter/bateau-moteur/zar-750207.html', '/bateaux/zar-750207-71');
Route::permanentRedirect('/acheter/bateau-moteur/zar-750207', '/bateaux/zar-750207-71');
Route::permanentRedirect('/acheter/bateau-moteur/arvor-180207.html', '/bateaux/arvor-180207-72');
Route::permanentRedirect('/acheter/bateau-moteur/arvor-180207', '/bateaux/arvor-180207-72');
Route::permanentRedirect('/acheter/bateau-moteur/speed-7701012.html', '/bateaux/speed-7701012-84');
Route::permanentRedirect('/acheter/bateau-moteur/speed-7701012', '/bateaux/speed-7701012-84');
Route::permanentRedirect('/acheter/bateau-moteur/speed-770-od-moi0611.html', '/bateaux/speed-770-od-moi0611-116');
Route::permanentRedirect('/acheter/bateau-moteur/speed-770-od-moi0611', '/bateaux/speed-770-od-moi0611-116');
Route::permanentRedirect('/acheter/bateau-moteur/sunbird-spl-1940610.html', '/bateaux/sunbird-spl-1940610-79');
Route::permanentRedirect('/acheter/bateau-moteur/sunbird-spl-1940610', '/bateaux/sunbird-spl-1940610-79');
Route::permanentRedirect('/acheter/bateau-moteur/techmarine2211.html', '/bateaux/techmarine2211-103');
Route::permanentRedirect('/acheter/bateau-moteur/techmarine2211', '/bateaux/techmarine2211-103');
Route::permanentRedirect('/acheter/bateau-moteur/techmarine-10700911.html', '/bateaux/techmarine-10700911-119');
Route::permanentRedirect('/acheter/bateau-moteur/techmarine-10700911', '/bateaux/techmarine-10700911-119');
Route::permanentRedirect('/acheter/bateau-moteur/techmarine-212507.html', '/bateaux/techmarine-212507-143');
Route::permanentRedirect('/acheter/bateau-moteur/techmarine-212507', '/bateaux/techmarine-212507-143');
Route::permanentRedirect('/acheter/bateau-moteur/open-990m1410.html', '/bateaux/open-990m1410-158');
Route::permanentRedirect('/acheter/bateau-moteur/open-990m1410', '/bateaux/open-990m1410-158');
Route::permanentRedirect('/acheter/bateau-moteur/donzi-352605.html', '/bateaux/donzi-352605-181');
Route::permanentRedirect('/acheter/bateau-moteur/donzi-352605', '/bateaux/donzi-352605-181');
Route::permanentRedirect('/acheter/bateau-moteur/wellcraft-scarab-302605.html', '/bateaux/wellcraft-scarab-302605-182');
Route::permanentRedirect('/acheter/bateau-moteur/wellcraft-scarab-302605', '/bateaux/wellcraft-scarab-302605-182');
Route::permanentRedirect('/acheter/bateau-moteur/colombo-aliante-32s2605.html', '/bateaux/colombo-aliante-32s2605-179');
Route::permanentRedirect('/acheter/bateau-moteur/colombo-aliante-32s2605', '/bateaux/colombo-aliante-32s2605-179');
Route::permanentRedirect('/acheter/bateau-moteur/ultra-mar-shaft-7m301311.html', '/bateaux/ultra-mar-shaft-7m301311-186');
Route::permanentRedirect('/acheter/bateau-moteur/ultra-mar-shaft-7m301311', '/bateaux/ultra-mar-shaft-7m301311-186');
Route::permanentRedirect('/acheter/bateau-moteur/toky-9m501812.html', '/bateaux/toky-9m501812-165');
Route::permanentRedirect('/acheter/bateau-moteur/toky-9m501812', '/bateaux/toky-9m501812-165');
Route::permanentRedirect('/acheter/bateau-moteur/toky-12m1812.html', '/bateaux/toky-12m1812-166');
Route::permanentRedirect('/acheter/bateau-moteur/toky-12m1812', '/bateaux/toky-12m1812-166');
Route::permanentRedirect('/acheter/bateau-moteur/fond-de-verre2606.html', '/bateaux/fond-de-verre2606-109');
Route::permanentRedirect('/acheter/bateau-moteur/fond-de-verre2606', '/bateaux/fond-de-verre2606-109');
Route::permanentRedirect('/acheter/bateau-moteur/bateau-de-verre0112.html', '/bateaux/bateau-de-verre0112-104');
Route::permanentRedirect('/acheter/bateau-moteur/bateau-de-verre0112', '/bateaux/bateau-de-verre0112-104');
Route::permanentRedirect('/acheter/bateau-moteur/boutre-gasy1207.html', '/bateaux/boutre-gasy1207-99');
Route::permanentRedirect('/acheter/bateau-moteur/boutre-gasy1207', '/bateaux/boutre-gasy1207-99');
Route::permanentRedirect('/acheter/bateau-moteur/drop-260601.html', '/bateaux/drop-260601-37');
Route::permanentRedirect('/acheter/bateau-moteur/drop-260601', '/bateaux/drop-260601-37');
Route::permanentRedirect('/acheter/bateau-moteur/padi-312206.html', '/bateaux/padi-312206-70');
Route::permanentRedirect('/acheter/bateau-moteur/padi-312206', '/bateaux/padi-312206-70');
Route::permanentRedirect('/acheter/bateau-moteur/looping-572304.html', '/bateaux/looping-572304-60');
Route::permanentRedirect('/acheter/bateau-moteur/looping-572304', '/bateaux/looping-572304-60');
Route::permanentRedirect('/acheter/bateau-moteur/atch-14600107.html', '/bateaux/atch-14600107-26');
Route::permanentRedirect('/acheter/bateau-moteur/atch-14600107', '/bateaux/atch-14600107-26');
Route::permanentRedirect('/acheter/bateau-moteur/atch-14602704.html', '/bateaux/atch-14602704-61');
Route::permanentRedirect('/acheter/bateau-moteur/atch-14602704', '/bateaux/atch-14602704-61');
Route::permanentRedirect('/acheter/bateau-moteur/garin-8m2601.html', '/bateaux/garin-8m2601-21');
Route::permanentRedirect('/acheter/bateau-moteur/garin-8m2601', '/bateaux/garin-8m2601-21');
Route::permanentRedirect('/acheter/bateau-moteur/tropic-360302.html', '/bateaux/tropic-360302-49');
Route::permanentRedirect('/acheter/bateau-moteur/tropic-360302', '/bateaux/tropic-360302-49');
Route::permanentRedirect('/acheter/bateau-moteur/astove-310504.html', '/bateaux/astove-310504-92');
Route::permanentRedirect('/acheter/bateau-moteur/astove-310504', '/bateaux/astove-310504-92');
Route::permanentRedirect('/acheter/bateau-moteur/maldive-320704.html', '/bateaux/maldive-320704-93');
Route::permanentRedirect('/acheter/bateau-moteur/maldive-320704', '/bateaux/maldive-320704-93');
Route::permanentRedirect('/acheter/bateau-moteur/jaguar-380906.html', '/bateaux/jaguar-380906-96');
Route::permanentRedirect('/acheter/bateau-moteur/jaguar-380906', '/bateaux/jaguar-380906-96');
Route::permanentRedirect('/acheter/bateau-moteur/balt-6601207.html', '/bateaux/balt-6601207-98');
Route::permanentRedirect('/acheter/bateau-moteur/balt-6601207', '/bateaux/balt-6601207-98');
Route::permanentRedirect('/acheter/bateau-moteur/cramar-372605.html', '/bateaux/cramar-372605-178');
Route::permanentRedirect('/acheter/bateau-moteur/cramar-372605', '/bateaux/cramar-372605-178');
Route::permanentRedirect('/acheter/bateau-moteur/xmc-241007.html', '/bateaux/xmc-241007-139');
Route::permanentRedirect('/acheter/bateau-moteur/xmc-241007', '/bateaux/xmc-241007-139');
Route::permanentRedirect('/acheter/bateau-moteur/escale-392208.html', '/bateaux/escale-392208-147');
Route::permanentRedirect('/acheter/bateau-moteur/escale-392208', '/bateaux/escale-392208-147');
Route::permanentRedirect('/acheter/bateau-moteur/type-argos2608.html', '/bateaux/type-argos2608-148');
Route::permanentRedirect('/acheter/bateau-moteur/type-argos2608', '/bateaux/type-argos2608-148');
Route::permanentRedirect('/acheter/bateau-moteur/flot-313009.html', '/bateaux/flot-313009-155');
Route::permanentRedirect('/acheter/bateau-moteur/flot-313009', '/bateaux/flot-313009-155');
Route::permanentRedirect('/acheter/bateau-moteur/dix-harvey2410.html', '/bateaux/dix-harvey2410-161');
Route::permanentRedirect('/acheter/bateau-moteur/dix-harvey2410', '/bateaux/dix-harvey2410-161');
Route::permanentRedirect('/acheter/bateau-moteur/sun-shine2312.html', '/bateaux/sun-shine2312-88');
Route::permanentRedirect('/acheter/bateau-moteur/sun-shine2312', '/bateaux/sun-shine2312-88');

// --- AUTRES CATÉGORIES PROFONDES ---
Route::permanentRedirect('/acheter/voilier/galapagos-431604.html', '/bateaux/galapagos-431604-176');
Route::permanentRedirect('/acheter/voilier/galapagos-431604', '/bateaux/galapagos-431604-176');
Route::permanentRedirect('/acheter/voilier/petit-prince0901.html', '/bateaux/petit-prince0901-125');
Route::permanentRedirect('/acheter/voilier/petit-prince0901', '/bateaux/petit-prince0901-125');
Route::permanentRedirect('/acheter/catamaran/leopard-382202.html', '/bateaux/leopard-382202-129');
Route::permanentRedirect('/acheter/catamaran/leopard-382202', '/bateaux/leopard-382202-129');
Route::permanentRedirect('/acheter/catamaran/edel-cat-35-sport1705.html', '/bateaux/edel-cat-35-sport1705-24');
Route::permanentRedirect('/acheter/catamaran/edel-cat-35-sport1705', '/bateaux/edel-cat-35-sport1705-24');

// ==========================================
// REDIRECTIONS DES PAGES STATIQUES
// ==========================================

// Contact
Route::permanentRedirect('/nous-contacter.html', '/contact');
Route::permanentRedirect('/nous-contacter', '/contact');
Route::permanentRedirect('/contact.html', '/contact');

// Vendre son bateau
Route::permanentRedirect('/vendre-bateau.html', '/vendre');
Route::permanentRedirect('/vendre-bateau', '/vendre');
Route::permanentRedirect('/vendre-mon-bateau.html', '/vendre');
Route::permanentRedirect('/vendre-mon-bateau', '/vendre');

// A propos
Route::permanentRedirect('/a-propos.html', '/a-propos');
Route::permanentRedirect('/about.html', '/a-propos');
Route::permanentRedirect('/about', '/a-propos');

// Guides / Permis bateau
Route::permanentRedirect('/permis-bateau.html', '/articles');
Route::permanentRedirect('/permis-bateau', '/articles');
Route::permanentRedirect('/guides.html', '/articles');
Route::permanentRedirect('/guides', '/articles');

// Partenaires
Route::permanentRedirect('/partenaires.html', '/partenaires');
Route::permanentRedirect('/partners.html', '/partenaires');
Route::permanentRedirect('/partners', '/partenaires');

// Mentions legales
Route::permanentRedirect('/mentions-legales.html', '/mentions-legales');
Route::permanentRedirect('/mentions.html', '/mentions-legales');
Route::permanentRedirect('/mentions', '/mentions-legales');
Route::permanentRedirect('/legal.html', '/mentions-legales');
Route::permanentRedirect('/legal', '/mentions-legales');

// CGV
Route::permanentRedirect('/cgv.html', '/cgv');
Route::permanentRedirect('/cgu.html', '/cgv');
Route::permanentRedirect('/cgu', '/cgv');
Route::permanentRedirect('/conditions-generales.html', '/cgv');

// Confidentialite
Route::permanentRedirect('/confidentialite.html', '/confidentialite');
Route::permanentRedirect('/privacy.html', '/confidentialite');
Route::permanentRedirect('/privacy', '/confidentialite');
Route::permanentRedirect('/politique-confidentialite.html', '/confidentialite');
Route::permanentRedirect('/politique-confidentialite', '/confidentialite');

// Page d'accueil variantes
Route::permanentRedirect('/index.html', '/');
Route::permanentRedirect('/home.html', '/');
Route::permanentRedirect('/home', '/');
Route::permanentRedirect('/accueil.html', '/');
Route::permanentRedirect('/accueil', '/');

// ==========================================
// REDIRECTIONS DES BATEAUX (format /bateau/{slug})
// Format ancien: /bateau/{slug}.html ou /bateau/{slug}
// Format nouveau: /bateaux/{slug}-{id}
// ==========================================

// BATEAUX "STARS" (High Traffic selon GA4)
Route::permanentRedirect('/bateau/nouanni-44-deriveur-alu1801.html', '/bateaux/nouanni-44-deriveur-alu1801-46');
Route::permanentRedirect('/bateau/nouanni-44-deriveur-alu1801', '/bateaux/nouanni-44-deriveur-alu1801-46');
Route::permanentRedirect('/bateau/petit-prince0901.html', '/bateaux/petit-prince0901-125');
Route::permanentRedirect('/bateau/petit-prince0901', '/bateaux/petit-prince0901-125');
Route::permanentRedirect('/bateau/galapagos-431604.html', '/bateaux/galapagos-431604-176');
Route::permanentRedirect('/bateau/galapagos-431604', '/bateaux/galapagos-431604-176');
Route::permanentRedirect('/bateau/leopard-382202.html', '/bateaux/leopard-382202-129');
Route::permanentRedirect('/bateau/leopard-382202', '/bateaux/leopard-382202-129');
Route::permanentRedirect('/bateau/edel-cat-35-sport1705.html', '/bateaux/edel-cat-35-sport1705-24');
Route::permanentRedirect('/bateau/edel-cat-35-sport1705', '/bateaux/edel-cat-35-sport1705-24');

// Tous les autres bateaux (ordre alphabetique)
Route::permanentRedirect('/bateau/africat-4200901.html', '/bateaux/africat-4200901-9');
Route::permanentRedirect('/bateau/africat-4200901', '/bateaux/africat-4200901-9');
Route::permanentRedirect('/bateau/antares-9051502.html', '/bateaux/antares-9051502-51');
Route::permanentRedirect('/bateau/antares-9051502', '/bateaux/antares-9051502-51');
Route::permanentRedirect('/bateau/arvor-180207.html', '/bateaux/arvor-180207-72');
Route::permanentRedirect('/bateau/arvor-180207', '/bateaux/arvor-180207-72');
Route::permanentRedirect('/bateau/astilleros-3561301.html', '/bateaux/astilleros-3561301-11');
Route::permanentRedirect('/bateau/astilleros-3561301', '/bateaux/astilleros-3561301-11');
Route::permanentRedirect('/bateau/astove-310504.html', '/bateaux/astove-310504-92');
Route::permanentRedirect('/bateau/astove-310504', '/bateaux/astove-310504-92');
Route::permanentRedirect('/bateau/astus-205-sport0602.html', '/bateaux/astus-205-sport0602-128');
Route::permanentRedirect('/bateau/astus-205-sport0602', '/bateaux/astus-205-sport0602-128');
Route::permanentRedirect('/bateau/atch-14600107.html', '/bateaux/atch-14600107-26');
Route::permanentRedirect('/bateau/atch-14600107', '/bateaux/atch-14600107-26');
Route::permanentRedirect('/bateau/atch-14602704.html', '/bateaux/atch-14602704-61');
Route::permanentRedirect('/bateau/atch-14602704', '/bateaux/atch-14602704-61');
Route::permanentRedirect('/bateau/athena-380803.html', '/bateaux/athena-380803-56');
Route::permanentRedirect('/bateau/athena-380803', '/bateaux/athena-380803-56');
Route::permanentRedirect('/bateau/aventurin-542807.html', '/bateaux/aventurin-542807-74');
Route::permanentRedirect('/bateau/aventurin-542807', '/bateaux/aventurin-542807-74');
Route::permanentRedirect('/bateau/azimut-43s0901.html', '/bateaux/azimut-43s0901-167');
Route::permanentRedirect('/bateau/azimut-43s0901', '/bateaux/azimut-43s0901-167');
Route::permanentRedirect('/bateau/bahia-462707.html', '/bateaux/bahia-462707-144');
Route::permanentRedirect('/bateau/bahia-462707', '/bateaux/bahia-462707-144');
Route::permanentRedirect('/bateau/balt-6601207.html', '/bateaux/balt-6601207-98');
Route::permanentRedirect('/bateau/balt-6601207', '/bateaux/balt-6601207-98');
Route::permanentRedirect('/bateau/bateau-de-verre0112.html', '/bateaux/bateau-de-verre0112-104');
Route::permanentRedirect('/bateau/bateau-de-verre0112', '/bateaux/bateau-de-verre0112-104');
Route::permanentRedirect('/bateau/bavaria-500806.html', '/bateaux/bavaria-500806-135');
Route::permanentRedirect('/bateau/bavaria-500806', '/bateaux/bavaria-500806-135');
Route::permanentRedirect('/bateau/belize-430903.html', '/bateaux/belize-430903-57');
Route::permanentRedirect('/bateau/belize-430903', '/bateaux/belize-430903-57');
Route::permanentRedirect('/bateau/belize-431512.html', '/bateaux/belize-431512-35');
Route::permanentRedirect('/bateau/belize-431512', '/bateaux/belize-431512-35');
Route::permanentRedirect('/bateau/beneteau-flyer-650-open2010.html', '/bateaux/beneteau-flyer-650-open2010-7');
Route::permanentRedirect('/bateau/beneteau-flyer-650-open2010', '/bateaux/beneteau-flyer-650-open2010-7');
Route::permanentRedirect('/bateau/beneteau-flyer-7-8-9-neuf1107.html', '/bateaux/beneteau-flyer-7-8-9-neuf1107-141');
Route::permanentRedirect('/bateau/beneteau-flyer-7-8-9-neuf1107', '/bateaux/beneteau-flyer-7-8-9-neuf1107-141');
Route::permanentRedirect('/bateau/beneteau-gran-turismo-401107.html', '/bateaux/beneteau-gran-turismo-401107-140');
Route::permanentRedirect('/bateau/beneteau-gran-turismo-401107', '/bateaux/beneteau-gran-turismo-401107-140');
Route::permanentRedirect('/bateau/boutre-gasy1207.html', '/bateaux/boutre-gasy1207-99');
Route::permanentRedirect('/bateau/boutre-gasy1207', '/bateaux/boutre-gasy1207-99');
Route::permanentRedirect('/bateau/bruce-farr-540412.html', '/bateaux/bruce-farr-540412-123');
Route::permanentRedirect('/bateau/bruce-farr-540412', '/bateaux/bruce-farr-540412-123');
Route::permanentRedirect('/bateau/cap-camara-77-wa2101.html', '/bateaux/cap-camara-77-wa2101-16');
Route::permanentRedirect('/bateau/cap-camara-77-wa2101', '/bateaux/cap-camara-77-wa2101-16');
Route::permanentRedirect('/bateau/colombo-aliante-32s2605.html', '/bateaux/colombo-aliante-32s2605-179');
Route::permanentRedirect('/bateau/colombo-aliante-32s2605', '/bateaux/colombo-aliante-32s2605-179');
Route::permanentRedirect('/bateau/comarine3005.html', '/bateaux/comarine3005-133');
Route::permanentRedirect('/bateau/comarine3005', '/bateaux/comarine3005-133');
Route::permanentRedirect('/bateau/cotre-acier2007.html', '/bateaux/cotre-acier2007-100');
Route::permanentRedirect('/bateau/cotre-acier2007', '/bateaux/cotre-acier2007-100');
Route::permanentRedirect('/bateau/cramar-372605.html', '/bateaux/cramar-372605-178');
Route::permanentRedirect('/bateau/cramar-372605', '/bateaux/cramar-372605-178');
Route::permanentRedirect('/bateau/dean-3650908.html', '/bateaux/dean-3650908-27');
Route::permanentRedirect('/bateau/dean-3650908', '/bateaux/dean-3650908-27');
Route::permanentRedirect('/bateau/dean-3651705.html', '/bateaux/dean-3651705-23');
Route::permanentRedirect('/bateau/dean-3651705', '/bateaux/dean-3651705-23');
Route::permanentRedirect('/bateau/dean-3652410.html', '/bateaux/dean-3652410-102');
Route::permanentRedirect('/bateau/dean-3652410', '/bateaux/dean-3652410-102');
Route::permanentRedirect('/bateau/dean-4400909.html', '/bateaux/dean-4400909-101');
Route::permanentRedirect('/bateau/dean-4400909', '/bateaux/dean-4400909-101');
Route::permanentRedirect('/bateau/dean-4401911.html', '/bateaux/dean-4401911-163');
Route::permanentRedirect('/bateau/dean-4401911', '/bateaux/dean-4401911-163');
Route::permanentRedirect('/bateau/dean-4410611.html', '/bateaux/dean-4410611-117');
Route::permanentRedirect('/bateau/dean-4410611', '/bateaux/dean-4410611-117');
Route::permanentRedirect('/bateau/deriveur-45-alu1511.html', '/bateaux/deriveur-45-alu1511-82');
Route::permanentRedirect('/bateau/deriveur-45-alu1511', '/bateaux/deriveur-45-alu1511-82');
Route::permanentRedirect('/bateau/dix-harvey2410.html', '/bateaux/dix-harvey2410-161');
Route::permanentRedirect('/bateau/dix-harvey2410', '/bateaux/dix-harvey2410-161');
Route::permanentRedirect('/bateau/djerba-4702907.html', '/bateaux/djerba-4702907-183');
Route::permanentRedirect('/bateau/djerba-4702907', '/bateaux/djerba-4702907-183');
Route::permanentRedirect('/bateau/donzi-352605.html', '/bateaux/donzi-352605-181');
Route::permanentRedirect('/bateau/donzi-352605', '/bateaux/donzi-352605-181');
Route::permanentRedirect('/bateau/dragonfly-280510.html', '/bateaux/dragonfly-280510-78');
Route::permanentRedirect('/bateau/dragonfly-280510', '/bateaux/dragonfly-280510-78');
Route::permanentRedirect('/bateau/drop-260601.html', '/bateaux/drop-260601-37');
Route::permanentRedirect('/bateau/drop-260601', '/bateaux/drop-260601-37');
Route::permanentRedirect('/bateau/dufour-413001.html', '/bateaux/dufour-413001-168');
Route::permanentRedirect('/bateau/dufour-413001', '/bateaux/dufour-413001-168');
Route::permanentRedirect('/bateau/edel-350311.html', '/bateaux/edel-350311-115');
Route::permanentRedirect('/bateau/edel-350311', '/bateaux/edel-350311-115');
Route::permanentRedirect('/bateau/edel-cat-35-open1710.html', '/bateaux/edel-cat-35-open1710-159');
Route::permanentRedirect('/bateau/edel-cat-35-open1710', '/bateaux/edel-cat-35-open1710-159');
Route::permanentRedirect('/bateau/efo-oyster-343005.html', '/bateaux/efo-oyster-343005-132');
Route::permanentRedirect('/bateau/efo-oyster-343005', '/bateaux/efo-oyster-343005-132');
Route::permanentRedirect('/bateau/eleuthera-600405.html', '/bateaux/eleuthera-600405-67');
Route::permanentRedirect('/bateau/eleuthera-600405', '/bateaux/eleuthera-600405-67');
Route::permanentRedirect('/bateau/escale-392208.html', '/bateaux/escale-392208-147');
Route::permanentRedirect('/bateau/escale-392208', '/bateaux/escale-392208-147');
Route::permanentRedirect('/bateau/etap-32-s2203.html', '/bateaux/etap-32-s2203-58');
Route::permanentRedirect('/bateau/etap-32-s2203', '/bateaux/etap-32-s2203-58');
Route::permanentRedirect('/bateau/evasion-340303.html', '/bateaux/evasion-340303-90');
Route::permanentRedirect('/bateau/evasion-340303', '/bateaux/evasion-340303-90');
Route::permanentRedirect('/bateau/evasion-341910.html', '/bateaux/evasion-341910-6');
Route::permanentRedirect('/bateau/evasion-341910', '/bateaux/evasion-341910-6');
Route::permanentRedirect('/bateau/fairline-squadron-472912.html', '/bateaux/fairline-squadron-472912-36');
Route::permanentRedirect('/bateau/fairline-squadron-472912', '/bateaux/fairline-squadron-472912-36');
Route::permanentRedirect('/bateau/first-2112006.html', '/bateaux/first-2112006-108');
Route::permanentRedirect('/bateau/first-2112006', '/bateaux/first-2112006-108');
Route::permanentRedirect('/bateau/first-41s3004.html', '/bateaux/first-41s3004-62');
Route::permanentRedirect('/bateau/first-41s3004', '/bateaux/first-41s3004-62');
Route::permanentRedirect('/bateau/flot-313009.html', '/bateaux/flot-313009-155');
Route::permanentRedirect('/bateau/flot-313009', '/bateaux/flot-313009-155');
Route::permanentRedirect('/bateau/fond-de-verre2606.html', '/bateaux/fond-de-verre2606-109');
Route::permanentRedirect('/bateau/fond-de-verre2606', '/bateaux/fond-de-verre2606-109');
Route::permanentRedirect('/bateau/fontaine-pajot-cumberland-462109.html', '/bateaux/fontaine-pajot-cumberland-462109-114');
Route::permanentRedirect('/bateau/fontaine-pajot-cumberland-462109', '/bateaux/fontaine-pajot-cumberland-462109-114');
Route::permanentRedirect('/bateau/garin-8m2601.html', '/bateaux/garin-8m2601-21');
Route::permanentRedirect('/bateau/garin-8m2601', '/bateaux/garin-8m2601-21');
Route::permanentRedirect('/bateau/gib-sea-432307.html', '/bateaux/gib-sea-432307-142');
Route::permanentRedirect('/bateau/gib-sea-432307', '/bateaux/gib-sea-432307-142');
Route::permanentRedirect('/bateau/gib-sea-432405.html', '/bateaux/gib-sea-432405-68');
Route::permanentRedirect('/bateau/gib-sea-432405', '/bateaux/gib-sea-432405-68');
Route::permanentRedirect('/bateau/goelette-14m0907.html', '/bateaux/goelette-14m0907-97');
Route::permanentRedirect('/bateau/goelette-14m0907', '/bateaux/goelette-14m0907-97');
Route::permanentRedirect('/bateau/goelette-german-fres1809.html', '/bateaux/goelette-german-fres1809-113');
Route::permanentRedirect('/bateau/goelette-german-fres1809', '/bateaux/goelette-german-fres1809-113');
Route::permanentRedirect('/bateau/goelette1808.html', '/bateaux/goelette1808-28');
Route::permanentRedirect('/bateau/goelette1808', '/bateaux/goelette1808-28');
Route::permanentRedirect('/bateau/grand-large-570801.html', '/bateaux/grand-large-570801-39');
Route::permanentRedirect('/bateau/grand-large-570801', '/bateaux/grand-large-570801-39');
Route::permanentRedirect('/bateau/grisbi-360912.html', '/bateaux/grisbi-360912-124');
Route::permanentRedirect('/bateau/grisbi-360912', '/bateaux/grisbi-360912-124');
Route::permanentRedirect('/bateau/hammercat-35-neuf0807.html', '/bateaux/hammercat-35-neuf0807-138');
Route::permanentRedirect('/bateau/hammercat-35-neuf0807', '/bateaux/hammercat-35-neuf0807-138');
Route::permanentRedirect('/bateau/harmony-471202.html', '/bateaux/harmony-471202-173');
Route::permanentRedirect('/bateau/harmony-471202', '/bateaux/harmony-471202-173');
Route::permanentRedirect('/bateau/helia-440405.html', '/bateaux/helia-440405-66');
Route::permanentRedirect('/bateau/helia-440405', '/bateaux/helia-440405-66');
Route::permanentRedirect('/bateau/hunraken-ct-431710.html', '/bateaux/hunraken-ct-431710-4');
Route::permanentRedirect('/bateau/hunraken-ct-431710', '/bateaux/hunraken-ct-431710-4');
Route::permanentRedirect('/bateau/hunter-2351906.html', '/bateaux/hunter-2351906-106');
Route::permanentRedirect('/bateau/hunter-2351906', '/bateaux/hunter-2351906-106');
Route::permanentRedirect('/bateau/hunter-332504.html', '/bateaux/hunter-332504-94');
Route::permanentRedirect('/bateau/hunter-332504', '/bateaux/hunter-332504-94');
Route::permanentRedirect('/bateau/iris-372502.html', '/bateaux/iris-372502-174');
Route::permanentRedirect('/bateau/iris-372502', '/bateaux/iris-372502-174');
Route::permanentRedirect('/bateau/j-701701.html', '/bateaux/j-701701-13');
Route::permanentRedirect('/bateau/j-701701', '/bateaux/j-701701-13');
Route::permanentRedirect('/bateau/jaguar-380906.html', '/bateaux/jaguar-380906-96');
Route::permanentRedirect('/bateau/jaguar-380906', '/bateaux/jaguar-380906-96');
Route::permanentRedirect('/bateau/jeanneau-4512101.html', '/bateaux/jeanneau-4512101-17');
Route::permanentRedirect('/bateau/jeanneau-4512101', '/bateaux/jeanneau-4512101-17');
Route::permanentRedirect('/bateau/jeanneau-45121012.html', '/bateaux/jeanneau-45121012-47');
Route::permanentRedirect('/bateau/jeanneau-45121012', '/bateaux/jeanneau-45121012-47');
Route::permanentRedirect('/bateau/jeanneau-cap-camarat-105-cc2605.html', '/bateaux/jeanneau-cap-camarat-105-cc2605-180');
Route::permanentRedirect('/bateau/jeanneau-cap-camarat-105-cc2605', '/bateaux/jeanneau-cap-camarat-105-cc2605-180');
Route::permanentRedirect('/bateau/jeanneau2907.html', '/bateaux/jeanneau2907-75');
Route::permanentRedirect('/bateau/jeanneau2907', '/bateaux/jeanneau2907-75');
Route::permanentRedirect('/bateau/lacoste-362401.html', '/bateaux/lacoste-362401-20');
Route::permanentRedirect('/bateau/lacoste-362401', '/bateaux/lacoste-362401-20');
Route::permanentRedirect('/bateau/lagoon-380s21504.html', '/bateaux/lagoon-380s21504-131');
Route::permanentRedirect('/bateau/lagoon-380s21504', '/bateaux/lagoon-380s21504-131');
Route::permanentRedirect('/bateau/lagoon-3803001.html', '/bateaux/lagoon-3803001-171');
Route::permanentRedirect('/bateau/lagoon-3803001', '/bateaux/lagoon-3803001-171');
Route::permanentRedirect('/bateau/lagoon-390405.html', '/bateaux/lagoon-390405-64');
Route::permanentRedirect('/bateau/lagoon-390405', '/bateaux/lagoon-390405-64');
Route::permanentRedirect('/bateau/lagoon-391810.html', '/bateaux/lagoon-391810-80');
Route::permanentRedirect('/bateau/lagoon-391810', '/bateaux/lagoon-391810-80');
Route::permanentRedirect('/bateau/lagoon-400s21305.html', '/bateaux/lagoon-400s21305-95');
Route::permanentRedirect('/bateau/lagoon-400s21305', '/bateaux/lagoon-400s21305-95');
Route::permanentRedirect('/bateau/lagoon-403001.html', '/bateaux/lagoon-403001-170');
Route::permanentRedirect('/bateau/lagoon-403001', '/bateaux/lagoon-403001-170');
Route::permanentRedirect('/bateau/lagoon-410-s21702.html', '/bateaux/lagoon-410-s21702-89');
Route::permanentRedirect('/bateau/lagoon-410-s21702', '/bateaux/lagoon-410-s21702-89');
Route::permanentRedirect('/bateau/lagoon-4203105.html', '/bateaux/lagoon-4203105-134');
Route::permanentRedirect('/bateau/lagoon-4203105', '/bateaux/lagoon-4203105-134');
Route::permanentRedirect('/bateau/lagoon-423001.html', '/bateaux/lagoon-423001-169');
Route::permanentRedirect('/bateau/lagoon-423001', '/bateaux/lagoon-423001-169');
Route::permanentRedirect('/bateau/lagoon-4501102.html', '/bateaux/lagoon-4501102-50');
Route::permanentRedirect('/bateau/lagoon-4501102', '/bateaux/lagoon-4501102-50');
Route::permanentRedirect('/bateau/lagoon-4503001.html', '/bateaux/lagoon-4503001-172');
Route::permanentRedirect('/bateau/lagoon-4503001', '/bateaux/lagoon-4503001-172');
Route::permanentRedirect('/bateau/lagoon-462409.html', '/bateaux/lagoon-462409-152');
Route::permanentRedirect('/bateau/lagoon-462409', '/bateaux/lagoon-462409-152');
Route::permanentRedirect('/bateau/lagoon-4701602.html', '/bateaux/lagoon-4701602-54');
Route::permanentRedirect('/bateau/lagoon-4701602', '/bateaux/lagoon-4701602-54');
Route::permanentRedirect('/bateau/lagoon-472505.html', '/bateaux/lagoon-472505-25');
Route::permanentRedirect('/bateau/lagoon-472505', '/bateaux/lagoon-472505-25');
Route::permanentRedirect('/bateau/lagoon-52s1103.html', '/bateaux/lagoon-52s1103-175');
Route::permanentRedirect('/bateau/lagoon-52s1103', '/bateaux/lagoon-52s1103-175');
Route::permanentRedirect('/bateau/leopard-462101.html', '/bateaux/leopard-462101-18');
Route::permanentRedirect('/bateau/leopard-462101', '/bateaux/leopard-462101-18');
Route::permanentRedirect('/bateau/leopard-47-de-2004-a-rentrer2101.html', '/bateaux/leopard-47-de-2004-a-rentrer2101-19');
Route::permanentRedirect('/bateau/leopard-47-de-2004-a-rentrer2101', '/bateaux/leopard-47-de-2004-a-rentrer2101-19');
Route::permanentRedirect('/bateau/leopard-472908.html', '/bateaux/leopard-472908-149');
Route::permanentRedirect('/bateau/leopard-472908', '/bateaux/leopard-472908-149');
Route::permanentRedirect('/bateau/leopard-53-20202409.html', '/bateaux/leopard-53-20202409-151');
Route::permanentRedirect('/bateau/leopard-53-20202409', '/bateaux/leopard-53-20202409-151');
Route::permanentRedirect('/bateau/leopard-532309.html', '/bateaux/leopard-532309-150');
Route::permanentRedirect('/bateau/leopard-532309', '/bateaux/leopard-532309-150');
Route::permanentRedirect('/bateau/looping-572304.html', '/bateaux/looping-572304-60');
Route::permanentRedirect('/bateau/looping-572304', '/bateaux/looping-572304-60');
Route::permanentRedirect('/bateau/luhrs-360801.html', '/bateaux/luhrs-360801-38');
Route::permanentRedirect('/bateau/luhrs-360801', '/bateaux/luhrs-360801-38');
Route::permanentRedirect('/bateau/mahe-360202.html', '/bateaux/mahe-360202-48');
Route::permanentRedirect('/bateau/mahe-360202', '/bateaux/mahe-360202-48');
Route::permanentRedirect('/bateau/mahe-361809.html', '/bateaux/mahe-361809-111');
Route::permanentRedirect('/bateau/mahe-361809', '/bateaux/mahe-361809-111');
Route::permanentRedirect('/bateau/maldive-320704.html', '/bateaux/maldive-320704-93');
Route::permanentRedirect('/bateau/maldive-320704', '/bateaux/maldive-320704-93');
Route::permanentRedirect('/bateau/marquise-561711.html', '/bateaux/marquise-561711-122');
Route::permanentRedirect('/bateau/marquise-561711', '/bateaux/marquise-561711-122');
Route::permanentRedirect('/bateau/maryland-371310.html', '/bateaux/maryland-371310-32');
Route::permanentRedirect('/bateau/maryland-371310', '/bateaux/maryland-371310-32');
Route::permanentRedirect('/bateau/moira-313107.html', '/bateaux/moira-313107-146');
Route::permanentRedirect('/bateau/moira-313107', '/bateaux/moira-313107-146');
Route::permanentRedirect('/bateau/nautitech-401509.html', '/bateaux/nautitech-401509-30');
Route::permanentRedirect('/bateau/nautitech-401509', '/bateaux/nautitech-401509-30');
Route::permanentRedirect('/bateau/ne-quid-nimis1809.html', '/bateaux/ne-quid-nimis1809-112');
Route::permanentRedirect('/bateau/ne-quid-nimis1809', '/bateaux/ne-quid-nimis1809-112');
Route::permanentRedirect('/bateau/norman-cross-261701.html', '/bateaux/norman-cross-261701-12');
Route::permanentRedirect('/bateau/norman-cross-261701', '/bateaux/norman-cross-261701-12');
Route::permanentRedirect('/bateau/norman-cross-36r3107.html', '/bateaux/norman-cross-36r3107-145');
Route::permanentRedirect('/bateau/norman-cross-36r3107', '/bateaux/norman-cross-36r3107-145');
Route::permanentRedirect('/bateau/north-wind-470607.html', '/bateaux/north-wind-470607-136');
Route::permanentRedirect('/bateau/north-wind-470607', '/bateaux/north-wind-470607-136');
Route::permanentRedirect('/bateau/ocqueteau-olympique-7002909.html', '/bateaux/ocqueteau-olympique-7002909-31');
Route::permanentRedirect('/bateau/ocqueteau-olympique-7002909', '/bateaux/ocqueteau-olympique-7002909-31');
Route::permanentRedirect('/bateau/offshore-cruiser-461906.html', '/bateaux/offshore-cruiser-461906-107');
Route::permanentRedirect('/bateau/offshore-cruiser-461906', '/bateaux/offshore-cruiser-461906-107');
Route::permanentRedirect('/bateau/open-990m1410.html', '/bateaux/open-990m1410-158');
Route::permanentRedirect('/bateau/open-990m1410', '/bateaux/open-990m1410-158');
Route::permanentRedirect('/bateau/padi-312206.html', '/bateaux/padi-312206-70');
Route::permanentRedirect('/bateau/padi-312206', '/bateaux/padi-312206-70');
Route::permanentRedirect('/bateau/polycoque-caraibe0812.html', '/bateaux/polycoque-caraibe0812-83');
Route::permanentRedirect('/bateau/polycoque-caraibe0812', '/bateaux/polycoque-caraibe0812-83');
Route::permanentRedirect('/bateau/power-cat-361410.html', '/bateaux/power-cat-361410-185');
Route::permanentRedirect('/bateau/power-cat-361410', '/bateaux/power-cat-361410-185');
Route::permanentRedirect('/bateau/prao1501.html', '/bateaux/prao1501-45');
Route::permanentRedirect('/bateau/prao1501', '/bateaux/prao1501-45');
Route::permanentRedirect('/bateau/prestige-421802.html', '/bateaux/prestige-421802-22');
Route::permanentRedirect('/bateau/prestige-421802', '/bateaux/prestige-421802-22');
Route::permanentRedirect('/bateau/previlege-121409.html', '/bateaux/previlege-121409-29');
Route::permanentRedirect('/bateau/previlege-121409', '/bateaux/previlege-121409-29');
Route::permanentRedirect('/bateau/princess3009.html', '/bateaux/princess3009-76');
Route::permanentRedirect('/bateau/princess3009', '/bateaux/princess3009-76');
Route::permanentRedirect('/bateau/rio-8302905.html', '/bateaux/rio-8302905-69');
Route::permanentRedirect('/bateau/rio-8302905', '/bateaux/rio-8302905-69');
Route::permanentRedirect('/bateau/riviera-30000510.html', '/bateaux/riviera-30000510-77');
Route::permanentRedirect('/bateau/riviera-30000510', '/bateaux/riviera-30000510-77');
Route::permanentRedirect('/bateau/sangaree-421602.html', '/bateaux/sangaree-421602-53');
Route::permanentRedirect('/bateau/sangaree-421602', '/bateaux/sangaree-421602-53');
Route::permanentRedirect('/bateau/schooner-500502.html', '/bateaux/schooner-500502-126');
Route::permanentRedirect('/bateau/schooner-500502', '/bateaux/schooner-500502-126');
Route::permanentRedirect('/bateau/sessa-432409.html', '/bateaux/sessa-432409-153');
Route::permanentRedirect('/bateau/sessa-432409', '/bateaux/sessa-432409-153');
Route::permanentRedirect('/bateau/speed-770-od-moi0611.html', '/bateaux/speed-770-od-moi0611-116');
Route::permanentRedirect('/bateau/speed-770-od-moi0611', '/bateaux/speed-770-od-moi0611-116');
Route::permanentRedirect('/bateau/speed-7701012.html', '/bateaux/speed-7701012-84');
Route::permanentRedirect('/bateau/speed-7701012', '/bateaux/speed-7701012-84');
Route::permanentRedirect('/bateau/sun-odyssee2111.html', '/bateaux/sun-odyssee2111-34');
Route::permanentRedirect('/bateau/sun-odyssee2111', '/bateaux/sun-odyssee2111-34');
Route::permanentRedirect('/bateau/sun-odyssey-331301.html', '/bateaux/sun-odyssey-331301-40');
Route::permanentRedirect('/bateau/sun-odyssey-331301', '/bateaux/sun-odyssey-331301-40');
Route::permanentRedirect('/bateau/sun-odyssey-349-limited-edition2602.html', '/bateaux/sun-odyssey-349-limited-edition2602-130');
Route::permanentRedirect('/bateau/sun-odyssey-349-limited-edition2602', '/bateaux/sun-odyssey-349-limited-edition2602-130');
Route::permanentRedirect('/bateau/sun-odyssey-39-i1911.html', '/bateaux/sun-odyssey-39-i1911-188');
Route::permanentRedirect('/bateau/sun-odyssey-39-i1911', '/bateaux/sun-odyssey-39-i1911-188');
Route::permanentRedirect('/bateau/sun-odyssey-4190405.html', '/bateaux/sun-odyssey-4190405-65');
Route::permanentRedirect('/bateau/sun-odyssey-4190405', '/bateaux/sun-odyssey-4190405-65');
Route::permanentRedirect('/bateau/sun-shine2312.html', '/bateaux/sun-shine2312-88');
Route::permanentRedirect('/bateau/sun-shine2312', '/bateaux/sun-shine2312-88');
Route::permanentRedirect('/bateau/sunbird-spl-1940610.html', '/bateaux/sunbird-spl-1940610-79');
Route::permanentRedirect('/bateau/sunbird-spl-1940610', '/bateaux/sunbird-spl-1940610-79');
Route::permanentRedirect('/bateau/suspens1910.html', '/bateaux/suspens1910-5');
Route::permanentRedirect('/bateau/suspens1910', '/bateaux/suspens1910-5');
Route::permanentRedirect('/bateau/swan-380511.html', '/bateaux/swan-380511-81');
Route::permanentRedirect('/bateau/swan-380511', '/bateaux/swan-380511-81');
Route::permanentRedirect('/bateau/techmarine-10700911.html', '/bateaux/techmarine-10700911-119');
Route::permanentRedirect('/bateau/techmarine-10700911', '/bateaux/techmarine-10700911-119');
Route::permanentRedirect('/bateau/techmarine-212507.html', '/bateaux/techmarine-212507-143');
Route::permanentRedirect('/bateau/techmarine-212507', '/bateaux/techmarine-212507-143');
Route::permanentRedirect('/bateau/techmarine2211.html', '/bateaux/techmarine2211-103');
Route::permanentRedirect('/bateau/techmarine2211', '/bateaux/techmarine2211-103');
Route::permanentRedirect('/bateau/tiki-261411.html', '/bateaux/tiki-261411-187');
Route::permanentRedirect('/bateau/tiki-261411', '/bateaux/tiki-261411-187');
Route::permanentRedirect('/bateau/toky-12m1812.html', '/bateaux/toky-12m1812-166');
Route::permanentRedirect('/bateau/toky-12m1812', '/bateaux/toky-12m1812-166');
Route::permanentRedirect('/bateau/toky-9m501812.html', '/bateaux/toky-9m501812-165');
Route::permanentRedirect('/bateau/toky-9m501812', '/bateaux/toky-9m501812-165');
Route::permanentRedirect('/bateau/trawler-cat0602.html', '/bateaux/trawler-cat0602-127');
Route::permanentRedirect('/bateau/trawler-cat0602', '/bateaux/trawler-cat0602-127');
Route::permanentRedirect('/bateau/trawler-island-gispy-442103.html', '/bateaux/trawler-island-gispy-442103-91');
Route::permanentRedirect('/bateau/trawler-island-gispy-442103', '/bateaux/trawler-island-gispy-442103-91');
Route::permanentRedirect('/bateau/trimaki1711.html', '/bateaux/trimaki1711-120');
Route::permanentRedirect('/bateau/trimaki1711', '/bateaux/trimaki1711-120');
Route::permanentRedirect('/bateau/trinidad-482807.html', '/bateaux/trinidad-482807-110');
Route::permanentRedirect('/bateau/trinidad-482807', '/bateaux/trinidad-482807-110');
Route::permanentRedirect('/bateau/triptyque-233004.html', '/bateaux/triptyque-233004-63');
Route::permanentRedirect('/bateau/triptyque-233004', '/bateaux/triptyque-233004-63');
Route::permanentRedirect('/bateau/triswood2607.html', '/bateaux/triswood2607-73');
Route::permanentRedirect('/bateau/triswood2607', '/bateaux/triswood2607-73');
Route::permanentRedirect('/bateau/tropic-360302.html', '/bateaux/tropic-360302-49');
Route::permanentRedirect('/bateau/tropic-360302', '/bateaux/tropic-360302-49');
Route::permanentRedirect('/bateau/tropical-boat-14m802804.html', '/bateaux/tropical-boat-14m802804-177');
Route::permanentRedirect('/bateau/tropical-boat-14m802804', '/bateaux/tropical-boat-14m802804-177');
Route::permanentRedirect('/bateau/tropical-boat1712.html', '/bateaux/tropical-boat1712-86');
Route::permanentRedirect('/bateau/tropical-boat1712', '/bateaux/tropical-boat1712-86');
Route::permanentRedirect('/bateau/tropical-boat1801.html', '/bateaux/tropical-boat1801-14');
Route::permanentRedirect('/bateau/tropical-boat1801', '/bateaux/tropical-boat1801-14');
Route::permanentRedirect('/bateau/tropical-boat2112.html', '/bateaux/tropical-boat2112-87');
Route::permanentRedirect('/bateau/tropical-boat2112', '/bateaux/tropical-boat2112-87');
Route::permanentRedirect('/bateau/type-argos2608.html', '/bateaux/type-argos2608-148');
Route::permanentRedirect('/bateau/type-argos2608', '/bateaux/type-argos2608-148');
Route::permanentRedirect('/bateau/ultra-mar-shaft-7m301311.html', '/bateaux/ultra-mar-shaft-7m301311-186');
Route::permanentRedirect('/bateau/ultra-mar-shaft-7m301311', '/bateaux/ultra-mar-shaft-7m301311-186');
Route::permanentRedirect('/bateau/vandame-501401.html', '/bateaux/vandame-501401-44');
Route::permanentRedirect('/bateau/vandame-501401', '/bateaux/vandame-501401-44');
Route::permanentRedirect('/bateau/vedette-habitable0302.html', '/bateaux/vedette-habitable0302-105');
Route::permanentRedirect('/bateau/vedette-habitable0302', '/bateaux/vedette-habitable0302-105');
Route::permanentRedirect('/bateau/vedette-pro1012.html', '/bateaux/vedette-pro1012-190');
Route::permanentRedirect('/bateau/vedette-pro1012', '/bateaux/vedette-pro1012-190');
Route::permanentRedirect('/bateau/venezia-421911.html', '/bateaux/venezia-421911-162');
Route::permanentRedirect('/bateau/venezia-421911', '/bateaux/venezia-421911-162');
Route::permanentRedirect('/bateau/via-42-deriveur-alu2001.html', '/bateaux/via-42-deriveur-alu2001-15');
Route::permanentRedirect('/bateau/via-42-deriveur-alu2001', '/bateaux/via-42-deriveur-alu2001-15');
Route::permanentRedirect('/bateau/wellcraft-scarab-302605.html', '/bateaux/wellcraft-scarab-302605-182');
Route::permanentRedirect('/bateau/wellcraft-scarab-302605', '/bateaux/wellcraft-scarab-302605-182');
Route::permanentRedirect('/bateau/westerly0611.html', '/bateaux/westerly0611-118');
Route::permanentRedirect('/bateau/westerly0611', '/bateaux/westerly0611-118');
Route::permanentRedirect('/bateau/wharram-nakai-mk-iv0210.html', '/bateaux/wharram-nakai-mk-iv0210-156');
Route::permanentRedirect('/bateau/wharram-nakai-mk-iv0210', '/bateaux/wharram-nakai-mk-iv0210-156');
Route::permanentRedirect('/bateau/wharram-naria-mk-iv2202.html', '/bateaux/wharram-naria-mk-iv2202-55');
Route::permanentRedirect('/bateau/wharram-naria-mk-iv2202', '/bateaux/wharram-naria-mk-iv2202-55');
Route::permanentRedirect('/bateau/wharram1712.html', '/bateaux/wharram1712-164');
Route::permanentRedirect('/bateau/wharram1712', '/bateaux/wharram1712-164');
Route::permanentRedirect('/bateau/xmc-241007.html', '/bateaux/xmc-241007-139');
Route::permanentRedirect('/bateau/xmc-241007', '/bateaux/xmc-241007-139');
Route::permanentRedirect('/bateau/y-s-431412.html', '/bateaux/y-s-431412-85');
Route::permanentRedirect('/bateau/y-s-431412', '/bateaux/y-s-431412-85');
Route::permanentRedirect('/bateau/zar-750207.html', '/bateaux/zar-750207-71');
Route::permanentRedirect('/bateau/zar-750207', '/bateaux/zar-750207-71');

// ==========================================
// REDIRECTIONS VERSION ANGLAISE (/en/...)
// URLs anciennes Symfony vers nouvelles URLs Laravel localisées
// ==========================================

// Note: /en/boats, /en/categories, etc. sont maintenant gérés par Laravel Localization
// Ces redirections sont uniquement pour les OLD URLs Symfony (.html, /buy/, etc.)

// Page d'accueil anglaise (ancienne version)
Route::permanentRedirect('/en/index.html', '/en');

// TOP PERFORMANCE - Zones anglaises (Money Pages) -> Nouvelles URLs localisées
Route::permanentRedirect('/en/buy/buy-boat-madagascar.html', '/en/boats?zone=madagascar');
Route::permanentRedirect('/en/buy/buy-boat-madagascar', '/en/boats?zone=madagascar');
Route::permanentRedirect('/en/buy-boat-madagascar.html', '/en/boats?zone=madagascar');
Route::permanentRedirect('/en/buy-boat-madagascar', '/en/boats?zone=madagascar');

Route::permanentRedirect('/en/buy/buy-boat-reunion.html', '/en/boats?zone=la-reunion');
Route::permanentRedirect('/en/buy/buy-boat-reunion', '/en/boats?zone=la-reunion');
Route::permanentRedirect('/en/buy-boat-reunion.html', '/en/boats?zone=la-reunion');
Route::permanentRedirect('/en/buy-boat-reunion', '/en/boats?zone=la-reunion');

Route::permanentRedirect('/en/buy/buy-boat-mayotte.html', '/en/boats?zone=mayotte');
Route::permanentRedirect('/en/buy/buy-boat-mayotte', '/en/boats?zone=mayotte');
Route::permanentRedirect('/en/buy-boat-mayotte.html', '/en/boats?zone=mayotte');
Route::permanentRedirect('/en/buy-boat-mayotte', '/en/boats?zone=mayotte');

Route::permanentRedirect('/en/buy/buy-boat-mauritius.html', '/en/boats?zone=maurice');
Route::permanentRedirect('/en/buy/buy-boat-mauritius', '/en/boats?zone=maurice');
Route::permanentRedirect('/en/buy-boat-mauritius.html', '/en/boats?zone=maurice');
Route::permanentRedirect('/en/buy-boat-mauritius', '/en/boats?zone=maurice');

Route::permanentRedirect('/en/buy/buy-boat-seychelles.html', '/en/boats?zone=seychelles');
Route::permanentRedirect('/en/buy/buy-boat-seychelles', '/en/boats?zone=seychelles');
Route::permanentRedirect('/en/buy-boat-seychelles.html', '/en/boats?zone=seychelles');
Route::permanentRedirect('/en/buy-boat-seychelles', '/en/boats?zone=seychelles');

Route::permanentRedirect('/en/buy/buy-boat-pacific-ocean.html', '/en/boats?zone=hors-ocean-indien');
Route::permanentRedirect('/en/buy/buy-boat-pacific-ocean', '/en/boats?zone=hors-ocean-indien');
Route::permanentRedirect('/en/buy-boat-pacific-ocean.html', '/en/boats?zone=hors-ocean-indien');
Route::permanentRedirect('/en/buy-boat-pacific-ocean', '/en/boats?zone=hors-ocean-indien');

Route::permanentRedirect('/en/buy/buy-boat-france.html', '/en/boats?zone=metropole');
Route::permanentRedirect('/en/buy/buy-boat-france', '/en/boats?zone=metropole');
Route::permanentRedirect('/en/buy-boat-france.html', '/en/boats?zone=metropole');
Route::permanentRedirect('/en/buy-boat-france', '/en/boats?zone=metropole');

// Types de bateaux en anglais -> Nouvelles URLs localisées
Route::permanentRedirect('/en/buy/monohull.html', '/en/boats?type=voilier-monocoque');
Route::permanentRedirect('/en/buy/monohull', '/en/boats?type=voilier-monocoque');
Route::permanentRedirect('/en/monohull.html', '/en/boats?type=voilier-monocoque');

Route::permanentRedirect('/en/buy/multihull.html', '/en/boats?type=catamaran-a-voile');
Route::permanentRedirect('/en/buy/multihull', '/en/boats?type=catamaran-a-voile');
Route::permanentRedirect('/en/multihull.html', '/en/boats?type=catamaran-a-voile');

Route::permanentRedirect('/en/buy/boat-engine.html', '/en/boats?type=bateau-moteur');
Route::permanentRedirect('/en/buy/boat-engine', '/en/boats?type=bateau-moteur');
Route::permanentRedirect('/en/boat-engine.html', '/en/boats?type=bateau-moteur');
Route::permanentRedirect('/en/buy/motor-boat.html', '/en/boats?type=bateau-moteur');
Route::permanentRedirect('/en/buy/motor-boat', '/en/boats?type=bateau-moteur');

Route::permanentRedirect('/en/buy/motor-catamaran.html', '/en/boats?type=catamaran-a-moteur');
Route::permanentRedirect('/en/buy/motor-catamaran', '/en/boats?type=catamaran-a-moteur');
Route::permanentRedirect('/en/motor-catamaran.html', '/en/boats?type=catamaran-a-moteur');

Route::permanentRedirect('/en/buy/fishing-boat.html', '/en/boats?type=bateau-de-peche');
Route::permanentRedirect('/en/buy/fishing-boat', '/en/boats?type=bateau-de-peche');
Route::permanentRedirect('/en/fishing-boat.html', '/en/boats?type=bateau-de-peche');

Route::permanentRedirect('/en/buy/light-sail-boat.html', '/en/boats');
Route::permanentRedirect('/en/buy/light-sail-boat', '/en/boats');
Route::permanentRedirect('/en/light-sail-boat.html', '/en/boats');

Route::permanentRedirect('/en/buy/buy-sailboat.html', '/en/boats?type=voilier-monocoque');
Route::permanentRedirect('/en/buy/buy-sailboat', '/en/boats?type=voilier-monocoque');
Route::permanentRedirect('/en/buy-sailboat.html', '/en/boats?type=voilier-monocoque');

Route::permanentRedirect('/en/buy/new-boat.html', '/en/boats?occasion=0');
Route::permanentRedirect('/en/buy/new-boat', '/en/boats?occasion=0');
Route::permanentRedirect('/en/new-boat.html', '/en/boats?occasion=0');

Route::permanentRedirect('/en/buy.html', '/en/boats');
Route::permanentRedirect('/en/buy', '/en/boats');

// Pages statiques en anglais -> Nouvelles URLs localisées
Route::permanentRedirect('/en/contact.html', '/en/contact');
// Note: /en/contact est maintenant géré par Laravel Localization

Route::permanentRedirect('/en/sell-boat.html', '/en/sell');
Route::permanentRedirect('/en/sell-boat', '/en/sell');

Route::permanentRedirect('/en/boat-license.html', '/en/articles');
Route::permanentRedirect('/en/boat-license', '/en/articles');

Route::permanentRedirect('/en/good-boat-selling.html', '/en/sell');
Route::permanentRedirect('/en/good-boat-selling', '/en/sell');

Route::permanentRedirect('/en/boat-types.html', '/en/categories');
Route::permanentRedirect('/en/boat-types', '/en/categories');

Route::permanentRedirect('/en/legalmentions.html', '/en/legal-notice');
Route::permanentRedirect('/en/legalmentions', '/en/legal-notice');

Route::permanentRedirect('/en/sitemap.html', '/en');
Route::permanentRedirect('/en/sitemap', '/en');

Route::permanentRedirect('/en/confirmation.html', '/en');
Route::permanentRedirect('/en/confirmation', '/en');

Route::permanentRedirect('/en/boat-maintenance-and-after-sales-service.html', '/en');
Route::permanentRedirect('/en/boat-maintenance-and-after-sales-service', '/en');

// Bateaux en anglais - OLD URLs (.html) vers nouvelles URLs localisées
Route::get('/en/boat/{slug}', function ($slug) {
    $slug = preg_replace('/\.html$/', '', $slug);
    $bateau = \App\Models\Bateau::where('slug', 'LIKE', $slug . '%')->first();
    if ($bateau) {
        return redirect('/en/boats/' . $bateau->slug, 301);
    }
    return redirect('/en/boats', 301);
})->where('slug', '.*');

Route::get('/en/buy/boat/{slug}', function ($slug) {
    $slug = preg_replace('/\.html$/', '', $slug);
    $bateau = \App\Models\Bateau::where('slug', 'LIKE', $slug . '%')->first();
    if ($bateau) {
        return redirect('/en/boats/' . $bateau->slug, 301);
    }
    return redirect('/en/boats', 301);
})->where('slug', '.*');

// Note: Le catch-all /en/{any} a été supprimé car /en/boats, /en/categories, etc.
// sont maintenant des routes valides gérées par Laravel Localization

// ==========================================
// REDIRECTIONS URLs MULTILINGUES SANS PRÉFIXE DE LANGUE
// Redirige /boats vers /en/boats, /boote vers /de/boote, etc.
// ==========================================

// URLs anglaises sans préfixe -> /en/...
Route::permanentRedirect('/boats', '/en/boats');
Route::permanentRedirect('/about', '/en/about');
Route::permanentRedirect('/sell', '/en/sell');
Route::permanentRedirect('/articles', '/en/articles');
Route::permanentRedirect('/legal-notice', '/en/legal-notice');
Route::permanentRedirect('/terms', '/en/terms');
Route::permanentRedirect('/privacy', '/en/privacy');
Route::permanentRedirect('/partners', '/en/partners');

// URLs allemandes sans préfixe -> /de/...
Route::permanentRedirect('/boote', '/de/boote');
Route::permanentRedirect('/uber-uns', '/de/uber-uns');
Route::permanentRedirect('/verkaufen', '/de/verkaufen');
Route::permanentRedirect('/kategorien', '/de/kategorien');
Route::permanentRedirect('/artikel', '/de/artikel');
Route::permanentRedirect('/impressum', '/de/impressum');
Route::permanentRedirect('/agb', '/de/agb');
Route::permanentRedirect('/datenschutz', '/de/datenschutz');

// URLs espagnoles sans préfixe -> /es/...
Route::permanentRedirect('/barcos', '/es/barcos');
Route::permanentRedirect('/sobre-nosotros', '/es/sobre-nosotros');
Route::permanentRedirect('/vender', '/es/vender');
Route::permanentRedirect('/categorias', '/es/categorias');
Route::permanentRedirect('/articulos', '/es/articulos');
Route::permanentRedirect('/aviso-legal', '/es/aviso-legal');
Route::permanentRedirect('/terminos', '/es/terminos');
Route::permanentRedirect('/privacidad', '/es/privacidad');

// URLs néerlandaises sans préfixe -> /nl/...
Route::permanentRedirect('/boten', '/nl/boten');
Route::permanentRedirect('/over-ons', '/nl/over-ons');
Route::permanentRedirect('/verkopen', '/nl/verkopen');
Route::permanentRedirect('/categorieen', '/nl/categorieen');
Route::permanentRedirect('/artikelen', '/nl/artikelen');
Route::permanentRedirect('/juridisch', '/nl/juridisch');
Route::permanentRedirect('/voorwaarden', '/nl/voorwaarden');
Route::permanentRedirect('/privacybeleid', '/nl/privacybeleid');

// ==========================================
// NETTOYAGE DES ASSETS - ANCIEN DOSSIER UPLOADS
// Redirection globale pour les images de l'ancien site
// ==========================================

Route::any('/uploads/{path?}', function () {
    return redirect('/', 301);
})->where('path', '.*');

// Ancien dossier media/images
Route::any('/media/{path?}', function () {
    return redirect('/', 301);
})->where('path', '.*');

// Ancien dossier assets
Route::any('/assets/images/{path?}', function () {
    return redirect('/', 301);
})->where('path', '.*');

// ==========================================
// FALLBACK DYNAMIQUE POUR LES URLs PROFONDES
// Capture /acheter/{categorie}/{slug} non mappes
// ==========================================

Route::get('/acheter/{category}/{slug}', function ($category, $slug) {
    // Enlever l'extension .html si presente
    $slug = preg_replace('/\.html$/', '', $slug);

    // Chercher le bateau correspondant
    $bateau = \App\Models\Bateau::where('slug', 'LIKE', $slug . '%')->first();

    if ($bateau) {
        return redirect('/bateaux/' . $bateau->slug, 301);
    }

    // Fallback vers la liste filtree par type
    $typeMapping = [
        'monocoque' => 'voilier-monocoque',
        'multicoques' => 'catamaran-a-voile',
        'multihull' => 'catamaran-a-voile',
        'catamaran' => 'catamaran-a-voile',
        'bateau-moteur' => 'bateau-moteur',
        'motor-boat' => 'bateau-moteur',
        'voilier' => 'voilier-monocoque',
    ];

    $type = $typeMapping[$category] ?? null;

    if ($type) {
        return redirect('/bateaux?type=' . $type, 301);
    }

    return redirect('/bateaux', 301);
})->where('slug', '.*');

// ==========================================
// CATCH-ALL POUR LES ANCIENNES URLs .html
// ==========================================

Route::get('/{path}.html', function ($path) {
    // Verifier si c'est une URL de bateau
    if (str_starts_with($path, 'bateau/')) {
        $slug = str_replace('bateau/', '', $path);
        $bateau = \App\Models\Bateau::where('slug', 'LIKE', $slug . '%')->first();
        if ($bateau) {
            return redirect('/bateaux/' . $bateau->slug, 301);
        }
    }

    // Sinon rediriger vers l'accueil
    return redirect('/', 301);
})->where('path', '.*');
