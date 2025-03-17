@extends('layouts.app')
@section('content')
    <div class="max-w-7xl mx-auto p-6 mt-10">
        <h1 class="text-3xl font-extrabold text-gray-900 mb-6">Ajouter une Nouvelle Page</h1>

        <div class="bg-white p-6 rounded-xl shadow-md">
            <form action="{{ route('topPages.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label for="url_page" class="block text-gray-700 font-semibold mb-2">URL de la Page</label>
                        <input type="text" name="url_page" id="url_page"
                            class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('url_page') }}" required>
                        @error('url_page')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="nombre_visites" class="block text-gray-700 font-semibold mb-2">Nombre de Visites</label>
                        <input type="number" name="nombre_visites" id="nombre_visites"
                            class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            value="{{ old('nombre_visites') }}" required>
                        @error('nombre_visites')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="id_rapport" class="block text-gray-700 font-semibold mb-2">Rapport</label>
                        <select name="id_rapport" id="id_rapport"
                            class="w-full p-3 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                            <option value="">Sélectionnez un rapport</option>
                            @foreach ($rapports as $rapport)
                                <option value="{{ $rapport->id_rapport }}"
                                    {{ old('id_rapport') == $rapport->id_rapport ? 'selected' : '' }}>
                                    {{ $rapport->nom_rapport ?? 'Rapport #' . $rapport->id_rapport }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_rapport')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">Créer</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
