@extends('layouts.app')

@section('title', 'Mentions Légales - Myboat-oi')

@section('content')

<div class="bg-gray-100 py-8">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-gray-800">Mentions Légales</h1>
    </div>
</div>

<x-breadcrumb :items="[
    ['label' => 'Accueil', 'url' => route('home')],
    ['label' => 'Mentions légales', 'url' => '#']
]" />

<div class="container mx-auto px-4 py-12">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg p-8">

        <div class="prose prose-lg max-w-none space-y-8">

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">1. Informations Légales</h2>
                <p><strong>Dénomination sociale :</strong> Myboat-oi</p>
                <p><strong>Forme juridique :</strong> [À compléter]</p>
                <p><strong>Siège social :</strong> Port de Saint-Gilles, 97434 La Réunion, France</p>
                <p><strong>SIRET :</strong> [À compléter]</p>
                <p><strong>RCS :</strong> [À compléter]</p>
                <p><strong>Téléphone :</strong> +262 692 XX XX XX</p>
                <p><strong>Email :</strong> contact@myboat.re</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">2. Directeur de Publication</h2>
                <p><strong>Directeur de la publication :</strong> [Nom du directeur]</p>
                <p><strong>Email :</strong> contact@myboat.re</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">3. Hébergement</h2>
                <p><strong>Hébergeur du site :</strong> [Nom de l'hébergeur]</p>
                <p><strong>Adresse :</strong> [Adresse de l'hébergeur]</p>
                <p><strong>Téléphone :</strong> [Téléphone de l'hébergeur]</p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">4. Propriété Intellectuelle</h2>
                <p>
                    L'ensemble de ce site relève de la législation française et internationale sur le droit d'auteur et la propriété intellectuelle.
                    Tous les droits de reproduction sont réservés, y compris pour les documents téléchargeables et les représentations iconographiques et photographiques.
                </p>
                <p>
                    La reproduction de tout ou partie de ce site sur un support électronique ou autre quel qu'il soit est formellement interdite
                    sauf autorisation expresse du directeur de la publication.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">5. Cookies</h2>
                <p>
                    Le site Myboat-oi peut être amené à vous demander l'acceptation des cookies pour des besoins de statistiques et d'affichage.
                    Un cookie est une information déposée sur votre disque dur par le serveur du site que vous visitez.
                </p>
                <p>
                    Il contient plusieurs données qui sont stockées sur votre ordinateur dans un simple fichier texte auquel un serveur accède
                    pour lire et enregistrer des informations. Vous pouvez refuser les cookies en configurant votre navigateur.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">6. Responsabilité</h2>
                <p>
                    Les informations contenues sur ce site sont aussi précises que possibles et le site est périodiquement remis à jour,
                    mais peut toutefois contenir des inexactitudes, des omissions ou des lacunes.
                </p>
                <p>
                    Si vous constatez une lacune, erreur ou ce qui paraît être un dysfonctionnement, merci de bien vouloir le signaler par email
                    à contact@myboat.re en décrivant le problème de la manière la plus précise possible.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">7. Liens Hypertextes</h2>
                <p>
                    Le site Myboat-oi peut contenir des liens hypertextes vers d'autres sites présents sur le réseau Internet.
                    Les liens vers ces autres ressources vous font quitter le site Myboat-oi.
                </p>
                <p>
                    Il est possible de créer un lien vers la page de présentation de ce site sans autorisation expresse de l'éditeur.
                    Aucune autorisation ou demande d'information préalable ne peut être exigée par l'éditeur à l'égard d'un site qui souhaite établir un lien vers le site de l'éditeur.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">8. Litiges</h2>
                <p>
                    Les présentes conditions sont régies par les lois françaises et toute contestation ou litiges qui pourraient naître de l'interprétation
                    ou de l'exécution de celles-ci seront de la compétence exclusive des tribunaux de Saint-Denis de La Réunion.
                </p>
            </section>

            <section class="bg-blue-50 p-6 rounded-lg mt-8">
                <p class="text-sm text-gray-600">
                    <strong>Dernière mise à jour :</strong> {{ date('d/m/Y') }}
                </p>
                <p class="text-sm text-gray-600 mt-2">
                    Pour toute question concernant les mentions légales, veuillez nous contacter à :
                    <a href="mailto:contact@myboat.re" class="text-blue-600 hover:underline">contact@myboat.re</a>
                </p>
            </section>

        </div>
    </div>
</div>

@endsection
