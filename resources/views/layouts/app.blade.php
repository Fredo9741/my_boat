<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="khnsY4EOXA9a9-F07reTdBySXwmf-m8xFoCYo8sDscY" />

    <!-- Google Analytics 4 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-L6J2VH924Y"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-L6J2VH924Y');
    </script>

    <title>@yield('title', 'Acheter un Bateau Océan Indien | Réunion, Maurice, Madagascar - My Boat')</title>
    <meta name="description" content="@yield('description', 'Vente de bateaux neufs et d\'occasion dans l\'Océan Indien : monocoques, catamarans, multicoques à La Réunion, Maurice, Madagascar, Seychelles et Mayotte. Estimation gratuite.')">

    <!-- Open Graph / SEO Social -->
    <meta property="og:title" content="@yield('og_title', 'Acheter un Bateau Océan Indien | My Boat')">
    <meta property="og:description" content="@yield('og_description', 'Courtier maritime spécialisé dans la vente de bateaux dans l\'Océan Indien. Voiliers, catamarans, bateaux à moteur.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-myboat.jpg'))">

    <!-- Additional meta tags from child views -->
    @stack('head')

    <!-- Structured Data -->
    @stack('structured-data')

    <!-- Organization Schema (for logo in search results) -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "MyBoat-oi",
        "url": "https://www.myboat-oi.com",
        "logo": "https://www.myboat-oi.com/images/logo-myboat.svg",
        "description": "Courtier maritime spécialisé dans la vente de bateaux dans l'Océan Indien",
        "areaServed": ["Réunion", "Maurice", "Madagascar", "Mayotte", "Seychelles"],
        "contactPoint": {
            "@@type": "ContactPoint",
            "telephone": "+262-692-706-610",
            "contactType": "sales"
        }
    }
    </script>

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon-boat.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon-boat.svg') }}">

    <!-- Hreflang Tags for SEO - Indicates alternate language versions -->
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <link rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], false) }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL('fr', null, [], false) }}">
    <link rel="canonical" href="{{ strtok(url()->current(), '?') }}">

    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Vite Assets (Tailwind CSS + JS) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')

    <!-- Dark Mode Detection Script -->
    <script>
        // Check for saved theme preference or default to light mode
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark')
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>
<body class="bg-gray-50 dark:bg-slate-950 font-sans antialiased transition-colors duration-300">

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
