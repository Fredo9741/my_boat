<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Administration - Myboat-oi')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased">

    <!-- Admin Header -->
    @include('components.admin-header')

    <!-- Contenu principal -->
    <main>
        @yield('content')
    </main>

    <!-- Footer simple pour admin -->
    <footer class="bg-white border-t mt-12 py-6">
        <div class="container mx-auto px-4 text-center text-gray-600 text-sm">
            <p>&copy; 2025 Myboat-oi - Courtage Maritime. Tous droits réservés.</p>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>
