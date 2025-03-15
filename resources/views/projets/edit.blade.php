<!-- resources/views/projets/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto p-5">
    <h1 class="text-3xl font-bold mb-5">Edit Projet</h1>

    <!-- Form for editing -->
    <form action="{{ route('projets.update', $projet->id_projet) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- PUT method for update -->

        <!-- Nom Projet -->
        <div class="mb-4">
            <label for="nom_projet" class="block text-lg font-semibold">Nom Projet</label>
            <input type="text" class="w-full p-3 border border-gray-300 rounded-md" id="nom_projet" name="nom_projet" value="{{ old('nom_projet', $projet->nom_projet) }}" required>
            @error('nom_projet')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Nom Siteweb -->
        <div class="mb-4">
            <label for="nom_siteweb" class="block text-lg font-semibold">Nom Siteweb</label>
            <input type="text" class="w-full p-3 border border-gray-300 rounded-md" id="nom_siteweb" name="nom_siteweb" value="{{ old('nom_siteweb', $projet->nom_siteweb) }}">
            @error('nom_siteweb')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Objectif -->
        <div class="mb-4">
            <label for="objectif" class="block text-lg font-semibold">Objectif</label>
            <textarea class="w-full p-3 border border-gray-300 rounded-md" id="objectif" name="objectif" rows="4">{{ old('objectif', $projet->objectif) }}</textarea>
            @error('objectif')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Image Upload -->
        <div class="mb-4">
            <label for="image_path" class="block text-lg font-semibold">Image</label>
            <input type="file" class="w-full p-3 border border-gray-300 rounded-md" id="image_path" name="image_path">
            @if ($projet->image_path)
                <div class="mt-2">
                    <strong>Current Image:</strong>
                    <img src="{{ asset('storage/' . $projet->image_path) }}" alt="Current Image" style="max-width: 200px;" class="mt-2">
                </div>
            @endif
            @error('image_path')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-green-500 text-white p-3 rounded-md hover:bg-green-600 transition duration-200">Update Projet</button>
    </form>

    <!-- Back to List -->
    <a href="{{ route('projets.index') }}" class="inline-block mt-5 text-blue-500 hover:text-blue-700">Back to List</a>
</div>
@endsection
