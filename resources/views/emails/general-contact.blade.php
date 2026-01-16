<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouveau message de contact</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #0369a1, #06b6d4); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f8fafc; padding: 30px; border: 1px solid #e2e8f0; }
        .field { margin-bottom: 20px; }
        .label { font-weight: bold; color: #0369a1; margin-bottom: 5px; }
        .value { background: white; padding: 10px 15px; border-radius: 5px; border-left: 3px solid #06b6d4; }
        .message-box { background: white; padding: 20px; border-radius: 10px; border: 1px solid #e2e8f0; margin-top: 20px; }
        .footer { text-align: center; padding: 20px; color: #64748b; font-size: 12px; }
        .subject-badge { display: inline-block; background: #06b6d4; color: white; padding: 5px 15px; border-radius: 20px; font-size: 14px; margin-top: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">Myboat-oi</h1>
        <p style="margin: 10px 0 0 0; opacity: 0.9;">Nouveau message de contact</p>
        <span class="subject-badge">{{ $data['sujet'] }}</span>
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
            <div class="label">Telephone</div>
            <div class="value"><a href="tel:{{ $data['telephone'] }}">{{ $data['telephone'] }}</a></div>
        </div>
        @endif

        <div class="field">
            <div class="label">Sujet</div>
            <div class="value">{{ $data['sujet'] }}</div>
        </div>

        <div class="message-box">
            <div class="label">Message</div>
            <p style="white-space: pre-wrap;">{{ $data['message'] }}</p>
        </div>
    </div>

    <div class="footer">
        <p>Ce message a ete envoye depuis le formulaire de contact de Myboat-oi</p>
        <p>Vous pouvez repondre directement a cet email pour contacter l'expediteur.</p>
    </div>
</body>
</html>
