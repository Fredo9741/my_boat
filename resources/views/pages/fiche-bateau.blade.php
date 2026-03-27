<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Déposer mon bateau – MyBoat Océan Indien</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-myboat.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            font-size: 14px;
            background: #f0f9ff;
            color: #1e293b;
            padding-bottom: 80px;
        }

        /* ── HEADER ── */
        .header {
            background: linear-gradient(135deg, #0369a1, #0ea5e9);
            color: #fff;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 12px rgba(3,105,161,.3);
        }
        .header img { height: 44px; filter: brightness(0) invert(1); }
        .header-text h1 { font-size: 20px; font-weight: 800; }
        .header-text p { font-size: 12px; opacity: .85; margin-top: 2px; }

        /* ── SAVE BANNER ── */
        .save-banner {
            background: #dcfce7;
            border-bottom: 2px solid #86efac;
            padding: 8px 24px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #166534;
        }
        .save-banner i { color: #16a34a; }

        /* ── CONTAINER ── */
        .container { max-width: 860px; margin: 0 auto; padding: 24px 16px; }

        /* ── SECTIONS ── */
        .section {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 1px 6px rgba(0,0,0,.08);
            margin-bottom: 20px;
            overflow: hidden;
        }
        .section-title {
            background: #0ea5e9;
            color: #fff;
            padding: 10px 18px;
            font-weight: 700;
            font-size: 13px;
            letter-spacing: .4px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .section-body { padding: 18px; }

        /* ── GRID ── */
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 14px; }
        .grid-4 { display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 14px; }
        .col-2 { grid-column: span 2; }
        .col-3 { grid-column: span 3; }
        .col-4 { grid-column: span 4; }
        @media(max-width:640px) {
            .grid-2,.grid-3,.grid-4 { grid-template-columns: 1fr 1fr; }
            .col-3,.col-4 { grid-column: span 2; }
        }
        @media(max-width:400px) {
            .grid-2,.grid-3,.grid-4 { grid-template-columns: 1fr; }
            .col-2,.col-3,.col-4 { grid-column: span 1; }
        }

        /* ── FIELD ── */
        .field { display: flex; flex-direction: column; gap: 5px; }
        .field label {
            font-size: 11px;
            font-weight: 700;
            color: #475569;
            text-transform: uppercase;
            letter-spacing: .3px;
        }
        .field label .req { color: #ef4444; margin-left: 2px; }
        .field input[type="text"],
        .field input[type="email"],
        .field input[type="tel"],
        .field input[type="number"],
        .field select,
        .field textarea {
            border: 1.5px solid #cbd5e1;
            border-radius: 7px;
            padding: 9px 12px;
            font-size: 14px;
            font-family: inherit;
            color: #1e293b;
            background: #f8fafc;
            transition: border-color .2s, box-shadow .2s;
            width: 100%;
        }
        .field input:focus,
        .field select:focus,
        .field textarea:focus {
            border-color: #0ea5e9;
            box-shadow: 0 0 0 3px rgba(14,165,233,.15);
            outline: none;
            background: #fff;
        }
        .field textarea { resize: vertical; min-height: 90px; }
        .field .hint { font-size: 11px; color: #94a3b8; }

        /* ── RADIO / CHECK INLINE ── */
        .radio-group, .check-inline {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 2px;
        }
        .radio-group label, .check-inline label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 400;
            text-transform: none;
            letter-spacing: 0;
            cursor: pointer;
            padding: 6px 12px;
            border: 1.5px solid #cbd5e1;
            border-radius: 20px;
            transition: all .2s;
            color: #334155;
        }
        .radio-group label:has(input:checked),
        .check-inline label:has(input:checked) {
            border-color: #0ea5e9;
            background: #e0f2fe;
            color: #0369a1;
            font-weight: 600;
        }
        .radio-group input, .check-inline input { display: none; }

        /* ── EQUIPEMENTS ── */
        .equip-category { margin-bottom: 16px; }
        .equip-category-title {
            font-size: 12px;
            font-weight: 700;
            color: #0369a1;
            text-transform: uppercase;
            letter-spacing: .3px;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 5px;
            margin-bottom: 8px;
        }
        .equip-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(170px, 1fr));
            gap: 6px;
        }
        .equip-grid label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 6px 10px;
            border: 1.5px solid #e2e8f0;
            border-radius: 8px;
            cursor: pointer;
            font-size: 12px;
            font-weight: 400;
            text-transform: none;
            letter-spacing: 0;
            color: #334155;
            transition: all .15s;
        }
        .equip-grid label:has(input:checked) {
            border-color: #0ea5e9;
            background: #e0f2fe;
            color: #0369a1;
            font-weight: 600;
        }
        .equip-grid input { display: none; }
        .equip-grid .cb-icon {
            width: 16px;
            height: 16px;
            border: 2px solid #cbd5e1;
            border-radius: 4px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: transparent;
            transition: all .15s;
        }
        .equip-grid label:has(input:checked) .cb-icon {
            background: #0ea5e9;
            border-color: #0ea5e9;
            color: #fff;
        }

        /* ── PHOTOS WHATSAPP BOX ── */
        .photos-box {
            background: #f0fdf4;
            border: 2px dashed #86efac;
            border-radius: 10px;
            padding: 16px;
            text-align: center;
        }
        .photos-box p { color: #166534; font-size: 13px; margin-bottom: 10px; }
        .wa-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #25d366;
            color: #fff;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 700;
            font-size: 14px;
            text-decoration: none;
            transition: background .2s;
        }
        .wa-btn:hover { background: #1ebe5d; }

        /* ── STICKY BOTTOM BAR ── */
        .bottom-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #fff;
            border-top: 2px solid #e2e8f0;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            box-shadow: 0 -4px 20px rgba(0,0,0,.1);
            z-index: 100;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 22px;
            border-radius: 8px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            border: none;
            text-decoration: none;
            transition: all .2s;
        }
        .btn-primary { background: #0ea5e9; color: #fff; }
        .btn-primary:hover { background: #0284c7; }
        .btn-secondary { background: #f1f5f9; color: #475569; border: 1.5px solid #cbd5e1; }
        .btn-secondary:hover { background: #e2e8f0; }
        .btn-danger { background: #fee2e2; color: #dc2626; border: 1.5px solid #fca5a5; }
        .btn-danger:hover { background: #fecaca; }
        .btn-wa { background: #25d366; color: #fff; }
        .btn-wa:hover { background: #1ebe5d; }
        .btn-group { display: flex; gap: 8px; flex-wrap: wrap; }

        /* ── DIVIDER ── */
        .divider {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 14px 0;
        }

        /* ── TOAST ── */
        #toast {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #166534;
            color: #fff;
            padding: 12px 20px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            display: none;
            align-items: center;
            gap: 8px;
            z-index: 999;
            box-shadow: 0 4px 15px rgba(0,0,0,.2);
        }

        @media(max-width:600px) {
            .bottom-bar { flex-direction: column; align-items: stretch; }
            .btn-group { justify-content: stretch; }
            .btn { justify-content: center; }
        }
    </style>
</head>
<body>

<!-- TOAST -->
<div id="toast"><i class="fas fa-check-circle"></i> <span id="toast-msg">Sauvegardé !</span></div>

<!-- HEADER -->
<div class="header">
    <img src="{{ asset('images/logo-myboat.svg') }}" alt="MyBoat" onerror="this.style.display='none'">
    <div class="header-text">
        <h1>Déposer mon bateau</h1>
        <p>Remplissez ce formulaire — votre progression est sauvegardée automatiquement</p>
    </div>
</div>

<!-- SENT BANNER (affiché si formulaire déjà envoyé) -->
<div id="sent-banner" style="display:none;background:#fefce8;border-bottom:2px solid #fde047;padding:10px 24px;align-items:center;gap:12px;flex-wrap:wrap;">
    <i class="fas fa-circle-check" style="color:#ca8a04;font-size:18px;flex-shrink:0;"></i>
    <span style="font-size:13px;color:#854d0e;flex:1;"><strong>Formulaire envoyé !</strong> N'oubliez pas d'envoyer vos photos par WhatsApp.</span>
    <a href="https://wa.me/262692706610?text=Bonjour%2C%20je%20viens%20d'envoyer%20ma%20fiche%20bateau%20sur%20MyBoat.%20Voici%20mes%20photos."
       target="_blank"
       style="display:inline-flex;align-items:center;gap:7px;background:#25D366;color:#fff;text-decoration:none;padding:8px 16px;border-radius:8px;font-weight:700;font-size:13px;white-space:nowrap;">
        <i class="fab fa-whatsapp"></i> Envoyer les photos
    </a>
    <button onclick="newForm()" style="background:#fff;border:1.5px solid #d97706;color:#92400e;padding:7px 14px;border-radius:8px;font-size:12px;font-weight:600;cursor:pointer;white-space:nowrap;">
        Nouveau formulaire
    </button>
</div>

<!-- SAVE BANNER -->
<div id="save-banner" class="save-banner">
    <i class="fas fa-shield-alt"></i>
    Vos données sont <strong>sauvegardées dans votre navigateur</strong>. Vous pouvez fermer cette page et reprendre plus tard.
</div>

<form id="fiche-form" method="POST" action="{{ route('contact.send') }}" onsubmit="return prepareSubmit()">
@csrf
<input type="hidden" name="form_type" value="fiche_bateau">
<input type="hidden" id="h_nom" name="nom" value="">
<input type="hidden" id="h_email" name="email" value="">
<input type="hidden" id="h_tel" name="telephone" value="">
<textarea name="message" id="h_message" style="display:none"></textarea>

<div class="container">

    <!-- SECTION : VENDEUR -->
    <div class="section">
        <div class="section-title"><i class="fas fa-user"></i> Vos coordonnées</div>
        <div class="section-body">
            <div class="grid-2">
                <div class="field">
                    <label>Nom <span class="req">*</span></label>
                    <input type="text" id="vendeur_nom" placeholder="Votre nom de famille">
                </div>
                <div class="field">
                    <label>Prénom <span class="req">*</span></label>
                    <input type="text" id="vendeur_prenom" placeholder="Votre prénom">
                </div>
                <div class="field">
                    <label>Téléphone <span class="req">*</span></label>
                    <input type="tel" id="vendeur_tel" placeholder="+262 6XX XXX XXX">
                </div>
                <div class="field">
                    <label>WhatsApp</label>
                    <input type="tel" id="vendeur_wa" placeholder="+262 6XX XXX XXX (si différent)">
                </div>
                <div class="field col-2">
                    <label>Email <span class="req">*</span></label>
                    <input type="email" id="vendeur_email" placeholder="votre@email.com">
                </div>
                <div class="field col-2">
                    <label>Disponibilité pour visites</label>
                    <input type="text" id="vendeur_dispo" placeholder="Ex: en semaine après 17h, week-end matin...">
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION : INFOS GÉNÉRALES -->
    <div class="section">
        <div class="section-title"><i class="fas fa-anchor"></i> Informations générales</div>
        <div class="section-body">
            <div class="grid-2">
                <div class="field col-2">
                    <label>Modèle / Nom du bateau <span class="req">*</span></label>
                    <input type="text" id="modele" placeholder="Ex: Lagoon 420, Sun Odyssey 45, Iris 37...">
                </div>
                <div class="field">
                    <label>Type de bateau <span class="req">*</span></label>
                    <select id="type">
                        <option value="">-- Choisir --</option>
                        @foreach(\App\Models\Type::orderBy('libelle')->get() as $t)
                        <option value="{{ $t->libelle }}">{{ $t->libelle }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field">
                    <label>Zone / Localisation actuelle</label>
                    <select id="zone">
                        <option value="">-- Choisir --</option>
                        @foreach(\App\Models\Zone::orderBy('libelle')->get() as $z)
                        <option value="{{ $z->libelle }}">{{ $z->libelle }}</option>
                        @endforeach
                        <option value="Autre">Autre</option>
                    </select>
                </div>
                <div class="field">
                    <label>Prix demandé (€) <span class="req">*</span></label>
                    <input type="number" id="prix" placeholder="Ex: 45000" min="0">
                </div>
                <div class="field">
                    <label>Prix négociable ?</label>
                    <div class="radio-group">
                        <label><input type="radio" name="negociable" value="Oui"> Oui</label>
                        <label><input type="radio" name="negociable" value="Non"> Non</label>
                    </div>
                </div>
                <div class="field">
                    <label>État</label>
                    <div class="radio-group">
                        <label><input type="radio" name="occasion" value="Occasion"> Occasion</label>
                        <label><input type="radio" name="occasion" value="Neuf"> Neuf</label>
                    </div>
                </div>
                <div class="field">
                    <label>Afficher le prix sur l'annonce ?</label>
                    <div class="radio-group">
                        <label><input type="radio" name="afficher_prix" value="Oui" checked> Oui</label>
                        <label><input type="radio" name="afficher_prix" value="Non"> Non (sur demande)</label>
                    </div>
                </div>
                <div class="field col-2">
                    <label>Description <span class="req">*</span></label>
                    <textarea id="description" placeholder="Décrivez votre bateau : état général, historique, travaux récents, points forts, raison de la vente..."></textarea>
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION : CARACTÉRISTIQUES TECHNIQUES -->
    <div class="section">
        <div class="section-title"><i class="fas fa-cog"></i> Caractéristiques techniques</div>
        <div class="section-body">
            <div class="grid-3">
                <div class="field">
                    <label>Chantier constructeur</label>
                    <input type="text" id="chantier" placeholder="Ex: Lagoon, Jeanneau...">
                </div>
                <div class="field">
                    <label>Architecte naval</label>
                    <input type="text" id="architecte" placeholder="Ex: VPLP, Marc Lombard...">
                </div>
                <div class="field">
                    <label>Année de construction</label>
                    <input type="number" id="annee" placeholder="Ex: 2008" min="1900" max="{{ date('Y') + 1 }}">
                </div>
                <div class="field">
                    <label>Pavillon</label>
                    <input type="text" id="pavillon" placeholder="Ex: Français, Malgache...">
                </div>
                <div class="field">
                    <label>Matériaux de coque</label>
                    <input type="text" id="materiaux" placeholder="Ex: Polyester, Alu, Acier...">
                </div>
                <div class="field">
                    <label>Longueur hors tout (m)</label>
                    <input type="number" id="longueurht" placeholder="Ex: 12.60" step="0.01">
                </div>
                <div class="field">
                    <label>Largeur / Bau (m)</label>
                    <input type="number" id="largeur" placeholder="Ex: 6.90" step="0.01">
                </div>
                <div class="field">
                    <label>Tirant d'eau (m)</label>
                    <input type="number" id="tirantdeau" placeholder="Ex: 1.20" step="0.01">
                </div>
                <div class="field">
                    <label>Poids lège / en charges (kg)</label>
                    <input type="number" id="poids" placeholder="Ex: 8500" step="0.01">
                </div>
                <div class="field">
                    <label>Surface voilure au près (m²)</label>
                    <input type="number" id="surface" placeholder="Ex: 112" step="0.01">
                </div>
                <div class="field">
                    <label>Système anti-dérive</label>
                    <input type="text" id="antiderive" placeholder="Ex: Dérive pivotante, Quille fixe...">
                </div>
                <div class="field">
                    <label>Nombre de cabines</label>
                    <input type="number" id="cabines" placeholder="Ex: 4" min="0">
                </div>
                <div class="field">
                    <label>Capacité passagers</label>
                    <input type="number" id="passagers" placeholder="Ex: 10" min="0">
                </div>
            </div>

            <hr class="divider">
            <div style="font-size:12px;font-weight:700;color:#475569;text-transform:uppercase;margin-bottom:12px;"><i class="fas fa-wrench mr-1"></i> Motorisation</div>
            <div class="grid-4">
                <div class="field col-2">
                    <label>Marque / Modèle moteur</label>
                    <input type="text" id="moteur" placeholder="Ex: Yanmar 4JH45, Volvo D2-55...">
                </div>
                <div class="field">
                    <label>Nombre de moteurs</label>
                    <input type="number" id="nb_moteurs" placeholder="Ex: 2" min="0">
                </div>
                <div class="field">
                    <label>Puissance (CV)</label>
                    <input type="number" id="puissance" placeholder="Ex: 55" min="0">
                </div>
                <div class="field">
                    <label>Heures moteur</label>
                    <input type="number" id="heures" placeholder="Ex: 1200" min="0">
                </div>
                <div class="field col-3">
                    <label>Observations moteur</label>
                    <input type="text" id="obs_moteur" placeholder="Révisions, travaux récents, état...">
                </div>
            </div>
        </div>
    </div>

    <!-- SECTION : ÉQUIPEMENTS -->
    <div class="section">
        <div class="section-title"><i class="fas fa-list-check"></i> Équipements à bord</div>
        <div class="section-body">
            @php
                $catLabels = [
                    'navigation'   => ['icon' => 'fas fa-compass',       'label' => 'Navigation'],
                    'electronique' => ['icon' => 'fas fa-satellite-dish', 'label' => 'Électronique'],
                    'securite'     => ['icon' => 'fas fa-shield-alt',     'label' => 'Sécurité'],
                    'manoeuvre'    => ['icon' => 'fas fa-anchor',         'label' => 'Manœuvre'],
                    'confort'      => ['icon' => 'fas fa-couch',          'label' => 'Confort'],
                    'loisirs'      => ['icon' => 'fas fa-fish',           'label' => 'Loisirs'],
                ];
            @endphp

            @foreach($equipements as $categorie => $items)
            @php $cat = $catLabels[$categorie] ?? ['icon' => 'fas fa-check', 'label' => ucfirst($categorie)]; @endphp
            <div class="equip-category">
                <div class="equip-category-title">
                    <i class="{{ $cat['icon'] }}"></i> {{ $cat['label'] }}
                </div>
                <div class="equip-grid">
                    @foreach($items as $eq)
                    <label>
                        <input type="checkbox" class="equip-cb" data-id="{{ $eq->id }}" data-label="{{ $eq->libelle }}">
                        <span class="cb-icon"><i class="fas fa-check" style="font-size:9px;"></i></span>
                        {{ $eq->libelle }}
                    </label>
                    @endforeach
                </div>
            </div>
            @endforeach

            <div class="field" style="margin-top:8px;">
                <label>Autres équipements non listés</label>
                <input type="text" id="autres_equip" placeholder="Ex: Radar couleur, guindeau hydraulique, bimini sur mesure...">
            </div>
        </div>
    </div>

    <!-- SECTION : PHOTOS -->
    <div class="section">
        <div class="section-title"><i class="fas fa-camera"></i> Photos du bateau</div>
        <div class="section-body">
            <div style="background:#f0fdf4;border:1.5px solid #86efac;border-radius:8px;padding:14px 18px;display:flex;align-items:flex-start;gap:14px;">
                <i class="fas fa-circle-info" style="color:#16a34a;font-size:20px;flex-shrink:0;margin-top:2px;"></i>
                <div>
                    <p style="margin:0 0 4px;font-weight:700;color:#166534;">Les photos seront demandées après l'envoi du formulaire.</p>
                    <p style="margin:0;font-size:12px;color:#166534;">Idéalement : extérieur tribord/bâbord, proue, poupe, cockpit, carré, cabines, moteur.</p>
                </div>
            </div>

            <div class="field" style="margin-top:14px;">
                <label>Lien vidéo YouTube (optionnel)</label>
                <input type="text" id="video" placeholder="https://www.youtube.com/watch?v=...">
            </div>
        </div>
    </div>

    <!-- SECTION : DOCUMENTS -->
    <div class="section">
        <div class="section-title"><i class="fas fa-file-alt"></i> Documents disponibles</div>
        <div class="section-body">
            <div class="check-inline">
                @foreach([
                    'Acte de francisation',
                    "Certificat d'immatriculation",
                    'Expertise / Survey récent',
                    'Carnet entretien moteur',
                    'Inventaire complet',
                    'Assurance en cours',
                    'Certificat de jauge',
                    'Factures travaux récents',
                    'Plans / Documentation technique',
                ] as $doc)
                <label>
                    <input type="checkbox" class="doc-cb" data-label="{{ $doc }}">
                    <i class="fas fa-check" style="font-size:10px;"></i> {{ $doc }}
                </label>
                @endforeach
            </div>
            <div class="field" style="margin-top:12px;">
                <label>Remarques / informations complémentaires</label>
                <textarea id="remarques" placeholder="Tout ce qui vous semble utile à préciser..."></textarea>
            </div>
        </div>
    </div>

    <!-- SECTION : ENGAGEMENT -->
    <div class="section">
        <div class="section-title"><i class="fas fa-handshake"></i> Engagement MyBoat-OI</div>
        <div class="section-body">
            <p style="font-size:13px;color:#475569;margin-bottom:16px;">
                En confiant votre bateau à MyBoat Océan Indien, vous bénéficiez des engagements suivants :
            </p>
            <div style="display:flex;flex-direction:column;gap:12px;">

                <label style="display:flex;align-items:flex-start;gap:12px;cursor:pointer;padding:12px 14px;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:8px;">
                    <input type="checkbox" id="eng_suivi" checked style="margin-top:2px;width:17px;height:17px;accent-color:#0ea5e9;flex-shrink:0;">
                    <span style="font-size:13px;color:#1e293b;line-height:1.5;">
                        <strong>Suivi personnalisé</strong> — Je m'engage à faire régulièrement un point avec le propriétaire sur les demandes reçues et l'avancement de la vente.
                    </span>
                </label>

                <label style="display:flex;align-items:flex-start;gap:12px;cursor:pointer;padding:12px 14px;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:8px;">
                    <input type="checkbox" id="eng_pub" checked style="margin-top:2px;width:17px;height:17px;accent-color:#0ea5e9;flex-shrink:0;">
                    <span style="font-size:13px;color:#1e293b;line-height:1.5;">
                        <strong>Promotion active</strong> — Je m'engage à diffuser l'annonce et à assurer la publicité du bateau auprès de mon réseau et sur la plateforme MyBoat Océan Indien.
                    </span>
                </label>

                <label style="display:flex;align-items:flex-start;gap:12px;cursor:pointer;padding:12px 14px;background:#f8fafc;border:1.5px solid #e2e8f0;border-radius:8px;">
                    <input type="checkbox" id="eng_commission" checked style="margin-top:2px;width:17px;height:17px;accent-color:#0ea5e9;flex-shrink:0;">
                    <span style="font-size:13px;color:#1e293b;line-height:1.5;">
                        <strong>Commission transparente</strong> — La commission de MyBoat-OI est de <strong>5 % maximum</strong> sur le prix de vente, uniquement en cas de vente conclue avec un prospect apporté par MyBoat-OI. Aucun frais si le bateau ne se vend pas.
                    </span>
                </label>

            </div>
        </div>
    </div>

</div>
</form>

<!-- STICKY BOTTOM BAR -->
<div class="bottom-bar">
    <button type="button" class="btn btn-danger" onclick="confirmReset()">
        <i class="fas fa-trash"></i> <span class="hidden-mobile">Effacer tout</span>
    </button>
    <button type="submit" form="fiche-form" class="btn btn-secondary">
        <i class="fas fa-paper-plane"></i> Envoyer le formulaire
    </button>
</div>

<script>
// ═══════════════════════════════════════════════
//  CHAMPS TEXTE / SELECT / NUMBER
// ═══════════════════════════════════════════════
const TEXT_FIELDS = [
    'vendeur_nom','vendeur_prenom','vendeur_tel','vendeur_wa','vendeur_email','vendeur_dispo',
    'modele','type','zone','prix','description',
    'chantier','architecte','annee','pavillon','materiaux',
    'longueurht','largeur','tirantdeau','poids','surface','antiderive','cabines','passagers',
    'moteur','nb_moteurs','puissance','heures','obs_moteur',
    'autres_equip','video','remarques',
];

// ── Charger depuis localStorage ──
function loadForm() {
    const saved = JSON.parse(localStorage.getItem('myboat_fiche') || '{}');

    TEXT_FIELDS.forEach(id => {
        const el = document.getElementById(id);
        if (el && saved[id] !== undefined) el.value = saved[id];
    });

    // Radios
    ['negociable','occasion','afficher_prix'].forEach(name => {
        if (saved[name]) {
            const radio = document.querySelector(`input[name="${name}"][value="${saved[name]}"]`);
            if (radio) radio.checked = true;
        }
    });

    // Équipements
    if (saved.equip_ids) {
        saved.equip_ids.forEach(id => {
            const cb = document.querySelector(`.equip-cb[data-id="${id}"]`);
            if (cb) cb.checked = true;
        });
    }

    // Documents
    if (saved.docs) {
        saved.docs.forEach(label => {
            const cb = document.querySelector(`.doc-cb[data-label="${label}"]`);
            if (cb) cb.checked = true;
        });
    }

    // Engagements
    ['eng_suivi','eng_pub','eng_commission'].forEach(id => {
        const el = document.getElementById(id);
        if (el && saved[id]) el.checked = true;
    });
}

// ── Sauvegarder dans localStorage ──
function saveForm() {
    const data = {};

    TEXT_FIELDS.forEach(id => {
        const el = document.getElementById(id);
        if (el) data[id] = el.value;
    });

    ['negociable','occasion','afficher_prix'].forEach(name => {
        const checked = document.querySelector(`input[name="${name}"]:checked`);
        data[name] = checked ? checked.value : '';
    });

    data.equip_ids   = [...document.querySelectorAll('.equip-cb:checked')].map(cb => cb.dataset.id);
    data.docs        = [...document.querySelectorAll('.doc-cb:checked')].map(cb => cb.dataset.label);
    data.eng_suivi      = document.getElementById('eng_suivi')?.checked || false;
    data.eng_pub        = document.getElementById('eng_pub')?.checked || false;
    data.eng_commission = document.getElementById('eng_commission')?.checked || false;

    localStorage.setItem('myboat_fiche', JSON.stringify(data));
    showToast('Progression sauvegardée !');
}

// ── Écouter tous les changements ──
document.addEventListener('DOMContentLoaded', function() {
    // Bandeau "formulaire envoyé" persistant
    if (localStorage.getItem('myboat_fiche_sent') === '1') {
        document.getElementById('sent-banner').style.display = 'flex';
        document.getElementById('save-banner').style.display = 'none';
    }

    loadForm();

    TEXT_FIELDS.forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener('input', debounce(saveForm, 600));
    });

    document.querySelectorAll('input[type="radio"], .equip-cb, .doc-cb, #eng_suivi, #eng_pub, #eng_commission').forEach(el => {
        el.addEventListener('change', saveForm);
    });
});

// ═══════════════════════════════════════════════
//  COLLECTE DES DONNÉES
// ═══════════════════════════════════════════════
function collectData() {
    const g = id => (document.getElementById(id)?.value || '').trim();
    const r = name => document.querySelector(`input[name="${name}"]:checked`)?.value || '';

    const equips = [...document.querySelectorAll('.equip-cb:checked')].map(cb => cb.dataset.label);
    const docs   = [...document.querySelectorAll('.doc-cb:checked')].map(cb => cb.dataset.label);

    return { g, r, equips, docs };
}

// ── Valider les champs obligatoires ──
function validate() {
    const { g } = collectData();
    const missing = [];
    if (!g('vendeur_tel')) missing.push('Téléphone');
    if (!g('modele'))      missing.push('Modèle du bateau');
    return missing;
}

// ── Formater le message complet ──
function buildMessage() {
    const { g, r, equips, docs } = collectData();

    let msg = `🚢 DEMANDE DE MISE EN ANNONCE – MyBoat Océan Indien\n`;
    msg += `${'─'.repeat(45)}\n\n`;

    msg += `👤 VENDEUR\n`;
    msg += `Nom & Prénom : ${g('vendeur_prenom')} ${g('vendeur_nom')}\n`;
    msg += `Téléphone    : ${g('vendeur_tel')}\n`;
    if (g('vendeur_wa'))    msg += `WhatsApp     : ${g('vendeur_wa')}\n`;
    msg += `Email        : ${g('vendeur_email')}\n`;
    if (g('vendeur_dispo')) msg += `Disponibilité: ${g('vendeur_dispo')}\n`;

    msg += `\n🚢 BATEAU\n`;
    msg += `Modèle       : ${g('modele')}\n`;
    if (g('type'))  msg += `Type         : ${g('type')}\n`;
    if (g('zone'))  msg += `Localisation : ${g('zone')}\n`;
    msg += `Prix         : ${g('prix') ? Number(g('prix')).toLocaleString('fr') + ' €' : '—'}\n`;
    if (r('negociable'))    msg += `Négociable   : ${r('negociable')}\n`;
    if (r('occasion'))      msg += `État         : ${r('occasion')}\n`;
    if (r('afficher_prix')) msg += `Afficher prix: ${r('afficher_prix')}\n`;
    msg += `\nDescription :\n${g('description')}\n`;

    const specs = [
        ['Chantier', g('chantier')], ['Architecte', g('architecte')], ['Année', g('annee')],
        ['Pavillon', g('pavillon')], ['Matériaux', g('materiaux')],
        ['Longueur HT', g('longueurht') ? g('longueurht') + ' m' : ''],
        ['Largeur', g('largeur') ? g('largeur') + ' m' : ''],
        ['Tirant d\'eau', g('tirantdeau') ? g('tirantdeau') + ' m' : ''],
        ['Poids', g('poids') ? g('poids') + ' kg' : ''],
        ['Surface voilure', g('surface') ? g('surface') + ' m²' : ''],
        ['Anti-dérive', g('antiderive')], ['Cabines', g('cabines')], ['Passagers', g('passagers')],
    ].filter(([, v]) => v);

    if (specs.length) {
        msg += `\n⚙️ CARACTÉRISTIQUES\n`;
        specs.forEach(([k, v]) => msg += `${k.padEnd(15)}: ${v}\n`);
    }

    const motor = [
        ['Moteur', g('moteur')], ['Nb moteurs', g('nb_moteurs')],
        ['Puissance', g('puissance') ? g('puissance') + ' CV' : ''],
        ['Heures moteur', g('heures') ? g('heures') + ' h' : ''],
        ['Observations', g('obs_moteur')],
    ].filter(([, v]) => v);

    if (motor.length) {
        msg += `\n🔧 MOTORISATION\n`;
        motor.forEach(([k, v]) => msg += `${k.padEnd(15)}: ${v}\n`);
    }

    if (equips.length) {
        msg += `\n✅ ÉQUIPEMENTS\n${equips.join(' · ')}\n`;
    }
    if (g('autres_equip')) msg += `Autres : ${g('autres_equip')}\n`;

    if (docs.length) {
        msg += `\n📄 DOCUMENTS DISPONIBLES\n${docs.join(' · ')}\n`;
    }

    if (g('video')) msg += `\n🎥 Vidéo : ${g('video')}\n`;
    if (g('remarques')) msg += `\n💬 Remarques :\n${g('remarques')}\n`;

    const engagements = [];
    if (document.getElementById('eng_suivi')?.checked)      engagements.push('Suivi personnalisé');
    if (document.getElementById('eng_pub')?.checked)        engagements.push('Promotion active');
    if (document.getElementById('eng_commission')?.checked) engagements.push('Commission 5% max acceptée');
    if (engagements.length) msg += `\n🤝 ENGAGEMENTS ACCEPTÉS\n${engagements.join(' · ')}\n`;

    msg += `\n${'─'.repeat(45)}\nFormulaire envoyé depuis myboat-oi.com`;
    return msg;
}

// ═══════════════════════════════════════════════
//  ENVOI
// ═══════════════════════════════════════════════
function prepareSubmit() {
    const missing = validate();
    if (missing.length) {
        alert('Champs obligatoires manquants :\n• ' + missing.join('\n• '));
        return false;
    }
    const { g } = collectData();
    document.getElementById('h_nom').value     = (g('vendeur_prenom') + ' ' + g('vendeur_nom')).trim();
    document.getElementById('h_email').value   = g('vendeur_email');
    document.getElementById('h_tel').value     = g('vendeur_tel');
    document.getElementById('h_message').value = buildMessage();
    return true;
}

// ═══════════════════════════════════════════════
//  RESET
// ═══════════════════════════════════════════════
function confirmReset() {
    if (confirm('Effacer tous les champs et repartir de zéro ?')) {
        localStorage.removeItem('myboat_fiche');
        localStorage.removeItem('myboat_fiche_sent');
        location.reload();
    }
}

function newForm() {
    localStorage.removeItem('myboat_fiche');
    localStorage.removeItem('myboat_fiche_sent');
    location.reload();
}

// ═══════════════════════════════════════════════
//  UTILITAIRES
// ═══════════════════════════════════════════════
function showToast(msg) {
    const toast = document.getElementById('toast');
    document.getElementById('toast-msg').textContent = msg;
    toast.style.display = 'flex';
    setTimeout(() => toast.style.display = 'none', 2500);
}

function debounce(fn, delay) {
    let t;
    return (...args) => { clearTimeout(t); t = setTimeout(() => fn(...args), delay); };
}
</script>

@if(session('success'))
<script>
    localStorage.setItem('myboat_fiche_sent', '1');
</script>
<div id="success-overlay" style="position:fixed;inset:0;background:rgba(0,0,0,.55);z-index:1000;display:flex;align-items:center;justify-content:center;padding:16px;">
    <div style="background:#fff;border-radius:16px;max-width:480px;width:100%;padding:32px 28px;text-align:center;box-shadow:0 20px 60px rgba(0,0,0,.25);">
        <div style="width:64px;height:64px;background:#dcfce7;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
            <i class="fas fa-check" style="font-size:28px;color:#16a34a;"></i>
        </div>
        <h2 style="font-size:20px;font-weight:800;color:#1e293b;margin-bottom:8px;">Formulaire envoyé !</h2>
        <p style="color:#475569;font-size:14px;margin-bottom:20px;">
            Nous avons bien reçu votre demande.<br>
            Il ne reste plus qu'à nous envoyer les <strong>photos de votre bateau</strong> directement par WhatsApp.
        </p>
        <p style="font-size:12px;color:#94a3b8;margin-bottom:20px;">
            Idéalement : extérieur tribord/bâbord, proue, poupe, cockpit, carré, cabines, moteur.
        </p>
        <a href="https://wa.me/262692706610?text=Bonjour%2C%20je%20viens%20d'envoyer%20ma%20fiche%20bateau%20sur%20MyBoat.%20Voici%20mes%20photos."
           target="_blank"
           style="display:inline-flex;align-items:center;gap:10px;background:#25D366;color:#fff;text-decoration:none;padding:13px 24px;border-radius:10px;font-weight:700;font-size:15px;margin-bottom:12px;">
            <i class="fab fa-whatsapp" style="font-size:20px;"></i> Envoyer mes photos par WhatsApp
        </a>
        <br>
        <button onclick="document.getElementById('success-overlay').remove()"
                style="background:none;border:none;color:#94a3b8;font-size:13px;cursor:pointer;margin-top:8px;text-decoration:underline;">
            Fermer
        </button>
    </div>
</div>
@endif

</body>
</html>
