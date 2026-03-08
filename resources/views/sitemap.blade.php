<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">

    {{-- ==================== STATIC PAGES ==================== --}}
    @foreach($staticPages as $routeName => $config)
        @foreach($locales as $locale)
            @php
                $url = LaravelLocalization::getLocalizedURL($locale, route($routeName), [], false);
            @endphp
            <url>
                <loc>{{ $url }}</loc>
                <lastmod>{{ now()->toAtomString() }}</lastmod>
                <changefreq>{{ $config['changefreq'] }}</changefreq>
                <priority>{{ $config['priority'] }}</priority>
                {{-- Hreflang for all locales --}}
                @foreach($locales as $hrefLocale)
                    <xhtml:link rel="alternate" hreflang="{{ $hrefLocale }}" href="{{ LaravelLocalization::getLocalizedURL($hrefLocale, route($routeName), [], false) }}" />
                @endforeach
                <xhtml:link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL($defaultLocale, route($routeName), [], false) }}" />
            </url>
        @endforeach
    @endforeach

    {{-- ==================== VISIBLE BOATS (priority 0.8) ==================== --}}
    {{-- Fixed: Use getLocalizedURL on index route + slug to get properly translated segments --}}
    @foreach($visibleBoats as $boat)
        @foreach($locales as $locale)
            @php
                // Get the localized base URL (e.g., /en/boats, /de/boote)
                $baseUrl = LaravelLocalization::getLocalizedURL($locale, route('bateaux.index'), [], false);
                $url = $baseUrl . '/' . $boat->slug;
            @endphp
            <url>
                <loc>{{ $url }}</loc>
                <lastmod>{{ $boat->updated_at->toAtomString() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
                @foreach($locales as $hrefLocale)
                    @php
                        $hrefBaseUrl = LaravelLocalization::getLocalizedURL($hrefLocale, route('bateaux.index'), [], false);
                    @endphp
                    <xhtml:link rel="alternate" hreflang="{{ $hrefLocale }}" href="{{ $hrefBaseUrl }}/{{ $boat->slug }}" />
                @endforeach
                @php
                    $defaultBaseUrl = LaravelLocalization::getLocalizedURL($defaultLocale, route('bateaux.index'), [], false);
                @endphp
                <xhtml:link rel="alternate" hreflang="x-default" href="{{ $defaultBaseUrl }}/{{ $boat->slug }}" />
            </url>
        @endforeach
    @endforeach

    {{-- SOLD BOATS REMOVED - They were causing soft 404 in Google Search Console --}}
    {{-- If needed later, redirect them to category with 301 or return 410 Gone --}}

    {{-- ==================== ARTICLES (priority 0.7) ==================== --}}
    {{-- Fixed: Use getLocalizedURL on index route + slug to get properly translated segments --}}
    @foreach($articles as $article)
        @foreach($locales as $locale)
            @php
                // Get the localized base URL for articles
                $baseUrl = LaravelLocalization::getLocalizedURL($locale, route('articles.index'), [], false);
                $url = $baseUrl . '/' . $article->slug;
            @endphp
            <url>
                <loc>{{ $url }}</loc>
                <lastmod>{{ $article->updated_at->toAtomString() }}</lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.7</priority>
                @foreach($locales as $hrefLocale)
                    @php
                        $hrefBaseUrl = LaravelLocalization::getLocalizedURL($hrefLocale, route('articles.index'), [], false);
                    @endphp
                    <xhtml:link rel="alternate" hreflang="{{ $hrefLocale }}" href="{{ $hrefBaseUrl }}/{{ $article->slug }}" />
                @endforeach
                @php
                    $defaultBaseUrl = LaravelLocalization::getLocalizedURL($defaultLocale, route('articles.index'), [], false);
                @endphp
                <xhtml:link rel="alternate" hreflang="x-default" href="{{ $defaultBaseUrl }}/{{ $article->slug }}" />
            </url>
        @endforeach
    @endforeach

    {{-- ==================== CATEGORY PAGES BY TYPE (priority 0.7) ==================== --}}
    @foreach($types as $type)
        @foreach($locales as $locale)
            @php
                $url = LaravelLocalization::getLocalizedURL($locale, route('bateaux.index', ['type' => $type->slug]), [], false);
            @endphp
            <url>
                <loc>{{ $url }}</loc>
                <lastmod>{{ $type->updated_at ? $type->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.7</priority>
            </url>
        @endforeach
    @endforeach

    {{-- ==================== CATEGORY PAGES BY ZONE (priority 0.7) ==================== --}}
    @foreach($zones as $zone)
        @foreach($locales as $locale)
            @php
                $url = LaravelLocalization::getLocalizedURL($locale, route('bateaux.index', ['zone' => $zone->slug]), [], false);
            @endphp
            <url>
                <loc>{{ $url }}</loc>
                <lastmod>{{ $zone->updated_at ? $zone->updated_at->toAtomString() : now()->toAtomString() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.7</priority>
            </url>
        @endforeach
    @endforeach

</urlset>
