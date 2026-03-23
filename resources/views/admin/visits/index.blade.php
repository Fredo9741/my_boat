@extends('layouts.admin')

@section('title', 'Monitoring des visites')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        @include('components.admin-sidebar')

        <main class="lg:col-span-3">

            {{-- Header --}}
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">
                        <i class="fas fa-satellite-dish text-blue-600 mr-2"></i>
                        Monitoring des visites
                    </h1>
                    <p class="text-gray-500 mt-1 text-sm">Rafraîchissement automatique toutes les 30 secondes</p>
                </div>
                <form action="{{ route('admin.visits.destroy') }}" method="POST" onsubmit="return confirm('Supprimer les visites antérieures à 30 jours ?')">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="days" value="30">
                    <button type="submit" class="bg-red-50 hover:bg-red-100 text-red-600 px-4 py-2 rounded-lg text-sm font-medium transition border border-red-200">
                        <i class="fas fa-trash mr-1"></i> Purger &gt; 30j
                    </button>
                </form>
            </div>

            @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg">
                <p class="text-green-700 text-sm">{{ session('success') }}</p>
            </div>
            @endif

            {{-- KPI Cards --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-xl shadow p-4 border-l-4 border-blue-500">
                    <div class="text-2xl font-black text-gray-900">{{ number_format($stats['today']) }}</div>
                    <div class="text-sm text-gray-500 mt-1">Aujourd'hui</div>
                </div>
                <div class="bg-white rounded-xl shadow p-4 border-l-4 border-indigo-500">
                    <div class="text-2xl font-black text-gray-900">{{ number_format($stats['week']) }}</div>
                    <div class="text-sm text-gray-500 mt-1">7 derniers jours</div>
                </div>
                <div class="bg-white rounded-xl shadow p-4 border-l-4 border-purple-500">
                    <div class="text-2xl font-black text-gray-900">{{ number_format($stats['month']) }}</div>
                    <div class="text-sm text-gray-500 mt-1">30 derniers jours</div>
                </div>
                <div class="bg-white rounded-xl shadow p-4 border-l-4 border-green-500">
                    <div class="text-2xl font-black text-gray-900">{{ number_format($stats['total']) }}</div>
                    <div class="text-sm text-gray-500 mt-1">Total</div>
                </div>
            </div>

            <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

                {{-- LIVE RADAR --}}
                <div class="xl:col-span-2">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                            <h2 class="font-bold text-gray-800 flex items-center">
                                <span class="inline-block w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                                Live Radar — 20 visiteurs actifs
                            </h2>
                            <span class="text-xs text-gray-400">1 ligne = 1 visiteur · cliquez <i class="fas fa-route"></i> pour son parcours</span>
                        </div>

                        @if($recentVisits->isEmpty())
                        <div class="px-6 py-12 text-center text-gray-400">
                            <i class="fas fa-satellite-dish text-4xl mb-3"></i>
                            <p>Aucune visite enregistrée pour l'instant.</p>
                        </div>
                        @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                                    <tr>
                                        <th class="px-4 py-3 text-left">Visiteur</th>
                                        <th class="px-4 py-3 text-left">Provenance</th>
                                        <th class="px-4 py-3 text-left">Dernière page</th>
                                        <th class="px-4 py-3 text-left">Bateau vu</th>
                                        <th class="px-4 py-3 text-right">Tps</th>
                                        <th class="px-4 py-3 text-right">Il y a</th>
                                        <th class="px-4 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-50">
                                    @foreach($recentVisits as $visit)
                                    @php
                                        $isSelected = $selectedSession === $visit->session_id;
                                        $rtColor = match(true) {
                                            $visit->response_time <= 200  => 'text-green-600',
                                            $visit->response_time <= 600  => 'text-yellow-600',
                                            default                        => 'text-red-600',
                                        };
                                    @endphp
                                    @php
                                        $pageCount = \App\Models\Visit::where('session_id', $visit->session_id)->count();
                                    @endphp
                                    <tr class="{{ $isSelected ? 'bg-blue-50' : 'hover:bg-gray-50' }} transition">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-2">
                                                <span class="text-xl leading-none">{{ $visit->flag }}</span>
                                                <div>
                                                    <div class="font-medium text-gray-800">{{ $visit->city ?? '—' }}</div>
                                                    <div class="text-gray-400 text-xs">{{ $visit->country ?? '—' }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($visit->referer)
                                            <span class="inline-flex items-center gap-1 text-xs bg-indigo-50 text-indigo-700 px-2 py-1 rounded font-medium">
                                                <i class="fas fa-external-link-alt text-indigo-400"></i>
                                                {{ $visit->referer }}
                                            </span>
                                            @else
                                            <span class="text-xs text-gray-400">Direct / Inconnu</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 max-w-[140px]">
                                            <span class="text-gray-600 truncate block text-xs" title="{{ $visit->url }}">
                                                {{ $visit->short_url }}
                                            </span>
                                            @if($pageCount > 1)
                                            <span class="text-xs text-gray-400">{{ $pageCount }} pages vues</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($visit->boat)
                                            <a href="{{ route('bateaux.show', $visit->boat->slug) }}" target="_blank"
                                               class="text-blue-600 hover:underline text-xs font-medium">
                                                {{ Str::limit($visit->boat->modele, 18) }}
                                            </a>
                                            @else
                                            <span class="text-gray-300 text-xs">—</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3 text-right font-mono {{ $rtColor }} font-semibold text-xs">
                                            {{ $visit->response_time ?? '—' }}<span class="text-gray-400 font-normal">ms</span>
                                        </td>
                                        <td class="px-4 py-3 text-right text-gray-400 text-xs whitespace-nowrap">
                                            {{ $visit->created_at->diffForHumans() }}
                                        </td>
                                        <td class="px-4 py-3 text-right">
                                            <a href="{{ route('admin.visits.index', ['session' => $visit->session_id]) }}"
                                               class="text-xs {{ $isSelected ? 'bg-blue-600 text-white' : 'bg-gray-100 text-gray-600 hover:bg-blue-100 hover:text-blue-600' }} px-2 py-1 rounded font-medium transition"
                                               title="Voir le parcours de cette session">
                                                <i class="fas fa-route"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>

                {{-- TOP BATEAUX --}}
                <div class="xl:col-span-1">
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-100">
                            <h2 class="font-bold text-gray-800">
                                <i class="fas fa-trophy text-amber-500 mr-2"></i>
                                Top bateaux — 30 jours
                            </h2>
                        </div>
                        @if($topBoats->isEmpty())
                        <div class="px-6 py-8 text-center text-gray-400 text-sm">Pas encore de données.</div>
                        @else
                        <div class="p-4 space-y-3">
                            @php $maxViews = $topBoats->first()->views; @endphp
                            @foreach($topBoats as $i => $item)
                            <div>
                                <div class="flex items-center justify-between mb-1">
                                    <div class="flex items-center gap-2 min-w-0">
                                        <span class="text-xs font-bold text-gray-400 w-4 shrink-0">{{ $i + 1 }}</span>
                                        @if($item->boat)
                                        <a href="{{ route('bateaux.show', $item->boat->slug) }}" target="_blank"
                                           class="text-sm font-medium text-gray-800 hover:text-blue-600 truncate transition">
                                            {{ $item->boat->modele }}
                                        </a>
                                        @else
                                        <span class="text-sm text-gray-400">Bateau supprimé</span>
                                        @endif
                                    </div>
                                    <span class="text-sm font-bold text-blue-600 shrink-0 ml-2">{{ $item->views }}</span>
                                </div>
                                <div class="h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full transition-all"
                                         style="width: {{ round(($item->views / $maxViews) * 100) }}%"></div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- SESSION JOURNEY --}}
            @if($selectedSession && $sessionVisits->isNotEmpty())
            <div class="mt-6 bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h2 class="font-bold text-gray-800">
                        <i class="fas fa-route text-indigo-600 mr-2"></i>
                        Parcours — session <code class="bg-gray-100 px-2 py-0.5 rounded text-xs">{{ substr($selectedSession, 0, 16) }}…</code>
                        <span class="ml-2 text-sm text-gray-500 font-normal">({{ $sessionVisits->count() }} page(s))</span>
                    </h2>
                    <a href="{{ route('admin.visits.index') }}" class="text-sm text-gray-500 hover:text-gray-800 transition">
                        <i class="fas fa-times mr-1"></i>Fermer
                    </a>
                </div>
                <div class="p-6">
                    <ol class="relative border-l-2 border-indigo-100 space-y-4 ml-3">
                        @foreach($sessionVisits as $i => $visit)
                        <li class="ml-6">
                            <span class="absolute -left-3 w-6 h-6 bg-indigo-100 rounded-full flex items-center justify-center text-xs font-bold text-indigo-600">
                                {{ $i + 1 }}
                            </span>
                            <div class="flex flex-wrap items-center gap-3">
                                <span class="text-sm font-medium text-gray-800 break-all">{{ $visit->short_url }}</span>
                                @if($visit->boat)
                                <a href="{{ route('bateaux.show', $visit->boat->slug) }}" target="_blank"
                                   class="text-xs bg-blue-50 text-blue-700 px-2 py-0.5 rounded font-medium hover:bg-blue-100 transition">
                                    {{ $visit->boat->modele }}
                                </a>
                                @endif
                                @php
                                    $rtColor = match(true) {
                                        $visit->response_time <= 200 => 'text-green-600',
                                        $visit->response_time <= 600 => 'text-yellow-600',
                                        default => 'text-red-600',
                                    };
                                @endphp
                                <span class="text-xs {{ $rtColor }} font-mono font-semibold">{{ $visit->response_time }}ms</span>
                                <span class="text-xs text-gray-400">{{ $visit->created_at->format('H:i:s') }}</span>
                            </div>
                        </li>
                        @endforeach
                    </ol>
                </div>
            </div>
            @endif

        </main>
    </div>
</div>

{{-- Auto-refresh every 30s (sauf si une session est sélectionnée) --}}
@unless($selectedSession)
<meta http-equiv="refresh" content="30">
@endunless

@endsection
