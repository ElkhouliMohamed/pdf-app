<!-- resources/views/erreurs404/show.blade.php -->
@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="container max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-xl mt-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Détails de l'Erreur 404</h1>

        <div class="space-y-6">
            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold text-gray-700">ID</h2>
                <p class="text-gray-800 text-lg">{{ $erreur->id_404 }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold text-gray-700">Nombre de 404s</h2>
                <p class="text-gray-800 text-lg">{{ $erreur->nb_404 }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold text-gray-700">Fichier</h2>
                <p class="text-gray-800 text-lg">{{ $erreur->file_data }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold text-gray-700">Rapport Assigné</h2>
                <p class="text-gray-800 text-lg">
                    {{ $erreur->rapport->nom_rapport ?? $erreur->rapport->id_rapport ?? 'Aucun Rapport Assigné' }}
                </p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold text-gray-700">Créé le</h2>
                <p class="text-gray-800 text-lg">{{ $erreur->created_at->format('d/m/Y H:i') }}</p>
            </div>

            <div class="bg-gray-50 p-4 rounded-lg shadow-sm">
                <h2 class="text-lg font-semibold text-gray-700">Mis à jour le</h2>
                <p class="text-gray-800 text-lg">{{ $erreur->updated_at->format('d/m/Y H:i') }}</p>
            </div>

            <div class="flex items-center space-x-4">
                <a href="{{ route('erreurs404.edit', $erreur->id_404) }}"
                   class="inline-flex items-center px-6 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition-colors duration-200 shadow-md">
                    <i class="fas fa-edit mr-2"></i> Modifier
                </a>
                <a href="{{ route('erreurs404.index') }}"
                   class="inline-flex items-center px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200 shadow-md">
                    <i class="fas fa-arrow-left mr-2"></i> Retour
                </a>
            </div>
        </div>
    </div>
@endsection