<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Demande d'estimation</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #0369a1, #06b6d4); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f8fafc; padding: 30px; border: 1px solid #e2e8f0; }
        .section { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #e2e8f0; }
        .section-title { font-size: 18px; font-weight: bold; color: #0369a1; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #06b6d4; }
        .field { display: flex; margin-bottom: 10px; }
        .label { font-weight: bold; color: #64748b; width: 140px; flex-shrink: 0; }
        .value { color: #1e293b; }
        .message-box { background: #f0f9ff; padding: 20px; border-radius: 10px; border-left: 4px solid #06b6d4; }
        .footer { text-align: center; padding: 20px; color: #64748b; font-size: 12px; }
        .urgent-badge { display: inline-block; background: #f59e0b; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">Myboat-oi</h1>
        <p style="margin: 10px 0 0 0; opacity: 0.9;">Nouvelle demande d'estimation</p>
        <span class="urgent-badge">A traiter sous 24h</span>
    </div>

    <div class="content">
        <div class="section">
            <div class="section-title">Informations du contact</div>
            <div class="field">
                <span class="label">Nom:</span>
                <span class="value">{{ $data['nom'] }}</span>
            </div>
            <div class="field">
                <span class="label">Email:</span>
                <span class="value"><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></span>
            </div>
            <div class="field">
                <span class="label">Telephone:</span>
                <span class="value"><a href="tel:{{ $data['telephone'] }}">{{ $data['telephone'] }}</a></span>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Informations du bateau</div>
            @if(!empty($data['type_bateau']))
            <div class="field">
                <span class="label">Type:</span>
                <span class="value">{{ $data['type_bateau'] }}</span>
            </div>
            @endif
            @if(!empty($data['marque']))
            <div class="field">
                <span class="label">Marque:</span>
                <span class="value">{{ $data['marque'] }}</span>
            </div>
            @endif
            @if(!empty($data['modele']))
            <div class="field">
                <span class="label">Modele:</span>
                <span class="value">{{ $data['modele'] }}</span>
            </div>
            @endif
            @if(!empty($data['annee']))
            <div class="field">
                <span class="label">Annee:</span>
                <span class="value">{{ $data['annee'] }}</span>
            </div>
            @endif
            @if(!empty($data['longueur']))
            <div class="field">
                <span class="label">Longueur:</span>
                <span class="value">{{ $data['longueur'] }} m</span>
            </div>
            @endif
            @if(!empty($data['localisation']))
            <div class="field">
                <span class="label">Localisation:</span>
                <span class="value">{{ $data['localisation'] }}</span>
            </div>
            @endif
            @if(!empty($data['ville']))
            <div class="field">
                <span class="label">Ville / Port:</span>
                <span class="value">{{ $data['ville'] }}</span>
            </div>
            @endif
        </div>

        <div class="section">
            <div class="section-title">Description / Informations complementaires</div>
            <div class="message-box">
                <p style="white-space: pre-wrap; margin: 0;">{{ $data['message'] }}</p>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Cette demande d'estimation a ete envoyee depuis la page "Vendre mon bateau" de Myboat-oi</p>
        <p>Vous pouvez repondre directement a cet email pour contacter le client.</p>
    </div>
</body>
</html>
