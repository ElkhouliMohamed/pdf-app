<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Rapport PDF</title>
    <style>
        /* Add custom styles for the PDF here */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Rapport - {{ $rapport->periode->format('F Y') }}</h1>

    <table>
        <thead>
            <tr>
                <th>Champ</th>
                <th>Valeur</th>
                <th>Mois Précédent</th>
                <th>Différence (%)</th>
            </tr>
        </thead>
        <tbody>
            <!-- Repeat the same table rows from the main view -->
            <tr>
                <td><strong>Période</strong></td>
                <td>{{ $rapport->periode->format('F Y') }}</td>
                <td>{{ $previousMonth ? $previousMonth->periode->format('F Y') : 'Aucune donnée' }}</td>
                <td>
                    @if ($previousMonth)
                        @php
                            $difference = $rapport->periode->format('F Y') !== $previousMonth->periode->format('F Y')
                                ? 'Données disponibles'
                                : 'Aucune différence';
                        @endphp
                        {{ $difference }}
                    @else
                        Aucune comparaison
                    @endif
                </td>
            </tr>
            <!-- Add the other rows here as needed -->
        </tbody>
    </table>
</body>
</html>
