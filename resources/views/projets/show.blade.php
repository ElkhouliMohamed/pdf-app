@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <!-- Project Title -->
        <h1 class="text-4xl font-bold text-gray-800 mb-6">{{ $projet->nom_projet }}</h1>

        <!-- Project Details -->
        <div class="mb-6">
            <p class="text-lg"><strong class="font-semibold">Nom du Site Web:</strong> {{ $projet->nom_siteweb ?? 'N/A' }}</p>
            <p class="text-lg"><strong class="font-semibold">Objectif:</strong> {{ $projet->objectif ?? 'N/A' }}</p>
        </div>

        <!-- Project Image -->
        @if ($projet->image_path)
            <div class="mt-3">
                <strong>Image:</strong><br>
                <img src="{{ asset('storage/' . $projet->image_path) }}" alt="Image" style="max-width: 400px;">
            </div>
        @endif


        <!-- Project Timestamps -->
        <div class="mt-6 space-y-2">
            <p class="text-lg"><strong class="font-semibold">Créé le:</strong> {{ $projet->created_at->format('d-m-Y') }}
            </p>
            <p class="text-lg"><strong class="font-semibold">Dernière mise à jour:</strong>
                {{ $projet->updated_at->format('d-m-Y') }}</p>
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('projets.index') }}"
                class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <i class="fas fa-arrow-left mr-2"></i> Retour à la liste
            </a>
        </div>
    </div>
@endsection
