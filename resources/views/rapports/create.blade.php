@extends('layouts.app')

@section('content')
    <div class="container max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-4 mb-4">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Create a New Rapport</h1>

        <!-- Display Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger bg-red-100 text-red-700 p-4 rounded-lg mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('rapports.store') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Project Selection -->
            <div class="form-group">
                <label for="id_projet" class="text-gray-700">Select Project</label>
                <select name="id_projet" id="id_projet"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">Select a Project</option>
                    @foreach ($projets as $projet)
                        <option value="{{ $projet->id_projet }}">{{ $projet->nom_projet }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Rapport Name -->
            <div class="form-group">
                <label for="nom_rapport" class="text-gray-700">Rapport Name</label>
                <input type="text" name="nom_rapport" id="nom_rapport"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('nom_rapport') }}" required>
            </div>

            <!-- Periode -->
            <div class="form-group">
                <label for="periode" class="text-gray-700">Periode (Month-Year)</label>
                <input type="date" name="periode" id="periode"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('periode') }}" placeholder="YYYY-MM" required>
            </div>


            <!-- Total Clicks -->
            <div class="form-group">
                <label for="total_clicks" class="text-gray-700">Total Clicks</label>
                <input type="number" name="total_clicks" id="total_clicks"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('total_clicks') }}" required>
            </div>

            <!-- Total Impressions -->
            <div class="form-group">
                <label for="total_impressions" class="text-gray-700">Total Impressions</label>
                <input type="number" name="total_impressions" id="total_impressions"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('total_impressions') }}" required>
            </div>

            <!-- Average CTR -->
            <div class="form-group">
                <label for="avg_ctr" class="text-gray-700">Average CTR (%)</label>
                <input type="number" name="avg_ctr" id="avg_ctr"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('avg_ctr') }}" step="0.01" required>
            </div>

            <!-- Average Position -->
            <div class="form-group">
                <label for="avg_position" class="text-gray-700">Average Position</label>
                <input type="number" name="avg_position" id="avg_position"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('avg_position') }}" step="0.01" required>
            </div>

            <!-- Number of Sessions -->
            <div class="form-group">
                <label for="nb_sessions" class="text-gray-700">Number of Sessions</label>
                <input type="number" name="nb_sessions" id="nb_sessions"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('nb_sessions') }}" required>
            </div>

            <!-- Number of Active Users -->
            <div class="form-group">
                <label for="nb_active_users" class="text-gray-700">Number of Active Users</label>
                <input type="number" name="nb_active_users" id="nb_active_users"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('nb_active_users') }}" required>
            </div>

            <!-- Number of New Users -->
            <div class="form-group">
                <label for="nb_new_users" class="text-gray-700">Number of New Users</label>
                <input type="number" name="nb_new_users" id="nb_new_users"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('nb_new_users') }}" required>
            </div>

            <!-- Page Speed -->
            <div class="form-group">
                <label for="page_speed" class="text-gray-700">Page Speed</label>
                <input type="number" name="page_speed" id="page_speed"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('page_speed') }}" step="0.01" required>
            </div>

            <!-- Performance -->
            <div class="form-group">
                <label for="performance" class="text-gray-700">Performance</label>
                <input type="number" name="performance" id="performance"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('performance') }}" step="0.01" required>
            </div>

            <!-- Accessibility -->
            <div class="form-group">
                <label for="accessibility" class="text-gray-700">Accessibility</label>
                <input type="number" name="accessibility" id="accessibility"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('accessibility') }}" step="0.01" required>
            </div>

            <!-- Best Practices -->
            <div class="form-group">
                <label for="best_practices" class="text-gray-700">Best Practices</label>
                <input type="number" name="best_practices" id="best_practices"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('best_practices') }}" step="0.01" required>
            </div>

            <!-- SEO -->
            <div class="form-group">
                <label for="seo" class="text-gray-700">SEO</label>
                <input type="number" name="seo" id="seo"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('seo') }}" step="0.01" required>
            </div>

            <!-- Number of Backlinks -->
            <div class="form-group">
                <label for="nb_backlinks" class="text-gray-700">Number of Backlinks</label>
                <input type="number" name="nb_backlinks" id="nb_backlinks"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('nb_backlinks') }}" required>
            </div>

            <!-- Number of Orders -->
            <div class="form-group">
                <label for="nb_orders" class="text-gray-700">Number of Orders</label>
                <input type="number" name="nb_orders" id="nb_orders"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('nb_orders') }}" required>
            </div>

            <!-- Number of Carts -->
            <div class="form-group">
                <label for="nb_cart" class="text-gray-700">Number of Carts</label>
                <input type="number" name="nb_cart" id="nb_cart"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('nb_cart') }}" required>
            </div>

            <button type="submit"
                class="btn btn-primary mt-4 py-3 px-6 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">Create
                Rapport</button>
        </form>
    </div>
@endsection
