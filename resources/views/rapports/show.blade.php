@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="max-w-7xl mx-auto p-6 mt-10">
        <h1 class="text-center text-4xl font-bold text-gray-900 mb-8">Détails du Rapport</h1>

        <!-- Rapport Details Card -->
        <div class="bg-white shadow-xl rounded-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-6">
                <h4 class="mb-0 flex items-center text-2xl font-semibold">
                    <i class="fas fa-file-alt mr-3"></i>
                    Informations du Rapport
                </h4>
            </div>

            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 text-lg">
                        <thead class="bg-gray-100 text-gray-700">
                            <tr>
                                <th class="px-6 py-4 text-left font-semibold">Champ</th>
                                <th class="px-6 py-4 text-left font-semibold">Valeur</th>
                                <th class="px-6 py-4 text-left font-semibold">Mois Précédent</th>
                                <th class="px-6 py-4 text-left font-semibold">Différence (%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                function calculatePercentageDifference($current, $previous)
                                {
                                    if ($previous == 0) {
                                        return $current > 0 ? 100 : 0; // Handle division by zero
                                    }
                                    return (($current - $previous) / $previous) * 100;
                                }

                                $previousMonthDate = (clone $rapport->periode)->subMonth();
                                $previousMonth = \App\Models\Rapport::where('id_projet', $rapport->id_projet)
                                    ->whereMonth('periode', $previousMonthDate->month)
                                    ->whereYear('periode', $previousMonthDate->year)
                                    ->first();
                            @endphp

                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium">Période</td>
                                <td class="px-6 py-4">{{ $rapport->periode->format('F Y') }}</td>
                                <td class="px-6 py-4">
                                    @if ($previousMonth)
                                        {{ $previousMonth->periode->format('F Y') }}
                                    @else
                                        Aucune donnée
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($previousMonth)
                                        @php
                                            $difference =
                                                $rapport->periode->format('F Y') !==
                                                $previousMonth->periode->format('F Y')
                                                    ? 'Données disponibles'
                                                    : 'Aucune différence';
                                        @endphp
                                        {{ $difference }}
                                    @else
                                        Aucune comparaison
                                    @endif
                                </td>
                            </tr>

                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium">Nom du Rapport</td>
                                <td class="px-6 py-4">{{ $rapport->nom_rapport }}</td>
                                <td class="px-6 py-4">{{ $previousMonth->nom_rapport ?? 'Aucune donnée' }}</td>
                                <td class="px-6 py-4">
                                    @if ($previousMonth)
                                        {{ $rapport->nom_rapport === $previousMonth->nom_rapport ? 'Identique' : 'Différent' }}
                                    @else
                                        Aucune comparaison
                                    @endif
                                </td>
                            </tr>

                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium">Clics Totaux</td>
                                <td class="px-6 py-4">{{ number_format($rapport->total_clicks) }}</td>
                                <td class="px-6 py-4">{{ number_format($previousMonth->total_clicks ?? 0) }}</td>
                                <td class="px-6 py-4">
                                    @if ($previousMonth)
                                        @php $clicksDiff = calculatePercentageDifference($rapport->total_clicks, $previousMonth->total_clicks); @endphp
                                        <span class="{{ $clicksDiff >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ number_format($clicksDiff, 2) }}%
                                        </span>
                                    @else
                                        Aucune comparaison
                                    @endif
                                </td>
                            </tr>

                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium">Impressions Totales</td>
                                <td class="px-6 py-4">{{ number_format($rapport->total_impressions) }}</td>
                                <td class="px-6 py-4">{{ number_format($previousMonth->total_impressions ?? 0) }}</td>
                                <td class="px-6 py-4">
                                    @if ($previousMonth)
                                        @php $impressionsDiff = calculatePercentageDifference($rapport->total_impressions, $previousMonth->total_impressions); @endphp
                                        <span class="{{ $impressionsDiff >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ number_format($impressionsDiff, 2) }}%
                                        </span>
                                    @else
                                        Aucune comparaison
                                    @endif
                                </td>
                            </tr>

                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium">CTR Moyen</td>
                                <td class="px-6 py-4">{{ number_format($rapport->avg_ctr, 2) }}%</td>
                                <td class="px-6 py-4">{{ number_format($previousMonth->avg_ctr ?? 0, 2) }}%</td>
                                <td class="px-6 py-4">
                                    @if ($previousMonth)
                                        @php $ctrDiff = calculatePercentageDifference($rapport->avg_ctr, $previousMonth->avg_ctr); @endphp
                                        <span class="{{ $ctrDiff >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ number_format($ctrDiff, 2) }}%
                                        </span>
                                    @else
                                        Aucune comparaison
                                    @endif
                                </td>
                            </tr>

                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium">Position Moyenne</td>
                                <td class="px-6 py-4">{{ number_format($rapport->avg_position, 2) }}</td>
                                <td class="px-6 py-4">{{ number_format($previousMonth->avg_position ?? 0, 2) }}</td>
                                <td class="px-6 py-4">
                                    @if ($previousMonth)
                                        @php $positionDiff = calculatePercentageDifference($rapport->avg_position, $previousMonth->avg_position); @endphp
                                        <span class="{{ $positionDiff >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ number_format($positionDiff, 2) }}%
                                        </span>
                                    @else
                                        Aucune comparaison
                                    @endif
                                </td>
                            </tr>

                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium">Nombre de Sessions</td>
                                <td class="px-6 py-4">{{ number_format($rapport->nb_sessions) }}</td>
                                <td class="px-6 py-4">{{ number_format($previousMonth->nb_sessions ?? 0) }}</td>
                                <td class="px-6 py-4">
                                    @if ($previousMonth)
                                        @php $sessionsDiff = calculatePercentageDifference($rapport->nb_sessions, $previousMonth->nb_sessions); @endphp
                                        <span class="{{ $sessionsDiff >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ number_format($sessionsDiff, 2) }}%
                                        </span>
                                    @else
                                        Aucune comparaison
                                    @endif
                                </td>
                            </tr>

                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium">Nombre d'Utilisateurs Actifs</td>
                                <td class="px-6 py-4">{{ number_format($rapport->nb_active_users) }}</td>
                                <td class="px-6 py-4">{{ number_format($previousMonth->nb_active_users ?? 0) }}</td>
                                <td class="px-6 py-4">
                                    @if ($previousMonth)
                                        @php $activeUsersDiff = calculatePercentageDifference($rapport->nb_active_users, $previousMonth->nb_active_users); @endphp
                                        <span class="{{ $activeUsersDiff >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ number_format($activeUsersDiff, 2) }}%
                                        </span>
                                    @else
                                        Aucune comparaison
                                    @endif
                                </td>
                            </tr>

                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium">Vitesse de la Page</td>
                                <td class="px-6 py-4">{{ $rapport->page_speed }} ms</td>
                                <td class="px-6 py-4">{{ $previousMonth->page_speed ?? 'Aucune donnée' }} ms</td>
                                <td class="px-6 py-4">
                                    @if ($previousMonth)
                                        @php $pageSpeedDiff = calculatePercentageDifference($rapport->page_speed, $previousMonth->page_speed); @endphp
                                        <span class="{{ $pageSpeedDiff >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ number_format($pageSpeedDiff, 2) }}%
                                        </span>
                                    @else
                                        Aucune comparaison
                                    @endif
                                </td>
                            </tr>

                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium">Performance</td>
                                <td class="px-6 py-4">{{ number_format($rapport->performance, 2) }}</td>
                                <td class="px-6 py-4">{{ number_format($previousMonth->performance ?? 0, 2) }}</td>
                                <td class="px-6 py-4">
                                    @if ($previousMonth)
                                        @php $performanceDiff = calculatePercentageDifference($rapport->performance, $previousMonth->performance); @endphp
                                        <span class="{{ $performanceDiff >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ number_format($performanceDiff, 2) }}%
                                        </span>
                                    @else
                                        Aucune comparaison
                                    @endif
                                </td>
                            </tr>

                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium">Accessibilité</td>
                                <td class="px-6 py-4">{{ number_format($rapport->accessibility, 2) }}</td>
                                <td class="px-6 py-4">{{ number_format($previousMonth->accessibility ?? 0, 2) }}</td>
                                <td class="px-6 py-4">
                                    @if ($previousMonth)
                                        @php $accessibilityDiff = calculatePercentageDifference($rapport->accessibility, $previousMonth->accessibility); @endphp
                                        <span class="{{ $accessibilityDiff >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ number_format($accessibilityDiff, 2) }}%
                                        </span>
                                    @else
                                        Aucune comparaison
                                    @endif
                                </td>
                            </tr>

                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium">Meilleures Pratiques</td>
                                <td class="px-6 py-4">{{ number_format($rapport->best_practices, 2) }}</td>
                                <td class="px-6 py-4">{{ number_format($previousMonth->best_practices ?? 0, 2) }}</td>
                                <td class="px-6 py-4">
                                    @if ($previousMonth)
                                        @php $bestPracticesDiff = calculatePercentageDifference($rapport->best_practices, $previousMonth->best_practices); @endphp
                                        <span class="{{ $bestPracticesDiff >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ number_format($bestPracticesDiff, 2) }}%
                                        </span>
                                    @else
                                        Aucune comparaison
                                    @endif
                                </td>
                            </tr>

                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-medium">SEO</td>
                                <td class="px-6 py-4">{{ number_format($rapport->seo, 2) }}</td>
                                <td class="px-6 py-4">{{ number_format($previousMonth->seo ?? 0, 2) }}</td>
                                <td class="px-6 py-4">
                                    @if ($previousMonth)
                                        @php $seoDiff = calculatePercentageDifference($rapport->seo, $previousMonth->seo); @endphp
                                        <span class="{{ $seoDiff >= 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ number_format($seoDiff, 2) }}%
                                        </span>
                                    @else
                                        Aucune comparaison
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Actions Section -->
                <div class="mt-6 flex justify-end space-x-4">
                    <a href="{{ route('rapports.index') }}"
                        class="inline-flex items-center bg-gray-600 text-white py-2 px-4 rounded-lg hover:bg-gray-700 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Retour aux Rapports
                    </a>
                    <a href="{{ route('rapport.pdf', $rapport->id_rapport) }}"
                        class="inline-flex items-center bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-download mr-2"></i> Télécharger PDF
                    </a>
                </div>
            </div>
        </div>

        <!-- Complementary Data Card -->
        <div class="mt-8 bg-white shadow-xl rounded-xl overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-500 text-white p-6">
                <h4 class="mb-0 flex items-center text-2xl font-semibold">
                    <i class="fas fa-chart-line mr-3"></i>
                    Données Complémentaires
                </h4>
            </div>

            <div class="p-6">
                @if ($top_keywords->isNotEmpty())
                    <div class="mb-8">
                        <h5 class="text-xl font-semibold text-gray-800 mb-4">Mots-clés Principaux</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($top_keywords as $keyword)
                                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                                    <p class="font-medium text-gray-900">{{ $keyword->keyword }}</p>
                                    <p class="text-sm text-gray-600">Position: {{ $keyword->position ?? 'N/A' }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($top_session_pages->isNotEmpty())
                    <div class="mb-8">
                        <h5 class="text-xl font-semibold text-gray-800 mb-4">Pages les Plus Visitées</h5>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($top_session_pages as $page)
                                <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                                    <p class="font-medium text-gray-900">{{ $page->url_page }}</p>
                                    <p class="text-sm text-gray-600">Sessions: {{ number_format($page->sessions ?? 0) }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                @if ($projet)
                    <div>
                        <h5 class="text-xl font-semibold text-gray-800 mb-4">Informations du Projet</h5>
                        <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                            <p class="text-gray-900"><strong>Nom:</strong> {{ $projet->nom_projet }}</p>
                            <p class="text-gray-900"><strong>Statut:</strong> {{ $projet->status }}</p>
                            <p class="text-gray-900"><strong>Description:</strong> {{ $projet->description }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
