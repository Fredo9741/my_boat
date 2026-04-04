<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="khnsY4EOXA9a9-F07reTdBySXwmf-m8xFoCYo8sDscY" />

    <!-- Microsoft Clarity - chargé après le load pour ne pas bloquer le rendu -->
    <script>
        function loadClarity() {
            (function(c,l,a,r,i,t,y){
                c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
                t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
                y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
            })(window, document, "clarity", "script", "vsiyestkj1");
        }

        if (document.readyState === 'complete') {
            loadClarity();
        } else {
            window.addEventListener('load', loadClarity);
        }
    </script>

    <title>@yield('title', 'Acheter un Bateau Océan Indien | Réunion, Maurice, Madagascar - My Boat')</title>
    <meta name="description" content="@yield('description', 'Vente de bateaux neufs et d\'occasion dans l\'Océan Indien : monocoques, catamarans, multicoques à La Réunion, Maurice, Madagascar, Seychelles et Mayotte. Estimation gratuite.')">

    <!-- Open Graph / SEO Social -->
    <meta property="og:site_name" content="MyBoat Océan Indien">
    <meta property="og:title" content="@yield('og_title', 'Acheter un Bateau Océan Indien | My Boat')">
    <meta property="og:description" content="@yield('og_description', 'Courtier maritime spécialisé dans la vente de bateaux dans l\'Océan Indien. Voiliers, catamarans, bateaux à moteur.')">
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">

    <!-- Additional meta tags from child views -->
    @stack('head')

    <!-- Structured Data -->
    @stack('structured-data')

    <!-- Organization Schema (for logo in search results) -->
    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "MyBoat Océan Indien",
        "url": "https://www.myboat-oi.com",
        "logo": "https://www.myboat-oi.com/images/logo-myboat.png",
        "description": "Courtier maritime spécialisé dans la vente de bateaux dans l'Océan Indien",
        "areaServed": ["Réunion", "Maurice", "Madagascar", "Mayotte", "Seychelles"],
        "contactPoint": {
            "@@type": "ContactPoint",
            "telephone": "+33-629-926-538",
            "contactType": "sales"
        }
    }
    </script>

    <!-- Favicon -->
    <!-- PNG primary (required by Google for search result icon) -->
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('images/favicon.png') }}">
    <!-- SVG fallback for modern browsers -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon-boat.svg') }}">
    <!-- Apple touch icon (PNG required, not SVG) -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.png') }}">

    <!-- Hreflang Tags for SEO - Indicates alternate language versions -->
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <link rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], false) }}">
    @endforeach
    <link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL('fr', null, [], false) }}">
    <link rel="canonical" href="{{ strtok(url()->current(), '?') }}">

    <!-- Preconnect CDN images -->
    <link rel="preconnect" href="https://images.myboat-oi.com" crossorigin>

    <!-- Google Fonts - Inter (3 weights only) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=optional" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=optional"></noscript>

    <!-- Font Awesome (non-blocking) -->
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"></noscript>

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
    <script src="{{ asset('js/favorites.js') }}" defer></script>

    @stack('scripts')

    @if(session('success') || session('error'))
    <div id="toast-container" class="fixed top-6 right-4 z-[200] flex flex-col gap-3 pointer-events-none" style="max-width: 360px;">
        @if(session('success'))
        <div class="toast-item flex items-start gap-3 bg-white dark:bg-slate-800 border border-green-200 dark:border-green-800 rounded-2xl shadow-2xl px-5 py-4 pointer-events-auto translate-x-full opacity-0 transition-all duration-500">
            <div class="flex-shrink-0 w-9 h-9 bg-green-100 dark:bg-green-900/40 rounded-xl flex items-center justify-center">
                <i class="fas fa-check text-green-600 dark:text-green-400"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-gray-900 dark:text-white text-sm mb-0.5">Message envoyé !</p>
                <p class="text-gray-600 dark:text-gray-400 text-sm leading-snug">{{ session('success') }}</p>
            </div>
            <button onclick="dismissToast(this.closest('.toast-item'))" class="flex-shrink-0 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors mt-0.5">
                <i class="fas fa-times text-xs"></i>
            </button>
        </div>
        @endif
        @if(session('error'))
        <div class="toast-item flex items-start gap-3 bg-white dark:bg-slate-800 border border-red-200 dark:border-red-800 rounded-2xl shadow-2xl px-5 py-4 pointer-events-auto translate-x-full opacity-0 transition-all duration-500">
            <div class="flex-shrink-0 w-9 h-9 bg-red-100 dark:bg-red-900/40 rounded-xl flex items-center justify-center">
                <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400"></i>
            </div>
            <div class="flex-1 min-w-0">
                <p class="font-semibold text-gray-900 dark:text-white text-sm mb-0.5">Erreur d'envoi</p>
                <p class="text-gray-600 dark:text-gray-400 text-sm leading-snug">{{ session('error') }}</p>
            </div>
            <button onclick="dismissToast(this.closest('.toast-item'))" class="flex-shrink-0 text-gray-400 hover:text-gray-600 dark:hover:text-gray-200 transition-colors mt-0.5">
                <i class="fas fa-times text-xs"></i>
            </button>
        </div>
        @endif
    </div>
    <script>
    (function () {
        function dismissToast(el) {
            el.classList.add('translate-x-full', 'opacity-0');
            setTimeout(() => el.remove(), 500);
        }
        window.dismissToast = dismissToast;

        document.querySelectorAll('.toast-item').forEach(function (el, i) {
            setTimeout(function () {
                el.classList.remove('translate-x-full', 'opacity-0');
            }, 100 + i * 150);
            setTimeout(function () { dismissToast(el); }, 6000 + i * 150);
        });
    })();
    </script>
    @endif
</body>
</html>
