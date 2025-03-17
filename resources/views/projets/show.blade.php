@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="max-w-7xl mx-auto p-6 mt-10">
        <!-- Project Title -->
        <h1 class="text-4xl font-bold text-gray-900 mb-8">{{ $projet->nom_projet }}</h1>

        <!-- Project Details Card -->
        <div class="bg-white shadow-xl rounded-xl overflow-hidden mb-8">
            <div class="p-6">
                <!-- Project Details -->
                <div class="space-y-4">
                    <p class="text-lg text-gray-800">
                        <strong class="font-semibold">Nom du Site Web :</strong>
                        {{ $projet->nom_siteweb ?? 'N/A' }}
                    </p>
                    <p class="text-lg text-gray-800">
                        <strong class="font-semibold">Objectif :</strong>
                        {{ $projet->objectif ?? 'N/A' }}
                    </p>
                </div>

                <!-- Project Image -->
                @if ($projet->image_path)
                    <div class="mt-6">
                        <p class="text-lg text-gray-800"><strong class="font-semibold">Image :</strong></p>
                        <img src="{{ asset('storage/' . $projet->image_path) }}" alt="Image du Projet"
                            class="mt-2 rounded-lg shadow-sm max-w-md w-full">
                    </div>
                @endif

                <!-- Project Timestamps -->
                <div class="mt-6 space-y-2">
                    <p class="text-lg text-gray-800">
                        <strong class="font-semibold">Créé le :</strong>
                        {{ $projet->created_at->format('d-m-Y') }}
                    </p>
                    <p class="text-lg text-gray-800">
                        <strong class="font-semibold">Dernière mise à jour :</strong>
                        {{ $projet->updated_at->format('d-m-Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('projets.index') }}"
                class="inline-flex items-center bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Retour à la Liste
            </a>
        </div>
    </div>
    
@endsection
