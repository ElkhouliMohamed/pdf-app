@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6 bg-white rounded-lg shadow-md mt-4">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Create New Session Page</h1>

        <form action="{{ route('topSessionPages.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="url_page" class="block text-lg font-medium text-gray-700">URL Page</label>
                <input type="text" name="url_page" id="url_page"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    value="{{ old('url_page') }}" required>
                @error('url_page')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="duree_moyenne" class="block text-lg font-medium text-gray-700">Average Duration</label>
                <input type="number" name="duree_moyenne" id="duree_moyenne"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    value="{{ old('duree_moyenne') }}" required>
                @error('duree_moyenne')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="id_rapport" class="block text-lg font-medium text-gray-700">Rapport</label>
                <select name="id_rapport" id="id_rapport"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500"
                    required>
                    <option value="">Select Rapport</option>
                    @foreach ($rapports as $rapport)
                        <option value="{{ $rapport->id_rapport }}"
                            {{ old('id_rapport') == $rapport->id_rapport ? 'selected' : '' }}>
                            {{ $rapport->nom_rapport }}
                        </option>
                    @endforeach
                </select>
                @error('id_rapport')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="w-full mt-4 px-6 py-3 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">Create</button>
        </form>
    </div>
@endsection
