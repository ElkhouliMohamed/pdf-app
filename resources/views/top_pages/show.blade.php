@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto p-6 mt-10">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-6">Détails de la Page</h1>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <div class="grid grid-cols-1 gap-4">
                <p><strong class="text-gray-700">URL de la Page :</strong> {{ $topPage->url_page }}</p>
                <p><strong class="text-gray-700">Nombre de Visites :</strong> {{ number_format($topPage->nombre_visites) }}</p>
                <p><strong class="text-gray-700">ID du Rapport :</strong> {{ $topPage->id_rapport }}</p>
                <p><strong class="text-gray-700">Créé le :</strong> {{ $topPage->created_at->format('d/m/Y H:i') }}</p>
                <p><strong class="text-gray-700">Mis à jour le :</strong> {{ $topPage->updated_at->format('d/m/Y H:i') }}</p>
            </div>

            <div class="mt-6 flex space-x-4">
                <a href="{{ route('topPages.edit', $topPage->id_page) }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition">Éditer</a>
                <a href="{{ route('topPages.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">Retour</a>
            </div>
        </div>
    </div>
@endsection