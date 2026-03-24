<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouvelle fiche bateau</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #0369a1, #06b6d4); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f8fafc; padding: 30px; border: 1px solid #e2e8f0; }
        .field { margin-bottom: 16px; }
        .label { font-weight: bold; color: #0369a1; margin-bottom: 4px; }
        .value { background: white; padding: 8px 14px; border-radius: 5px; border-left: 3px solid #06b6d4; }
        .message-box { background: white; padding: 20px; border-radius: 10px; border: 1px solid #e2e8f0; margin-top: 20px; white-space: pre-wrap; font-size: 13px; font-family: monospace; }
        .footer { text-align: center; padding: 20px; color: #64748b; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin:0;">MyBoat Océan Indien</h1>
        <p style="margin:10px 0 0;opacity:.9;">Nouvelle demande de mise en annonce</p>
    </div>

    <div class="content">
        <div class="field">
            <div class="label">Nom</div>
            <div class="value">{{ $data['nom'] }}</div>
        </div>
        <div class="field">
            <div class="label">Email</div>
            <div class="value"><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></div>
        </div>
        @if(!empty($data['telephone']))
        <div class="field">
            <div class="label">Téléphone</div>
            <div class="value"><a href="tel:{{ $data['telephone'] }}">{{ $data['telephone'] }}</a></div>
        </div>
        @endif

        <div class="message-box">{{ $data['message'] }}</div>
    </div>

    <div class="footer">
        <p>Formulaire envoyé depuis myboat-oi.com/fiche-bateau</p>
        <p>Répondez directement à cet email pour contacter le vendeur.</p>
    </div>
</body>
</html>
