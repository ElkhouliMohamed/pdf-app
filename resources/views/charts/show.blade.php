@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="max-w-7xl mx-auto p-6 mt-10 font-sans">
        <h1 class="text-4xl font-extrabold text-gray-900 mb-10 tracking-tight">Détails du Rapport</h1>

        <!-- Report Details -->
        <div
            class="bg-white p-6 rounded-xl shadow-lg mb-8 border-l-4 border-blue-500 transform hover:scale-[1.01] transition duration-200">
            <h3 class="text-2xl font-semibold text-gray-800 mb-4 flex items-center">
                <span class="mr-2">📌</span> Rapport pour : {{ $rapport->projet->nom_projet }}
            </h3>
            <p class="text-lg text-gray-600 mb-2"><strong class="text-gray-800">📅 Période :</strong>
                {{ $rapport->periode->format('F Y') }}</p>
            <p class="text-lg text-gray-600"><strong class="text-gray-800">📂 Nom De Rapport :</strong>
                {{ $rapport->nom_rapport }}</p>
        </div>

        <!-- Top Keywords Section -->
        <h3 class="text-2xl font-semibold text-gray-800 mb-6 ml-2 flex items-center">
            <span class="mr-2">🔍</span> Mots-Clés Principaux
        </h3>
        <ul class="space-y-4 mr-5 ml-5">
            @foreach ($topKeywords as $keyword)
                <li
                    class="bg-blue-50 p-4 rounded-lg shadow-sm flex justify-between items-center hover:bg-blue-100 transition duration-200">
                    <span class="text-gray-900 font-medium text-lg">#{{ $keyword->keyword }}</span>
                    <span
                        class="bg-blue-600 text-white text-sm font-semibold py-1 px-4 rounded-full">{{ $keyword->nombre_requetes }}
                        requêtes</span>
                </li>
            @endforeach
        </ul>

        <!-- Metrics Overview -->
        <div class="container mx-auto p-6">
            <h3 class="text-3xl font-bold text-gray-900 mb-10 text-center flex justify-center items-center">
                <span class="mr-2">📊</span> Aperçu des Métriques
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-10">
                @foreach ($metrics as $metric => $data)
                    <div
                        class="bg-gradient-to-r from-blue-600 to-indigo-600 p-6 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-2 transition duration-300 text-white">
                        <h5 class="text-xl font-semibold flex items-center">
                            <span class="mr-2">📌</span> {{ ucfirst(str_replace('_', ' ', $metric)) }}
                        </h5>
                        <p class="mt-4 text-lg"><strong class="font-medium">📈 Actuel :</strong> <span
                                class="font-bold text-yellow-200">{{ $data['current'] }}</span></p>
                        <p class="text-lg"><strong class="font-medium">📉 Précédent :</strong> <span
                                class="font-bold text-gray-100">{{ $data['previous'] }}</span></p>
                    </div>
                @endforeach
            </div>

            <!-- Chart for Metrics -->
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h4 class="text-xl font-semibold text-gray-800 mb-4 text-center">📈 Graphique des Métriques</h4>
                <canvas id="metricsChart" class="w-full h-80"></canvas>
            </div>
        </div>

        <!-- Charts Section -->
        <h3 class="text-2xl font-semibold text-gray-800 mb-6 flex items-center">
            <span class="mr-2">📊</span> Graphiques de Performance
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Chart for Total Clicks -->
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-200">
                <h4 class="text-xl font-semibold text-gray-800 mb-4">Clics Totaux</h4>
                <canvas id="clicksChart" height="200"></canvas>
            </div>

            <!-- Chart for Total Impressions -->
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-200">
                <h4 class="text-xl font-semibold text-gray-800 mb-4">Impressions Totales</h4>
                <canvas id="impressionsChart" height="200"></canvas>
            </div>

            <!-- Chart for Average CTR -->
            <div class="bg-white p-6 rounded-xl shadow-md md:col-span-2 hover:shadow-lg transition duration-200">
                <h4 class="text-xl font-semibold text-gray-800 mb-4">CTR Moyen (%)</h4>
                <canvas id="ctrChart" height="200"></canvas>
            </div>
        </div>
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
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('metricsChart').getContext('2d');
            const labels = @json(array_keys($metrics));
            const currentValues = @json(array_column($metrics, 'current'));
            const previousValues = @json(array_column($metrics, 'previous'));

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Actuel',
                        data: currentValues,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }, {
                        label: 'Précédent',
                        data: previousValues,
                        backgroundColor: 'rgba(201, 203, 207, 0.7)',
                        borderColor: 'rgba(201, 203, 207, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        title: {
                            display: true,
                            text: 'Comparaison des Métriques'
                        }
                    }
                }
            });
        });
    </script>
@endsection
