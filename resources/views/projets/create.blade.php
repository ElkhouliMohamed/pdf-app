@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])
@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-8 w-full">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Create New Projet</h1>

        <form action="{{ route('projets.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Nom Projet -->
            <div class="mb-4">
                <label for="nom_projet" class="block text-sm font-medium text-gray-700">Nom Projet</label>
                <input type="text" class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="nom_projet" name="nom_projet" required>
            </div>

            <!-- Nom Siteweb -->
            <div class="mb-4">
                <label for="nom_siteweb" class="block text-sm font-medium text-gray-700">Nom Siteweb</label>
                <input type="text" class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="nom_siteweb" name="nom_siteweb">
            </div>

            <!-- Objectif -->
            <div class="mb-4">
                <label for="objectif" class="block text-sm font-medium text-gray-700">Objectif</label>
                <textarea class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="objectif" name="objectif" rows="4"></textarea>
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label for="image_path" class="block text-sm font-medium text-gray-700">Image</label>
                <input type="file" class="mt-1 p-3 w-full border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" id="image_path" name="image_path">
            </div>

            <button type="submit" class="w-full p-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">Create Projet</button>
        </form>
    </div>
@endsection
