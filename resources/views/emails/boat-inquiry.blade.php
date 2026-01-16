<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Demande sur un bateau</title>
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
        .boat-badge { display: inline-block; background: #0369a1; color: white; padding: 5px 15px; border-radius: 20px; font-size: 14px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">Myboat-oi</h1>
        <p style="margin: 10px 0 0 0; opacity: 0.9;">Nouvelle demande sur un bateau</p>
        <span class="boat-badge">{{ $data['bateau_titre'] }}</span>
    </div>

    <div class="content">
        <div class="section">
            <div class="section-title">Bateau concerne</div>
            <div class="field">
                <span class="label">Annonce:</span>
                <span class="value"><strong>{{ $data['bateau_titre'] }}</strong></span>
            </div>
            <div class="field">
                <span class="label">ID:</span>
                <span class="value">#{{ $data['bateau_id'] }}</span>
            </div>
            <div style="margin-top: 15px;">
                <a href="{{ url('/bateaux/' . $data['bateau_slug']) }}"
                   style="display: inline-block; background: #0369a1; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold;">
                    Voir l'annonce
                </a>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Contact</div>
            <div class="field">
                <span class="label">Nom:</span>
                <span class="value">{{ $data['nom'] }}</span>
            </div>
            <div class="field">
                <span class="label">Email:</span>
                <span class="value"><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></span>
            </div>
            @if(!empty($data['telephone']))
            <div class="field">
                <span class="label">Telephone:</span>
                <span class="value"><a href="tel:{{ $data['telephone'] }}">{{ $data['telephone'] }}</a></span>
            </div>
            @endif
        </div>

        <div class="section">
            <div class="section-title">Message</div>
            <div class="message-box">
                <p style="white-space: pre-wrap; margin: 0;">{{ $data['message'] }}</p>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>Cette demande a ete envoyee depuis la page du bateau sur Myboat-oi</p>
        <p>Vous pouvez repondre directement a cet email pour contacter le client.</p>
    </div>
</body>
</html>
