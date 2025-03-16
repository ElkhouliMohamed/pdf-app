@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-xl rounded-xl mt-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Modifier le Rapport</h1>

        <form action="{{ route('rapports.update', $rapport->id_rapport) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Select Projet -->
            <div>
                <label for="id_projet" class="block text-sm font-medium text-gray-700">Sélectionner un Projet</label>
                <select id="id_projet" name="id_projet"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    @foreach ($projets as $projet)
                        <option value="{{ $projet->id_projet }}"
                            {{ $rapport->id_projet == $projet->id_projet ? 'selected' : '' }}>
                            {{ $projet->nom_projet }}
                        </option>
                    @endforeach
                </select>
                @error('id_projet')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Rapport Nom -->
            <div>
                <label for="nom_rapport" class="block text-sm font-medium text-gray-700">Nom du Rapport</label>
                <input type="text" id="nom_rapport" name="nom_rapport"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('nom_rapport', $rapport->nom_rapport) }}" required>
                @error('nom_rapport')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Rapport Periode -->
            <div>
                <label for="periode" class="block text-sm font-medium text-gray-700">Période (Mois)</label>
                <input type="month" id="periode" name="periode"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('periode', $rapport->periode->format('Y-m')) }}" required>
                @error('periode')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Total Clicks -->
            <div>
                <label for="total_clicks" class="block text-sm font-medium text-gray-700">Clics Totaux</label>
                <input type="number" id="total_clicks" name="total_clicks"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('total_clicks', $rapport->total_clicks) }}" required>
                @error('total_clicks')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Total Impressions -->
            <div>
                <label for="total_impressions" class="block text-sm font-medium text-gray-700">Impressions Totales</label>
                <input type="number" id="total_impressions" name="total_impressions"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('total_impressions', $rapport->total_impressions) }}" required>
                @error('total_impressions')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Average CTR -->
            <div>
                <label for="avg_ctr" class="block text-sm font-medium text-gray-700">CTR Moyen (%)</label>
                <input type="number" id="avg_ctr" name="avg_ctr" step="0.01"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('avg_ctr', $rapport->avg_ctr) }}" required>
                @error('avg_ctr')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Average Position -->
            <div>
                <label for="avg_position" class="block text-sm font-medium text-gray-700">Position Moyenne</label>
                <input type="number" id="avg_position" name="avg_position" step="0.01"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('avg_position', $rapport->avg_position) }}" required>
                @error('avg_position')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Number of Sessions -->
            <div>
                <label for="nb_sessions" class="block text-sm font-medium text-gray-700">Nombre de Sessions</label>
                <input type="number" id="nb_sessions" name="nb_sessions"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('nb_sessions', $rapport->nb_sessions) }}" required>
                @error('nb_sessions')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Number of Active Users -->
            <div>
                <label for="nb_active_users" class="block text-sm font-medium text-gray-700">Nombre d'Utilisateurs
                    Actifs</label>
                <input type="number" id="nb_active_users" name="nb_active_users"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('nb_active_users', $rapport->nb_active_users) }}" required>
                @error('nb_active_users')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Number of New Users -->
            <div>
                <label for="nb_new_users" class="block text-sm font-medium text-gray-700">Nombre de Nouveaux
                    Utilisateurs</label>
                <input type="number" id="nb_new_users" name="nb_new_users"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('nb_new_users', $rapport->nb_new_users) }}" required>
                @error('nb_new_users')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Page Speed -->
            <div>
                <label for="page_speed" class="block text-sm font-medium text-gray-700">Vitesse de la Page (ms)</label>
                <input type="number" id="page_speed" name="page_speed" step="0.01"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('page_speed', $rapport->page_speed) }}" required>
                @error('page_speed')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Performance -->
            <div>
                <label for="performance" class="block text-sm font-medium text-gray-700">Performance</label>
                <input type="number" id="performance" name="performance" step="0.01"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('performance', $rapport->performance) }}" required>
                @error('performance')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Accessibility -->
            <div>
                <label for="accessibility" class="block text-sm font-medium text-gray-700">Accessibilité</label>
                <input type="number" id="accessibility" name="accessibility" step="0.01"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('accessibility', $rapport->accessibility) }}" required>
                @error('accessibility')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Best Practices -->
            <div>
                <label for="best_practices" class="block text-sm font-medium text-gray-700">Meilleures Pratiques</label>
                <input type="number" id="best_practices" name="best_practices" step="0.01"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('best_practices', $rapport->best_practices) }}" required>
                @error('best_practices')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- SEO -->
            <div>
                <label for="seo" class="block text-sm font-medium text-gray-700">SEO</label>
                <input type="number" id="seo" name="seo" step="0.01"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('seo', $rapport->seo) }}" required>
                @error('seo')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Number of Backlinks -->
            <div>
                <label for="nb_backlinks" class="block text-sm font-medium text-gray-700">Nombre de Backlinks</label>
                <input type="number" id="nb_backlinks" name="nb_backlinks"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('nb_backlinks', $rapport->nb_backlinks) }}" required>
                @error('nb_backlinks')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Number of Orders -->
            <div>
                <label for="nb_orders" class="block text-sm font-medium text-gray-700">Nombre de Commandes</label>
                <input type="number" id="nb_orders" name="nb_orders"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('nb_orders', $rapport->nb_orders) }}" required>
                @error('nb_orders')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Number of Carts -->
            <div>
                <label for="nb_cart" class="block text-sm font-medium text-gray-700">Nombre de Paniers</label>
                <input type="number" id="nb_cart" name="nb_cart"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('nb_cart', $rapport->nb_cart) }}" required>
                @error('nb_cart')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full p-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                    Mettre à Jour le Rapport
                </button>
            </div>
        </form>
    </div>
@endsection
