<!-- resources/views/erreurs404/create.blade.php -->
@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="container max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-xl mt-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Ajouter une Erreur 404</h1>

        <!-- Display any success messages -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('erreurs404.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="nb_404" class="block text-gray-700 text-lg font-semibold mb-2">Nombre de 404s</label>
                <input type="number" name="nb_404" id="nb_404" value="{{ old('nb_404') }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                    required>
                @error('nb_404')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="file_data" class="block text-gray-700 text-lg font-semibold mb-2">Fichier</label>
                <input type="text" name="file_data" id="file_data" value="{{ old('file_data') }}"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                    maxlength="255" required>
                @error('file_data')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <label for="id_rapport" class="block text-gray-700 text-lg font-semibold mb-2">Rapport Assigné</label>
                <select name="id_rapport" id="id_rapport"
                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm"
                    required>
                    <option value="">Sélectionner un Rapport</option>
                    @foreach ($rapports as $rapport)
                        <option value="{{ $rapport->id_rapport }}"
                            {{ old('id_rapport') == $rapport->id_rapport ? 'selected' : '' }}>
                            {{ $rapport->nom_rapport ?? $rapport->id_rapport }}
                        </option>
                    @endforeach
                </select>
                @error('id_rapport')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex items-center space-x-4">
                <button type="submit"
                    class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 shadow-md">
                    <i class="fas fa-save mr-2"></i> Enregistrer
                </button>
                <a href="{{ route('erreurs404.index') }}"
                    class="inline-flex items-center px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200 shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i> Retour
                </a>
            </div>
        </form>
    </div>
@endsection
