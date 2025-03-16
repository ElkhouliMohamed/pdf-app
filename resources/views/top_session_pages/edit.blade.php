@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-xl rounded-xl mt-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Modifier la Page de Session</h1>

        <form action="{{ route('topSessionPages.update', $topSessionPage->id_session_page) }}" method="POST"
            class="space-y-6">
            @csrf
            @method('PUT')

            <!-- URL Page -->
            <div>
                <label for="url_page" class="block text-sm font-medium text-gray-700">URL de la Page</label>
                <input type="text" id="url_page" name="url_page"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('url_page', $topSessionPage->url_page) }}" required>
                @error('url_page')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Average Duration -->
            <div>
                <label for="duree_moyenne" class="block text-sm font-medium text-gray-700">Durée Moyenne</label>
                <input type="number" id="duree_moyenne" name="duree_moyenne"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    value="{{ old('duree_moyenne', $topSessionPage->duree_moyenne) }}" required>
                @error('duree_moyenne')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Rapport -->
            <div>
                <label for="id_rapport" class="block text-sm font-medium text-gray-700">Rapport</label>
                <select id="id_rapport" name="id_rapport"
                    class="mt-1 block w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                    required>
                    @foreach ($rapports as $rapport)
                        <option value="{{ $rapport->id_rapport }}"
                            {{ $rapport->id_rapport == $topSessionPage->id_rapport ? 'selected' : '' }}>
                            {{ $rapport->nom_rapport }}
                        </option>
                    @endforeach
                </select>
                @error('id_rapport')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full p-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors">
                    Mettre à Jour
                </button>
            </div>
        </form>
    </div>
@endsection
