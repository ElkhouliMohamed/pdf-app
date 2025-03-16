@extends('layouts.app')

@section('content')
    <div class="container max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-4">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Top Keyword</h1>

        <form action="{{ route('topKeywords.update', $topKeyword->id_keyword) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT') <!-- Since this is an update request -->

            <!-- Keyword -->
            <div class="form-group">
                <label for="keyword" class="text-gray-700">Keyword</label>
                <input type="text" name="keyword" id="keyword"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('keyword', $topKeyword->keyword) }}" required>
                @error('keyword')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Nombre Requetes -->
            <div class="form-group">
                <label for="nombre_requetes" class="text-gray-700">Nombre Requetes</label>
                <input type="number" name="nombre_requetes" id="nombre_requetes"
                    class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500"
                    value="{{ old('nombre_requetes', $topKeyword->nombre_requetes) }}" required min="0">
                @error('nombre_requetes')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Assign to Rapport -->
            <div class="form-group">
                <label for="id_rapport" class="text-gray-700">Assign to Rapport</label>
                @if ($rapports_projets->isEmpty())
                    <p>No rapports available.</p>
                @else
                    <select name="id_rapport" id="id_rapport"
                        class="form-control w-full p-3 mt-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                        <option value="" disabled>Select Rapport</option>
                        @foreach ($rapports_projets as $rapport)
                            <option value="{{ $rapport->id_rapport }}"
                                {{ $topKeyword->id_rapport == $rapport->id_rapport ? 'selected' : '' }}>
                                {{ $rapport->nom_rapport }} - Project: {{ $rapport->projet->nom_projet }}
                            </option>
                        @endforeach
                    </select>
                @endif
                @error('id_rapport')
                    <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full py-3 px-6 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">
                Update Keyword
            </button>
        </form>
    </div>
@endsection
