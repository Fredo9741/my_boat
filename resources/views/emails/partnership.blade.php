<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Demande de partenariat</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background: linear-gradient(135deg, #7c3aed, #06b6d4); color: white; padding: 30px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { background: #f8fafc; padding: 30px; border: 1px solid #e2e8f0; }
        .section { background: white; padding: 20px; border-radius: 10px; margin-bottom: 20px; border: 1px solid #e2e8f0; }
        .section-title { font-size: 18px; font-weight: bold; color: #7c3aed; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #06b6d4; }
        .field { display: flex; margin-bottom: 10px; }
        .label { font-weight: bold; color: #64748b; width: 140px; flex-shrink: 0; }
        .value { color: #1e293b; }
        .message-box { background: #faf5ff; padding: 20px; border-radius: 10px; border-left: 4px solid #7c3aed; }
        .footer { text-align: center; padding: 20px; color: #64748b; font-size: 12px; }
        .partner-badge { display: inline-block; background: #10b981; color: white; padding: 5px 15px; border-radius: 20px; font-size: 12px; margin-top: 10px; }
        .activity-badge { display: inline-block; background: #06b6d4; color: white; padding: 3px 10px; border-radius: 10px; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h1 style="margin: 0;">Myboat-oi</h1>
        <p style="margin: 10px 0 0 0; opacity: 0.9;">Nouvelle demande de partenariat</p>
        <span class="partner-badge">Partenaire potentiel</span>
    </div>

    <div class="content">
        <div class="section">
            <div class="section-title">Informations de l'entreprise</div>
            <div class="field">
                <span class="label">Entreprise:</span>
                <span class="value"><strong>{{ $data['company'] }}</strong></span>
            </div>
            @if(!empty($data['activity_type']))
            <div class="field">
                <span class="label">Activite:</span>
                <span class="value">
                    <span class="activity-badge">
                        @switch($data['activity_type'])
                            @case('courtier') Courtier maritime @break
                            @case('fabricant') Fabricant de bateaux @break
                            @case('distributeur') Distributeur / Revendeur @break
                            @case('accastillage') Accastillage / Equipements @break
                            @case('location') Location de bateaux @break
                            @default Autre activite nautique
                        @endswitch
                    </span>
                </span>
            </div>
            @endif
        </div>

        <div class="section">
            <div class="section-title">Contact</div>
            <div class="field">
                <span class="label">Nom:</span>
                <span class="value">{{ $data['name'] }}</span>
            </div>
            <div class="field">
                <span class="label">Email:</span>
                <span class="value"><a href="mailto:{{ $data['email'] }}">{{ $data['email'] }}</a></span>
            </div>
            <div class="field">
                <span class="label">Telephone:</span>
                <span class="value"><a href="tel:{{ $data['phone'] }}">{{ $data['phone'] }}</a></span>
            </div>
        </div>

        @if(!empty($data['message']))
        <div class="section">
            <div class="section-title">Message</div>
            <div class="message-box">
                <p style="white-space: pre-wrap; margin: 0;">{{ $data['message'] }}</p>
            </div>
        </div>
        @endif
    </div>

    <div class="footer">
        <p>Cette demande de partenariat a ete envoyee depuis la page "Devenir Partenaire" de Myboat-oi</p>
        <p>Vous pouvez repondre directement a cet email pour contacter le partenaire potentiel.</p>
    </div>
</body>
</html>
