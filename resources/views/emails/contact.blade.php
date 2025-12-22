<x-mail::message>
# Nouvelle demande de contact

Vous avez reçu une nouvelle demande concernant: **{{ $formData['bateau_titre'] }}**

## Informations du contact

**Nom:** {{ $formData['nom'] }}
**Email:** {{ $formData['email'] }}
@if(!empty($formData['telephone']))
**Téléphone:** {{ $formData['telephone'] }}
@endif

## Message

{{ $formData['message'] }}

<x-mail::button :url="route('admin.bateaux.edit', $formData['bateau_id'])">
Voir l'annonce dans l'admin
</x-mail::button>

Vous pouvez répondre directement à cet email pour contacter le client.

Cordialement,<br>
{{ config('app.name') }}
</x-mail::message>
