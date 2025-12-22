<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Boat - Marketplace de Bateaux | Océan Indien')</title>
    <meta name="description" content="@yield('description', 'La première marketplace de vente de bateaux dans l\'océan Indien. Trouvez votre bateau idéal à La Réunion, Maurice et Madagascar.')">
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

    @stack('scripts')
</body>
</html>
