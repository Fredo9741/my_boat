@extends('layouts.app')

@section('title', 'Conditions Générales de Vente - Myboat-oi')

@section('content')

<div class="bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-gray-800">Conditions Générales de Vente</h1>
    </div>
</div>

<x-breadcrumb :items="[
    ['label' => 'Accueil', 'url' => route('home')],
    ['label' => 'CGV', 'url' => '#']
]" />

<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">

        <div class="prose prose-lg max-w-none space-y-8">

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">1. Objet</h2>
                <p>
                    Les présentes Conditions Générales de Vente (CGV) régissent les relations contractuelles entre Myboat-oi
                    et ses clients dans le cadre de la vente ou de l'achat de bateaux par l'intermédiaire de notre service de courtage maritime.
                </p>
                <p>
                    En utilisant nos services, le client reconnaît avoir pris connaissance des présentes CGV et les accepter sans réserve.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">2. Services Proposés</h2>
                <h3 class="text-xl font-bold text-gray-700 mb-2">2.1 Pour les Vendeurs</h3>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Estimation gratuite du bateau</li>
                    <li>Réalisation de photos et vidéos professionnelles</li>
                    <li>Création et diffusion de l'annonce sur notre plateforme</li>
                    <li>Organisation et accompagnement des visites</li>
                    <li>Négociation avec les acheteurs potentiels</li>
                    <li>Gestion des formalités administratives</li>
                    <li>Accompagnement jusqu'à la signature de l'acte de vente</li>
                </ul>

                <h3 class="text-xl font-bold text-gray-700 mb-2 mt-4">2.2 Pour les Acheteurs</h3>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Accès à notre catalogue de bateaux</li>
                    <li>Conseils personnalisés dans le choix du bateau</li>
                    <li>Organisation des visites</li>
                    <li>Assistance dans les négociations</li>
                    <li>Accompagnement administratif</li>
                    <li>Conseil sur le financement et l'assurance</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">3. Commission de Courtage</h2>
                <p>
                    <strong>3.1 Principe :</strong> La commission de courtage est due uniquement en cas de vente effective du bateau.
                </p>
                <p>
                    <strong>3.2 Calcul :</strong> Le montant de la commission est calculé selon un barème dégressif en fonction du prix de vente du bateau.
                    Ce barème est communiqué au vendeur avant la signature du mandat.
                </p>
                <p>
                    <strong>3.3 Paiement :</strong> La commission est payable au moment de la signature de l'acte de vente définitif.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">4. Mandat de Vente</h2>
                <p>
                    <strong>4.1 Signature :</strong> Le vendeur signe un mandat de vente exclusif ou non-exclusif avec Myboat-oi.
                </p>
                <p>
                    <strong>4.2 Durée :</strong> La durée du mandat est fixée par écrit et peut être renouvelée par accord des deux parties.
                </p>
                <p>
                    <strong>4.3 Résiliation :</strong> Le mandat peut être résilié par l'une ou l'autre des parties selon les conditions prévues dans le contrat.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">5. Prix et Modalités de Paiement</h2>
                <p>
                    <strong>5.1 Prix :</strong> Le prix de vente du bateau est fixé d'un commun accord entre le vendeur et Myboat-oi,
                    en fonction de l'expertise réalisée et des conditions du marché.
                </p>
                <p>
                    <strong>5.2 Paiement :</strong> Les modalités de paiement entre l'acheteur et le vendeur sont définies lors de la négociation.
                    Myboat-oi peut proposer un service de séquestre pour sécuriser la transaction.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">6. Obligations du Vendeur</h2>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Fournir toutes les informations exactes et complètes concernant le bateau</li>
                    <li>Présenter tous les documents obligatoires (acte de francisation, certificat de navigabilité, etc.)</li>
                    <li>Garantir qu'il est le propriétaire légitime du bateau</li>
                    <li>Maintenir le bateau en bon état pendant la période de vente</li>
                    <li>Donner accès au bateau pour les visites organisées par Myboat-oi</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">7. Obligations de l'Acheteur</h2>
                <ul class="list-disc pl-6 space-y-2">
                    <li>Fournir les informations nécessaires pour la transaction</li>
                    <li>Respecter les rendez-vous de visite convenus</li>
                    <li>Faire preuve de sérieux dans les négociations</li>
                    <li>S'assurer de sa capacité financière avant de faire une offre</li>
                    <li>Respecter les délais convenus pour la signature et le paiement</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">8. Garanties</h2>
                <p>
                    <strong>8.1 Bateaux d'occasion :</strong> Les bateaux d'occasion sont vendus dans l'état où ils se trouvent au moment de la vente,
                    sans garantie autre que celle prévue par la loi pour les vices cachés.
                </p>
                <p>
                    <strong>8.2 Bateaux neufs :</strong> Les bateaux neufs bénéficient de la garantie constructeur selon les conditions du fabricant.
                </p>
                <p>
                    <strong>8.3 Expertise :</strong> Myboat-oi recommande fortement de faire expertiser le bateau avant l'achat.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">9. Responsabilité</h2>
                <p>
                    Myboat-oi agit en tant qu'intermédiaire entre le vendeur et l'acheteur. Sa responsabilité ne saurait être engagée
                    pour les vices cachés ou défauts du bateau non apparents lors de la présentation.
                </p>
                <p>
                    L'acheteur est invité à faire vérifier le bateau par un expert indépendant avant l'achat.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">10. Données Personnelles</h2>
                <p>
                    Les données personnelles collectées sont nécessaires à la gestion de la relation commerciale.
                    Conformément au RGPD, vous disposez d'un droit d'accès, de rectification et de suppression de vos données.
                </p>
                <p>
                    Pour plus d'informations, consultez notre <a href="{{ route('confidentialite') }}" class="text-blue-600 hover:underline">Politique de Confidentialité</a>.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">11. Droit Applicable et Litiges</h2>
                <p>
                    Les présentes CGV sont soumises au droit français. En cas de litige, une solution amiable sera recherchée
                    avant toute action judiciaire.
                </p>
                <p>
                    À défaut de résolution amiable, le litige sera porté devant les tribunaux compétents de Saint-Denis de La Réunion.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">12. Modification des CGV</h2>
                <p>
                    Myboat-oi se réserve le droit de modifier les présentes CGV à tout moment.
                    Les CGV applicables sont celles en vigueur au moment de la signature du mandat ou de la réalisation de la prestation.
                </p>
            </section>

            <section class="bg-blue-50 p-6 rounded-lg mt-8">
                <p class="text-sm text-gray-600">
                    <strong>Dernière mise à jour :</strong> {{ date('d/m/Y') }}
                </p>
                <p class="text-sm text-gray-600 mt-2">
                    Pour toute question concernant nos CGV, veuillez nous contacter à :
                    <a href="mailto:contact@myboat.re" class="text-blue-600 hover:underline">contact@myboat.re</a>
                </p>
            </section>

        </div>
    </div>
</div>

@endsection
