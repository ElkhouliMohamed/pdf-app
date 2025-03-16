@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="max-w-7xl mx-auto p-6 mt-10">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">Détails du Rapport</h1>

        <!-- Report Details -->
        <div class="bg-gray-50 p-6 rounded-xl shadow-md mb-8">
            <h3 class="text-2xl font-semibold text-gray-800 mb-3">Rapport pour : {{ $rapport->projet->name }}</h3>
            <p class="text-lg text-gray-700"><strong>Période :</strong> {{ $rapport->periode->format('F Y') }}</p>
        </div>

        <!-- Metrics Overview -->
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Aperçu des Métriques</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
            @foreach ($metrics as $metric => $data)
                <div
                    class="bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-transform transform hover:-translate-y-1">
                    <h5 class="text-lg font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $metric)) }}</h5>
                    <p class="mt-2 text-gray-700"><strong>Actuel :</strong> <span
                            class="text-blue-600">{{ $data['current'] }}</span></p>
                    <p class="text-gray-700"><strong>Précédent :</strong> <span
                            class="text-gray-500">{{ $data['previous'] }}</span></p>
                </div>
            @endforeach
        </div>

        <!-- Charts Section -->
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Graphiques de Performance</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Chart for Total Clicks -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h4 class="text-xl font-semibold text-gray-800 mb-4">Clics Totaux</h4>
                <canvas id="clicksChart" height="200"></canvas>
            </div>

            <!-- Chart for Total Impressions -->
            <div class="bg-white p-6 rounded-xl shadow-md">
                <h4 class="text-xl font-semibold text-gray-800 mb-4">Impressions Totales</h4>
                <canvas id="impressionsChart" height="200"></canvas>
            </div>

            <!-- Chart for Average CTR -->
            <div class="bg-white p-6 rounded-xl shadow-md md:col-span-2">
                <h4 class="text-xl font-semibold text-gray-800 mb-4">CTR Moyen (%)</h4>
                <canvas id="ctrChart" height="200"></canvas>
            </div>
        </div>

        <!-- Top Keywords Section -->
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Mots-Clés Principaux</h3>
        <ul class="space-y-3">
            @foreach ($topKeywords as $keyword)
                <li class="bg-gray-50 p-4 rounded-lg shadow-sm flex justify-between items-center">
                    <span class="text-gray-900 font-medium">{{ $keyword->keyword }}</span>
                    <span
                        class="bg-blue-600 text-white text-sm font-semibold py-1 px-3 rounded-full">{{ $keyword->nombre_requetes }}
                        requêtes</span>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Prepare chart data
        const clicksData = @json($clicksData);
        const impressionsData = @json($impressionsData);
        const ctrData = @json($ctrData);

        // Total Clicks Chart
        new Chart(document.getElementById('clicksChart'), {
            type: 'bar',
            data: clicksData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Clics Totaux'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nombre de Clics'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Période'
                        }
                    }
                }
            }
        });

        // Total Impressions Chart
        new Chart(document.getElementById('impressionsChart'), {
            type: 'bar',
            data: impressionsData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Impressions Totales'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Nombre d\'Impressions'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Période'
                        }
                    }
                }
            }
        });

        // Average CTR Chart
        new Chart(document.getElementById('ctrChart'), {
            type: 'line',
            data: ctrData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'CTR Moyen (%)'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'CTR (%)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Période'
                        }
                    }
                }
            }
        });
    </script>
@endsection
