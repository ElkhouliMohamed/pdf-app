@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-8 w-full">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Rapport</h1>

        <form action="{{ route('rapports.update', $rapport->id_rapport) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Select Projet -->
            <div class="mb-4">
                <label for="id_projet" class="block text-sm font-medium text-gray-700">Select Projet</label>
                <select id="id_projet" name="id_projet" class="mt-1 p-3 w-full border border-gray-300 rounded-md">
                    @foreach ($projets as $projet)
                        <option value="{{ $projet->id_projet }}" 
                            {{ $rapport->id_projet == $projet->id_projet ? 'selected' : '' }}>
                            {{ $projet->nom_projet }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Rapport Nom -->
            <div class="mb-4">
                <label for="nom_rapport" class="block text-sm font-medium text-gray-700">Nom Rapport</label>
                <input type="text" id="nom_rapport" name="nom_rapport" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('nom_rapport', $rapport->nom_rapport) }}" required>
            </div>

            <!-- Rapport Periode -->
            <div class="mb-4">
                <label for="periode" class="block text-sm font-medium text-gray-700">Periode (Month)</label>
                <input type="date" id="periode" name="periode" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('periode', $rapport->periode) }}" required>
            </div>

            <!-- Total Clicks -->
            <div class="mb-4">
                <label for="total_clicks" class="block text-sm font-medium text-gray-700">Total Clicks</label>
                <input type="number" id="total_clicks" name="total_clicks" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('total_clicks', $rapport->total_clicks) }}" required>
            </div>

            <!-- Total Impressions -->
            <div class="mb-4">
                <label for="total_impressions" class="block text-sm font-medium text-gray-700">Total Impressions</label>
                <input type="number" id="total_impressions" name="total_impressions" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('total_impressions', $rapport->total_impressions) }}" required>
            </div>

            <!-- Average CTR -->
            <div class="mb-4">
                <label for="avg_ctr" class="block text-sm font-medium text-gray-700">Average CTR</label>
                <input type="number" id="avg_ctr" name="avg_ctr" step="0.01" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('avg_ctr', $rapport->avg_ctr) }}" required>
            </div>

            <!-- Average Position -->
            <div class="mb-4">
                <label for="avg_position" class="block text-sm font-medium text-gray-700">Average Position</label>
                <input type="number" id="avg_position" name="avg_position" step="0.01" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('avg_position', $rapport->avg_position) }}" required>
            </div>

            <!-- Number of Sessions -->
            <div class="mb-4">
                <label for="nb_sessions" class="block text-sm font-medium text-gray-700">Number of Sessions</label>
                <input type="number" id="nb_sessions" name="nb_sessions" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('nb_sessions', $rapport->nb_sessions) }}" required>
            </div>

            <!-- Number of Active Users -->
            <div class="mb-4">
                <label for="nb_active_users" class="block text-sm font-medium text-gray-700">Number of Active Users</label>
                <input type="number" id="nb_active_users" name="nb_active_users" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('nb_active_users', $rapport->nb_active_users) }}" required>
            </div>

            <!-- Number of New Users -->
            <div class="mb-4">
                <label for="nb_new_users" class="block text-sm font-medium text-gray-700">Number of New Users</label>
                <input type="number" id="nb_new_users" name="nb_new_users" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('nb_new_users', $rapport->nb_new_users) }}" required>
            </div>

            <!-- Page Speed -->
            <div class="mb-4">
                <label for="page_speed" class="block text-sm font-medium text-gray-700">Page Speed</label>
                <input type="number" id="page_speed" name="page_speed" step="0.01" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('page_speed', $rapport->page_speed) }}" required>
            </div>

            <!-- Performance -->
            <div class="mb-4">
                <label for="performance" class="block text-sm font-medium text-gray-700">Performance</label>
                <input type="number" id="performance" name="performance" step="0.01" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('performance', $rapport->performance) }}" required>
            </div>

            <!-- Accessibility -->
            <div class="mb-4">
                <label for="accessibility" class="block text-sm font-medium text-gray-700">Accessibility</label>
                <input type="number" id="accessibility" name="accessibility" step="0.01" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('accessibility', $rapport->accessibility) }}" required>
            </div>

            <!-- Best Practices -->
            <div class="mb-4">
                <label for="best_practices" class="block text-sm font-medium text-gray-700">Best Practices</label>
                <input type="number" id="best_practices" name="best_practices" step="0.01" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('best_practices', $rapport->best_practices) }}" required>
            </div>

            <!-- SEO -->
            <div class="mb-4">
                <label for="seo" class="block text-sm font-medium text-gray-700">SEO</label>
                <input type="number" id="seo" name="seo" step="0.01" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('seo', $rapport->seo) }}" required>
            </div>

            <!-- Number of Backlinks -->
            <div class="mb-4">
                <label for="nb_backlinks" class="block text-sm font-medium text-gray-700">Number of Backlinks</label>
                <input type="number" id="nb_backlinks" name="nb_backlinks" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('nb_backlinks', $rapport->nb_backlinks) }}" required>
            </div>

            <!-- Number of Orders -->
            <div class="mb-4">
                <label for="nb_orders" class="block text-sm font-medium text-gray-700">Number of Orders</label>
                <input type="number" id="nb_orders" name="nb_orders" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('nb_orders', $rapport->nb_orders) }}" required>
            </div>

            <!-- Number of Carts -->
            <div class="mb-4">
                <label for="nb_cart" class="block text-sm font-medium text-gray-700">Number of Carts</label>
                <input type="number" id="nb_cart" name="nb_cart" class="mt-1 p-3 w-full border border-gray-300 rounded-md" value="{{ old('nb_cart', $rapport->nb_cart) }}" required>
            </div>

            <button type="submit" class="w-full p-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Update Rapport</button>
        </form>
    </div>
@endsection
