<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Myboat-oi - Marketplace de Bateaux | Océan Indien')</title>
    <meta name="description" content="@yield('description', 'La première marketplace de vente de bateaux dans l\'océan Indien. Trouvez votre bateau idéal à La Réunion, Maurice et Madagascar.')">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon-boat.svg') }}">
    <link rel="alternate icon" type="image/png" href="{{ asset('images/favicon-boat.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon-boat.png') }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased">

    <!-- Header -->
    @include('components.header')

    <!-- Breadcrumb (optionnel) -->
    @if(isset($showBreadcrumb) && $showBreadcrumb)
        @include('components.breadcrumb')
    @endif

    <!-- Contenu principal -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- Favorites System -->
    <script src="{{ asset('js/favorites.js') }}"></script>

    @stack('scripts')
</body>
</html>
