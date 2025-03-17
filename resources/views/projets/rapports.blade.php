@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="max-w-7xl mx-auto p-6 mt-10">
        <h1 class="text-4xl font-bold text-gray-900 mb-8">Rapports pour {{ $projet->nom_projet }}</h1>

        @if ($rapports->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg shadow-md mb-8">
                Aucun rapport disponible pour ce projet.
            </div>
        @else
            <div class="overflow-x-auto bg-white shadow-xl rounded-xl">
                <table class="min-w-full border border-gray-200">
                    <thead class="bg-gradient-to-r from-gray-800 to-gray-700 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-lg font-semibold">#</th>
                            <th class="px-6 py-4 text-left text-lg font-semibold">Titre du Rapport</th>
                            <th class="px-6 py-4 text-left text-lg font-semibold">Période</th>
                            <th class="px-6 py-4 text-left text-lg font-semibold">Créé le</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rapports as $rapport)
                            <tr class="border-b hover:bg-gray-100 transition-colors cursor-pointer"
                                onclick="window.location.href='{{ route('rapports.show', $rapport->id_rapport) }}'">
                                <td class="px-6 py-4 text-gray-800 text-lg">{{ $rapport->id_rapport }}</td>
                                <td class="px-6 py-4 text-gray-800 text-lg">{{ $rapport->nom_rapport }}</td>
                                <td class="px-6 py-4 text-gray-800 text-lg">{{ $rapport->periode->format('d-m-Y') }}</td>
                                <td class="px-6 py-4 text-gray-800 text-lg">{{ $rapport->created_at->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        
    </div>
@endsection
