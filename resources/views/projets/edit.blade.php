@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-xl rounded-xl mt-10 mb-5">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Modifier le Projet</h1>

        <!-- Form for editing -->
        <form action="{{ route('projets.update', $projet->id_projet) }}" method="POST" enctype="multipart/form-data"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nom Projet -->
            <div>
                <label for="nom_projet" class="block text-sm font-medium text-gray-700">Nom du Projet</label>
                <input type="text" id="nom_projet" name="nom_projet"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('nom_projet', $projet->nom_projet) }}" required>
                @error('nom_projet')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Nom Siteweb -->
            <div>
                <label for="nom_siteweb" class="block text-sm font-medium text-gray-700">Nom du Site Web</label>
                <input type="text" id="nom_siteweb" name="nom_siteweb"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('nom_siteweb', $projet->nom_siteweb) }}">
                @error('nom_siteweb')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Objectif -->
            <div>
                <label for="objectif" class="block text-sm font-medium text-gray-700">Objectif</label>
                <textarea id="objectif" name="objectif" rows="4"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">{{ old('objectif', $projet->objectif) }}</textarea>
                @error('objectif')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image_path" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" id="image_path" name="image_path"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                @if ($projet->image_path)
                    <div class="mt-3">
                        <p class="text-sm text-gray-600"><strong>Image Actuelle :</strong></p>
                        <img src="{{ asset('storage/' . $projet->image_path) }}" alt="Image Actuelle"
                            class="mt-2 rounded-lg shadow-sm max-w-xs">
                    </div>
                @endif
                @error('image_path')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full p-3 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors">
                    Mettre à Jour le Projet
                </button>
            </div>
        </form>

        <!-- Back to List -->
        <div class="mt-6">
            <a href="{{ route('projets.index') }}"
                class="inline-flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Retour à la Liste
            </a>
        </div>
    </div>
@endsection
