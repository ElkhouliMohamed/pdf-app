@extends('layouts.app')

@section('content')
    <div class="p-6 mt-5">
        <h1 class="text-center text-4xl font-semibold mb-6">Détails du Rapport</h1>
        <!-- Add a button for PDF download -->

        <!-- Rapport details card -->
        <div class="card shadow-lg rounded-lg">
            <div class="card-header bg-blue-600 text-white text-lg p-6">
                <h4 class="mb-0 flex items-center text-4xl">
                    <i class="fas fa-file-alt mr-3"></i> <!-- Font Awesome Icon -->
                    Informations du Rapport
                </h4>
            </div>

            <div class="card-body p-6">
                <!-- Rapport data table -->
                <table class="table table-bordered table-striped table-hover w-full text-lg">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-4 py-2 text-left">Champ</th>
                            <th class="px-4 py-2 text-left">Valeur</th>
                            <th class="px-4 py-2 text-left">Mois Précédent</th> <!-- Previous Month Column -->
                            <th class="px-4 py-2 text-left">Différence (%)</th> <!-- Difference Percentage Column -->
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Période</strong></td>
                            <td>{{ $rapport->periode->format('F Y') }}</td>
                            <td>
                                @php
                                    $previousMonth = \App\Models\Rapport::where(
                                        'periode',
                                        $rapport->periode->subMonth(),
                                    )->first();
                                @endphp
                                @if ($previousMonth)
                                    {{ $previousMonth->periode->format('F Y') }}
                                @else
                                    Aucune donnée
                                @endif
                            </td>
                            <td>
                                @if ($previousMonth)
                                    @php
                                        $difference =
                                            $rapport->periode->format('F Y') !== $previousMonth->periode->format('F Y')
                                                ? 'Données disponibles'
                                                : 'Aucune différence';
                                    @endphp
                                    {{ $difference }}
                                @else
                                    Aucune comparaison
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Nom du Rapport</strong></td>
                            <td>{{ $rapport->nom_rapport }}</td>
                            <td>{{ $previousMonth->nom_rapport ?? 'Aucune donnée' }}</td>
                            <td>
                                @if ($previousMonth)
                                    {{ $rapport->nom_rapport === $previousMonth->nom_rapport ? 'Identique' : 'Différent' }}
                                @else
                                    Aucune comparaison
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Clics Totaux</strong></td>
                            <td>{{ number_format($rapport->total_clicks) }}</td>
                            <td>{{ number_format($previousMonth->total_clicks ?? 0) }}</td>
                            <td>
                                @if ($previousMonth)
                                    @php
                                        $clicksDiff =
                                            (($rapport->total_clicks - $previousMonth->total_clicks) /
                                                $previousMonth->total_clicks) *
                                            100;
                                    @endphp
                                    {{ number_format($clicksDiff, 2) }}%
                                @else
                                    Aucune comparaison
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Impressions Totales</strong></td>
                            <td>{{ number_format($rapport->total_impressions) }}</td>
                            <td>{{ number_format($previousMonth->total_impressions ?? 0) }}</td>
                            <td>
                                @if ($previousMonth)
                                    @php
                                        $impressionsDiff =
                                            (($rapport->total_impressions - $previousMonth->total_impressions) /
                                                $previousMonth->total_impressions) *
                                            100;
                                    @endphp
                                    {{ number_format($impressionsDiff, 2) }}%
                                @else
                                    Aucune comparaison
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>CTR Moyen</strong></td>
                            <td>{{ number_format($rapport->avg_ctr, 2) }}%</td>
                            <td>{{ number_format($previousMonth->avg_ctr ?? 0, 2) }}%</td>
                            <td>
                                @if ($previousMonth)
                                    @php
                                        $ctrDiff =
                                            (($rapport->avg_ctr - $previousMonth->avg_ctr) / $previousMonth->avg_ctr) *
                                            100;
                                    @endphp
                                    {{ number_format($ctrDiff, 2) }}%
                                @else
                                    Aucune comparaison
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Position Moyenne</strong></td>
                            <td>{{ number_format($rapport->avg_position, 2) }}</td>
                            <td>{{ number_format($previousMonth->avg_position ?? 0, 2) }}</td>
                            <td>
                                @if ($previousMonth)
                                    @php
                                        $positionDiff =
                                            (($rapport->avg_position - $previousMonth->avg_position) /
                                                $previousMonth->avg_position) *
                                            100;
                                    @endphp
                                    {{ number_format($positionDiff, 2) }}%
                                @else
                                    Aucune comparaison
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Nombre de Sessions</strong></td>
                            <td>{{ number_format($rapport->nb_sessions) }}</td>
                            <td>{{ number_format($previousMonth->nb_sessions ?? 0) }}</td>
                            <td>
                                @if ($previousMonth)
                                    @php
                                        $sessionsDiff =
                                            (($rapport->nb_sessions - $previousMonth->nb_sessions) /
                                                $previousMonth->nb_sessions) *
                                            100;
                                    @endphp
                                    {{ number_format($sessionsDiff, 2) }}%
                                @else
                                    Aucune comparaison
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Nombre d'Utilisateurs Actifs</strong></td>
                            <td>{{ number_format($rapport->nb_active_users) }}</td>
                            <td>{{ number_format($previousMonth->nb_active_users ?? 0) }}</td>
                            <td>
                                @if ($previousMonth)
                                    @php
                                        $activeUsersDiff =
                                            (($rapport->nb_active_users - $previousMonth->nb_active_users) /
                                                $previousMonth->nb_active_users) *
                                            100;
                                    @endphp
                                    {{ number_format($activeUsersDiff, 2) }}%
                                @else
                                    Aucune comparaison
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Vitesse de la Page</strong></td>
                            <td>{{ $rapport->page_speed }} ms</td>
                            <td>{{ $previousMonth->page_speed ?? 'Aucune donnée' }} ms</td>
                            <td>
                                @if ($previousMonth)
                                    @php
                                        $pageSpeedDiff =
                                            (($rapport->page_speed - $previousMonth->page_speed) /
                                                $previousMonth->page_speed) *
                                            100;
                                    @endphp
                                    {{ number_format($pageSpeedDiff, 2) }}%
                                @else
                                    Aucune comparaison
                                @endif
                            </td>
                        </tr>
                        <!-- New rows for additional fields -->
                        <tr>
                            <td><strong>Performance</strong></td>
                            <td>{{ number_format($rapport->performance, 2) }}</td>
                            <td>{{ number_format($previousMonth->performance ?? 0, 2) }}</td>
                            <td>
                                @if ($previousMonth)
                                    @php
                                        $performanceDiff =
                                            (($rapport->performance - $previousMonth->performance) /
                                                $previousMonth->performance) *
                                            100;
                                    @endphp
                                    {{ number_format($performanceDiff, 2) }}%
                                @else
                                    Aucune comparaison
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Accessibilité</strong></td>
                            <td>{{ number_format($rapport->accessibility, 2) }}</td>
                            <td>{{ number_format($previousMonth->accessibility ?? 0, 2) }}</td>
                            <td>
                                @if ($previousMonth)
                                    @php
                                        $accessibilityDiff =
                                            (($rapport->accessibility - $previousMonth->accessibility) /
                                                $previousMonth->accessibility) *
                                            100;
                                    @endphp
                                    {{ number_format($accessibilityDiff, 2) }}%
                                @else
                                    Aucune comparaison
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Meilleures Pratiques</strong></td>
                            <td>{{ number_format($rapport->best_practices, 2) }}</td>
                            <td>{{ number_format($previousMonth->best_practices ?? 0, 2) }}</td>
                            <td>
                                @if ($previousMonth)
                                    @php
                                        $bestPracticesDiff =
                                            (($rapport->best_practices - $previousMonth->best_practices) /
                                                $previousMonth->best_practices) *
                                            100;
                                    @endphp
                                    {{ number_format($bestPracticesDiff, 2) }}%
                                @else
                                    Aucune comparaison
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><strong>SEO</strong></td>
                            <td>{{ number_format($rapport->seo, 2) }}</td>
                            <td>{{ number_format($previousMonth->seo ?? 0, 2) }}</td>
                            <td>
                                @if ($previousMonth)
                                    @php
                                        $seoDiff = (($rapport->seo - $previousMonth->seo) / $previousMonth->seo) * 100;
                                    @endphp
                                    {{ number_format($seoDiff, 2) }}%
                                @else
                                    Aucune comparaison
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- Actions section -->
                <div class="card-footer text-right">
                    <a href="{{ route('rapports.index') }}"
                        class="btn btn-secondary text-white bg-gray-500 hover:bg-gray-700 rounded-lg py-2 px-4 inline-flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i>Retour aux Rapports
                    </a>



                    

                </div>
            </div>
        </div>
    </div>
@endsection
