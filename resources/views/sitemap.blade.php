<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">

    {{-- ==================== STATIC PAGES ==================== --}}
    @foreach($staticPages as $routeName => $config)
        @foreach($locales as $locale)
            @php
                $url = LaravelLocalization::getLocalizedURL($locale, route($routeName), [], true);
            @endphp
            <url>
                <loc>{{ $url }}</loc>
                <lastmod>{{ now()->toAtomString() }}</lastmod>
                <changefreq>{{ $config['changefreq'] }}</changefreq>
                <priority>{{ $config['priority'] }}</priority>
                {{-- Hreflang for all locales --}}
                @foreach($locales as $hrefLocale)
                    <xhtml:link rel="alternate" hreflang="{{ $hrefLocale }}" href="{{ LaravelLocalization::getLocalizedURL($hrefLocale, route($routeName), [], true) }}" />
                @endforeach
                <xhtml:link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL($defaultLocale, route($routeName), [], true) }}" />
            </url>
        @endforeach
    @endforeach

    {{-- ==================== VISIBLE BOATS (priority 0.8) ==================== --}}
    @foreach($visibleBoats as $boat)
        @foreach($locales as $locale)
            @php
                $url = LaravelLocalization::getLocalizedURL($locale, route('bateaux.show', $boat->slug), [], true);
            @endphp
            <url>
                <loc>{{ $url }}</loc>
                <lastmod>{{ $boat->updated_at->toAtomString() }}</lastmod>
                <changefreq>weekly</changefreq>
                <priority>0.8</priority>
                @foreach($locales as $hrefLocale)
                    <xhtml:link rel="alternate" hreflang="{{ $hrefLocale }}" href="{{ LaravelLocalization::getLocalizedURL($hrefLocale, route('bateaux.show', $boat->slug), [], true) }}" />
                @endforeach
                <xhtml:link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL($defaultLocale, route('bateaux.show', $boat->slug), [], true) }}" />
            </url>
        @endforeach
    @endforeach

    {{-- ==================== SOLD/NON-VISIBLE BOATS (priority 0.4) ==================== --}}
    {{-- Keep them indexed to avoid losing SEO value, they redirect to "sold" page --}}
    @foreach($soldBoats as $boat)
        @foreach($locales as $locale)
            @php
                $url = LaravelLocalization::getLocalizedURL($locale, route('bateaux.show', $boat->slug), [], true);
            @endphp
            <url>
                <loc>{{ $url }}</loc>
                <lastmod>{{ $boat->updated_at->toAtomString() }}</lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.4</priority>
                @foreach($locales as $hrefLocale)
                    <xhtml:link rel="alternate" hreflang="{{ $hrefLocale }}" href="{{ LaravelLocalization::getLocalizedURL($hrefLocale, route('bateaux.show', $boat->slug), [], true) }}" />
                @endforeach
                <xhtml:link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL($defaultLocale, route('bateaux.show', $boat->slug), [], true) }}" />
            </url>
        @endforeach
    @endforeach

    {{-- ==================== ARTICLES (priority 0.7) ==================== --}}
    @foreach($articles as $article)
        @foreach($locales as $locale)
            @php
                $url = LaravelLocalization::getLocalizedURL($locale, route('articles.show', $article->slug), [], true);
            @endphp
            <url>
                <loc>{{ $url }}</loc>
                <lastmod>{{ $article->updated_at->toAtomString() }}</lastmod>
                <changefreq>monthly</changefreq>
                <priority>0.7</priority>
                @foreach($locales as $hrefLocale)
                    <xhtml:link rel="alternate" hreflang="{{ $hrefLocale }}" href="{{ LaravelLocalization::getLocalizedURL($hrefLocale, route('articles.show', $article->slug), [], true) }}" />
                @endforeach
                <xhtml:link rel="alternate" hreflang="x-default" href="{{ LaravelLocalization::getLocalizedURL($defaultLocale, route('articles.show', $article->slug), [], true) }}" />
            </url>
        @endforeach
    @endforeach

    {{-- ==================== CATEGORY PAGES BY TYPE (priority 0.7) ==================== --}}
    @foreach($types as $type)
        @foreach($locales as $locale)
            @php
                $url = LaravelLocalization::getLocalizedURL($locale, route('bateaux.index', ['type' => $type->slug]), [], true);
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
                $url = LaravelLocalization::getLocalizedURL($locale, route('bateaux.index', ['zone' => $zone->slug]), [], true);
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
