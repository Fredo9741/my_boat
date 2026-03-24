<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche de renseignement – MyBoat Océan Indien</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: Arial, sans-serif;
            font-size: 11px;
            color: #1a1a1a;
            background: #fff;
            padding: 20px;
        }

        /* ── HEADER ── */
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 3px solid #0ea5e9;
            padding-bottom: 12px;
            margin-bottom: 18px;
        }
        .header img { height: 48px; }
        .header-right { text-align: right; }
        .header-right h1 { font-size: 18px; font-weight: 800; color: #0ea5e9; }
        .header-right p { font-size: 10px; color: #666; margin-top: 2px; }

        /* ── SECTIONS ── */
        .section {
            border: 1px solid #d1d5db;
            border-radius: 6px;
            margin-bottom: 14px;
            overflow: hidden;
        }
        .section-title {
            background: #0ea5e9;
            color: #fff;
            font-size: 11px;
            font-weight: 700;
            padding: 6px 12px;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        .section-body { padding: 12px; }

        /* ── GRID ── */
        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 10px; }
        .grid-4 { display: grid; grid-template-columns: 1fr 1fr 1fr 1fr; gap: 10px; }
        .col-span-2 { grid-column: span 2; }
        .col-span-3 { grid-column: span 3; }
        .col-span-4 { grid-column: span 4; }

        /* ── CHAMP ── */
        .field { display: flex; flex-direction: column; }
        .field label {
            font-size: 9px;
            font-weight: 700;
            color: #374151;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 3px;
        }
        .field label .req { color: #ef4444; }
        .field .line {
            border-bottom: 1.5px solid #9ca3af;
            height: 22px;
            width: 100%;
        }
        .field .box {
            border: 1.5px solid #9ca3af;
            border-radius: 3px;
            height: 60px;
            width: 100%;
        }
        .field .box-lg {
            border: 1.5px solid #9ca3af;
            border-radius: 3px;
            height: 90px;
            width: 100%;
        }

        /* ── CHECKBOXES ── */
        .check-group { margin-bottom: 10px; }
        .check-group-title {
            font-size: 10px;
            font-weight: 700;
            color: #0ea5e9;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 3px;
            margin-bottom: 6px;
            text-transform: uppercase;
        }
        .check-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 4px 8px;
        }
        .check-item {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 10px;
        }
        .check-item .cb {
            width: 11px;
            height: 11px;
            border: 1.5px solid #9ca3af;
            border-radius: 2px;
            flex-shrink: 0;
        }

        /* ── INFOS VENDEUR ── */
        .vendeur-box {
            background: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 6px;
            padding: 10px 14px;
            margin-bottom: 14px;
        }
        .vendeur-box h3 {
            font-size: 11px;
            font-weight: 700;
            color: #0369a1;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        /* ── FOOTER ── */
        .footer {
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
            margin-top: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 9px;
            color: #9ca3af;
        }

        /* ── PRINT BUTTON (screen only) ── */
        .print-btn {
            position: fixed;
            bottom: 24px;
            right: 24px;
            background: #0ea5e9;
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(14,165,233,0.4);
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 999;
        }
        .print-btn:hover { background: #0284c7; }

        /* ── MEDIA PRINT ── */
        @media print {
            body { padding: 10px; font-size: 10px; }
            .print-btn { display: none; }
            .section { page-break-inside: avoid; }
            .header { margin-bottom: 12px; }
        }

        @page { margin: 12mm; size: A4; }
    </style>
</head>
<body>

<button class="print-btn" onclick="window.print()">
    🖨️ Imprimer / Enregistrer en PDF
</button>

<!-- HEADER -->
<div class="header">
    <img src="{{ asset('images/logo-myboat.svg') }}" alt="MyBoat Océan Indien" onerror="this.style.display='none'">
    <div class="header-right">
        <h1>Fiche de renseignement bateau</h1>
        <p>MyBoat Océan Indien · myboat-oi.com · +262 629 926 538</p>
        <p style="margin-top:4px;color:#9ca3af;">Date : _____ / _____ / 20_____</p>
    </div>
</div>

<!-- INFORMATIONS VENDEUR -->
<div class="vendeur-box">
    <h3>📋 Informations du vendeur</h3>
    <div class="grid-4" style="gap:10px;">
        <div class="field">
            <label>Nom <span class="req">*</span></label>
            <div class="line"></div>
        </div>
        <div class="field">
            <label>Prénom <span class="req">*</span></label>
            <div class="line"></div>
        </div>
        <div class="field">
            <label>Téléphone <span class="req">*</span></label>
            <div class="line"></div>
        </div>
        <div class="field">
            <label>Email <span class="req">*</span></label>
            <div class="line"></div>
        </div>
        <div class="field col-span-2">
            <label>Adresse / Localisation</label>
            <div class="line"></div>
        </div>
        <div class="field">
            <label>WhatsApp</label>
            <div class="line"></div>
        </div>
        <div class="field">
            <label>Disponibilité pour visite</label>
            <div class="line"></div>
        </div>
    </div>
</div>

<!-- SECTION 1 : INFORMATIONS GÉNÉRALES -->
<div class="section">
    <div class="section-title">⚓ 1. Informations générales</div>
    <div class="section-body">
        <div class="grid-2" style="gap:10px;">
            <div class="field col-span-2">
                <label>Modèle / Nom du bateau <span class="req">*</span></label>
                <div class="line"></div>
            </div>
            <div class="field">
                <label>Type de bateau <span class="req">*</span><br><span style="font-weight:400;font-size:9px;text-transform:none;">(Voilier / Catamaran / Vedette / Semi-rigide / Autre)</span></label>
                <div class="line"></div>
            </div>
            <div class="field">
                <label>Zone géographique (localisation actuelle)</label>
                <div class="line"></div>
            </div>
            <div class="field">
                <label>Prix demandé (€) <span class="req">*</span></label>
                <div class="line"></div>
            </div>
            <div class="field">
                <label>Prix négociable ?</label>
                <div style="display:flex;gap:16px;margin-top:6px;">
                    <div class="check-item"><div class="cb"></div> Oui</div>
                    <div class="check-item"><div class="cb"></div> Non</div>
                </div>
            </div>
            <div class="field">
                <label>Afficher le prix sur l'annonce ?</label>
                <div style="display:flex;gap:16px;margin-top:6px;">
                    <div class="check-item"><div class="cb"></div> Oui</div>
                    <div class="check-item"><div class="cb"></div> Non (prix sur demande)</div>
                </div>
            </div>
            <div class="field">
                <label>État du bateau</label>
                <div style="display:flex;gap:16px;margin-top:6px;">
                    <div class="check-item"><div class="cb"></div> Neuf</div>
                    <div class="check-item"><div class="cb"></div> Occasion</div>
                </div>
            </div>
            <div class="field col-span-2">
                <label>Description de l'annonce <span class="req">*</span> <span style="font-weight:400;text-transform:none;">(état général, historique, travaux récents…)</span></label>
                <div class="box-lg"></div>
            </div>
        </div>
    </div>
</div>

<!-- SECTION 2 : CARACTÉRISTIQUES TECHNIQUES -->
<div class="section">
    <div class="section-title">⚙️ 2. Caractéristiques techniques</div>
    <div class="section-body">
        <div class="grid-3" style="gap:10px;">
            <div class="field">
                <label>Chantier constructeur</label>
                <div class="line"></div>
            </div>
            <div class="field">
                <label>Architecte naval</label>
                <div class="line"></div>
            </div>
            <div class="field">
                <label>Année de construction</label>
                <div class="line"></div>
            </div>
            <div class="field">
                <label>Pavillon</label>
                <div class="line"></div>
            </div>
            <div class="field">
                <label>Matériaux de coque</label>
                <div class="line"></div>
            </div>
            <div class="field">
                <label>Longueur hors tout (m)</label>
                <div class="line"></div>
            </div>
            <div class="field">
                <label>Largeur / Bau (m)</label>
                <div class="line"></div>
            </div>
            <div class="field">
                <label>Tirant d'eau (m)</label>
                <div class="line"></div>
            </div>
            <div class="field">
                <label>Poids lège / en charges (kg)</label>
                <div class="line"></div>
            </div>
            <div class="field">
                <label>Surface de voilure au près (m²)</label>
                <div class="line"></div>
            </div>
            <div class="field">
                <label>Système anti-dérive</label>
                <div class="line"></div>
            </div>
            <div class="field">
                <label>Nombre de cabines</label>
                <div class="line"></div>
            </div>
            <div class="field">
                <label>Capacité passagers</label>
                <div class="line"></div>
            </div>
        </div>

        <!-- Sous-section moteur -->
        <div style="margin-top:12px;border-top:1px solid #e5e7eb;padding-top:10px;">
            <div style="font-size:10px;font-weight:700;color:#374151;margin-bottom:8px;text-transform:uppercase;">🔧 Motorisation</div>
            <div class="grid-4" style="gap:10px;">
                <div class="field col-span-2">
                    <label>Marque / Modèle moteur</label>
                    <div class="line"></div>
                </div>
                <div class="field">
                    <label>Nombre de moteurs</label>
                    <div class="line"></div>
                </div>
                <div class="field">
                    <label>Puissance (CV)</label>
                    <div class="line"></div>
                </div>
                <div class="field">
                    <label>Heures moteur</label>
                    <div class="line"></div>
                </div>
                <div class="field col-span-3">
                    <label>Observations moteur (révisions, travaux…)</label>
                    <div class="line"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SECTION 3 : ÉQUIPEMENTS -->
<div class="section">
    <div class="section-title">✅ 3. Équipements à bord</div>
    <div class="section-body">
        @if($equipements->isNotEmpty())
            @php
                $labels = [
                    'navigation'   => '🧭 Navigation',
                    'electronique' => '📡 Électronique',
                    'securite'     => '🛟 Sécurité',
                    'manoeuvre'    => '⚓ Manœuvre',
                    'confort'      => '🛋️ Confort',
                    'loisirs'      => '🎣 Loisirs',
                ];
            @endphp
            @foreach($equipements as $categorie => $items)
            <div class="check-group">
                <div class="check-group-title">{{ $labels[$categorie] ?? ucfirst($categorie) }}</div>
                <div class="check-grid">
                    @foreach($items as $eq)
                    <div class="check-item">
                        <div class="cb"></div>
                        <span>{{ $eq->libelle }}</span>
                    </div>
                    @endforeach
                    <div class="check-item">
                        <div class="cb"></div>
                        <span>Autre : _______________</span>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="grid-4" style="gap:6px;">
                @foreach(['GPS chartplotter','VHF DSC','Pilote automatique','Radar','AIS','Sondeur','Guindeau électrique','Génois enrouleur','Lazy bag / Lazy jack','Électronique NMEA','Panneaux solaires','Groupe électrogène','Désalinisateur','Réfrigérateur','Climatisation','Dinghy / Annexe','Moteur annexe','Balise EPIRB','Radeau de survie','Gilets gonflables','Extincteurs','Pompe de cale auto','Jack-stay / Filières','Bimini / Taud'] as $eq)
                <div class="check-item">
                    <div class="cb"></div>
                    <span>{{ $eq }}</span>
                </div>
                @endforeach
            </div>
        @endif

        <div style="margin-top:10px;" class="field">
            <label>Autres équipements / remarques</label>
            <div class="box"></div>
        </div>
    </div>
</div>

<!-- SECTION 4 : MÉDIAS -->
<div class="section">
    <div class="section-title">📸 4. Photos & vidéos</div>
    <div class="section-body">
        <div class="grid-2" style="gap:10px;">
            <div class="field">
                <label>Photos disponibles ? <span class="req">*</span></label>
                <div style="display:flex;gap:16px;margin-top:6px;">
                    <div class="check-item"><div class="cb"></div> Oui</div>
                    <div class="check-item"><div class="cb"></div> Non (photos à prendre)</div>
                </div>
            </div>
            <div class="field">
                <label>Format des photos</label>
                <div style="display:flex;gap:12px;flex-wrap:wrap;margin-top:6px;">
                    <div class="check-item"><div class="cb"></div> Email</div>
                    <div class="check-item"><div class="cb"></div> WhatsApp</div>
                    <div class="check-item"><div class="cb"></div> Clé USB</div>
                    <div class="check-item"><div class="cb"></div> Google Drive / WeTransfer</div>
                </div>
            </div>
            <div class="field col-span-2">
                <label>Lien(s) vidéo YouTube / autre</label>
                <div class="line"></div>
            </div>
        </div>
    </div>
</div>

<!-- SECTION 5 : DOCUMENTS -->
<div class="section">
    <div class="section-title">📄 5. Documents disponibles</div>
    <div class="section-body">
        <div class="check-grid" style="grid-template-columns:repeat(3,1fr);">
            @foreach(["Acte de francisation / titre de navigation","Certificat d'immatriculation","Expertise / Survey récent","Carnet d'entretien moteur","Inventaire complet","Assurance en cours","Certificat jauge","Plans / Documentation technique","Factures travaux récents"] as $doc)
            <div class="check-item">
                <div class="cb"></div>
                <span>{{ $doc }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- FOOTER -->
<div class="footer">
    <div>
        <strong>MyBoat Océan Indien</strong> · myboat-oi.com<br>
        +262 629 926 538 · contact@myboat-oi.com
    </div>
    <div style="text-align:right;">
        Fiche complétée le : _____ / _____ / 20_____<br>
        Signature du vendeur : _________________________
    </div>
</div>

</body>
</html>
