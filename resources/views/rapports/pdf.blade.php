<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Rapport - {{ $rapport->nom_rapport }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            font-size: 14px;
            color: #333;
            background-color: #fff;
            margin: 20mm;
            line-height: 1.6;
        }

        h1 {
            font-size: 24px;
            text-align: center;
            color: #1e3a8a;
            font-weight: 700;
            margin-bottom: 15px;
        }

        h2 {
            font-size: 18px;
            color: #1e40af;
            font-weight: 600;
            border-bottom: 2px solid #1e3a8a;
            padding-bottom: 5px;
            margin-top: 25px;
            margin-bottom: 10px;
        }

        p {
            margin: 8px 0;
            color: #444;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            background-color: #fff;
            border-radius: 6px;
            overflow: hidden;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f6fc;
            font-weight: bold;
            text-transform: uppercase;
        }

        td {
            background-color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tr:hover {
            background-color: #eef2ff;
        }

        .metric-comparison {
            font-weight: bold;
            text-align: center;
        }

        .positive {
            color: #16a34a;
            font-weight: bold;
        }

        .negative {
            color: #dc2626;
            font-weight: bold;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .grid-item {
            display: flex;
            justify-content: space-between;
            border: 1px solid #ddd;
            background-color: #f9fafb;
            padding: 10px;
            font-weight: 500;
            border-radius: 6px;
        }

        .header-container {
            text-align: center;
            margin-bottom: 25px;
        }

        .logo img {
            max-width: 120px;
            height: auto;
            margin-bottom: 10px;
        }

        a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 500;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <header>
        <div class="header-container">
            <div class="logo">
                @php
                    $imagePath = public_path('storage/images/' . ($projet->image_path ?? 'default.png'));
                    $defaultPath = public_path('storage/images/default.png');
                    $finalImagePath = file_exists($imagePath) ? $imagePath : $defaultPath;
                @endphp
                <h1>{{ $projet->nom_projet ?? 'Projet sans nom' }}</h1>
                <p>
                    <a href="{{ $projet->nom_siteweb ?? '#' }}">
                        {{ $projet->nom_siteweb ?? 'Site non spécifié' }}
                    </a>
                </p>
            </div>
        </div>
    </header>

    <h1>Rapport : {{ $rapport->nom_rapport }}</h1>
    <p>Période : {{ \Carbon\Carbon::parse($rapport->periode)->format('F Y') }}</p>

    <h2>Résumé</h2>
    <table>
        <thead>
            <tr>
                <th>Indicateur</th>
                <th>Ce Mois</th>
                <th>Le Mois Dernier</th>
                <th>État</th>
            </tr>
        </thead>
        <tbody>
            @php
                $metrics = [
                    'Total Clics' => ['total_clicks', ''],
                    'Total Impressions' => ['total_impressions', ''],
                    'CTR Moyen' => ['avg_ctr', '%'],
                    'Position Moyenne' => ['avg_position', ''],
                    'Sessions' => ['nb_sessions', ''],
                    'Utilisateurs Actifs' => ['nb_active_users', ''],
                    'Utilisateurs Nouveaux' => ['nb_new_users', ''],
                ];
            @endphp
            @foreach ($metrics as $label => [$field, $unit])
                <tr>
                    <th>{{ $label }}</th>
                    <td>{{ number_format($rapport->$field ?? 0, 2) }}{{ $unit }}</td>
                    <td>
                        @if ($previousMonth && $previousMonth->$field !== null)
                            {{ number_format($previousMonth->$field ?? 0, 2) }}{{ $unit }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="metric-comparison">
                        @if ($previousMonth && $previousMonth->$field !== null)
                            @php
                                $change =
                                    $field === 'avg_ctr' || $field === 'avg_position'
                                        ? $rapport->$field - $previousMonth->$field
                                        : (($rapport->$field - $previousMonth->$field) /
                                                ($previousMonth->$field ?: 1)) *
                                            100;
                            @endphp
                            {{ number_format($change, 2) }}%
                            @if ($change > 0)
                                <span class="positive">(+)</span>
                            @elseif ($change < 0)
                                <span class="negative">(-)</span>
                            @endif
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Top Keywords Section -->
    <h2>Top 10 Mots-Clés</h2>
    <table>
        <thead>
            <tr>
                <th>Mot-Clé</th>
                <th>Requêtes</th>
                <th>Requêtes Mois Dernier</th>
                <th><span class="metric-comparison">Différence (%)</span></th>
            </tr>
        </thead>
        <tbody>
            @forelse($topKeywords as $keyword)
                <tr>
                    <td>{{ $keyword->keyword ?? 'N/A' }}</td>
                    <td>{{ number_format($keyword->nombre_requetes ?? 0) }}</td>
                    <td>{{ number_format($keyword->previous_requetes ?? 0) }}</td>
                    <td class="metric-comparison">
                        @if ($keyword->previous_requetes !== null)
                            <span
                                class="{{ $keyword->evolution > 0 ? 'positive' : ($keyword->evolution < 0 ? 'negative' : 'neutral') }}">
                                {{ number_format($keyword->evolution, 2) }}%
                                @if ($keyword->evolution > 0)
                                    (+)
                                @elseif ($keyword->evolution < 0)
                                    (-)
                                @endif
                            </span>
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="empty">Aucun mot-clé disponible</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Top Pages Section -->
    <h2>Top 10 Pages</h2>
    <table>
        <thead>
            <tr>
                <th>URL de la Page</th>
                <th>Nombre de Visites</th>
                <th>Visites Mois Dernier</th>
                <th><span class="metric-comparison">Différence (%)</span></th>
            </tr>
        </thead>
        <tbody>
            @forelse($topPages as $page)
                <tr>
                    <td>{{ $page->url_page ?? 'N/A' }}</td>
                    <td>{{ number_format($page->nombre_visites ?? 0) }}</td>
                    <td>{{ number_format($page->previous_visites ?? 0) }}</td>
                    <td class="metric-comparison">
                        @if ($page->previous_visites !== null)
                            <span
                                class="{{ $page->evolution > 0 ? 'positive' : ($page->evolution < 0 ? 'negative' : 'neutral') }}">
                                {{ number_format($page->evolution, 2) }}%
                                @if ($page->evolution > 0)
                                    (+)
                                @elseif ($page->evolution < 0)
                                    (-)
                                @endif
                            </span>
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="empty">Aucune Top Page disponible</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Top Session Pages Section -->
    <h2>Top 10 Pages de Session</h2>
    <table>
        <thead>
            <tr>
                <th>Page</th>
                <th>Durée Moyenne</th>
                <th>Durée Moyenne Mois Dernier</th>
                <th><span class="metric-comparison">Différence (%)</span></th>
            </tr>
        </thead>
        <tbody>
            @forelse($topSessionPages as $sessionPage)
                <tr>
                    <td>{{ $sessionPage->url_page ?? 'N/A' }}</td>
                    <td>{{ number_format($sessionPage->duree_moyenne ?? 0, 2) }}s</td>
                    <td>
                        @if ($previousMonth && $previousMonth->topSessionPages->contains('url_page', $sessionPage->url_page))
                            {{ number_format($previousMonth->topSessionPages->firstWhere('url_page', $sessionPage->url_page)->duree_moyenne ?? 0, 2) }}s
                        @else
                            N/A
                        @endif
                    </td>
                    <td class="metric-comparison">
                        @if ($previousMonth && $previousMonth->topSessionPages->contains('url_page', $sessionPage->url_page))
                            @php
                                $prevValue =
                                    $previousMonth->topSessionPages->firstWhere('url_page', $sessionPage->url_page)
                                        ->duree_moyenne ?? 0;
                                $change = $prevValue
                                    ? (($sessionPage->duree_moyenne - $prevValue) / $prevValue) * 100
                                    : ($sessionPage->duree_moyenne > 0
                                        ? 100
                                        : 0);
                            @endphp
                            {{ number_format($change, 2) }}%
                            @if ($change > 0)
                                <span class="positive">(+)</span>
                            @elseif ($change < 0)
                                <span class="negative">(-)</span>
                            @endif
                        @else
                            N/A
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="empty">Aucune page de session disponible</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Complementary Data Section -->
    <h2>Données Complémentaires</h2>

    @if ($topKeywords->count() > 0)
        <h2>Mots-Clés Principaux</h2>
        <div class="grid">
            @foreach ($topKeywords as $keyword)
                <div class="grid-item">
                    <div>{{ $keyword->keyword ?? 'N/A' }}</div>
                    <div>{{ number_format($keyword->nombre_requetes ?? 0) }}</div>
                </div>
            @endforeach
        </div>
    @endif

    @if ($topPages->count() > 0)
        <h2>Pages les Plus Visitées</h2>
        <div class="grid">
            @foreach ($topPages as $page)
                <div class="grid-item">
                    <div>{{ $page->url_page ?? 'N/A' }}</div>
                    <div>{{ number_format($page->nombre_visites ?? 0) }}</div>
                </div>
            @endforeach
        </div>
    @endif

    @if ($topSessionPages->count() > 0)
        <h2>Pages avec Sessions les Plus Longues</h2>
        <div class="grid">
            @foreach ($topSessionPages as $sessionPage)
                <div class="grid-item">
                    <div>{{ $sessionPage->url_page ?? 'N/A' }}</div>
                    <div>{{ number_format($sessionPage->duree_moyenne ?? 0, 2) }}s</div>
                </div>
            @endforeach
        </div>
    @endif

    @if ($projet)
        <h2>Informations du Projet</h2>
        <div class="grid">
            <div class="grid-item">
                <div>Nom</div>
                <div>{{ $projet->nom_projet ?? 'N/A' }}</div>
            </div>
            <div class="grid-item">
                <div>Objectif</div>
                <div>{{ $projet->objectif ?? 'Aucun objectif' }}</div>
            </div>
        </div>
    @endif

</body>

</html>
