@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-semibold text-gray-800 mb-6">Projets</h1>

        <a href="{{ route('projets.create') }}"
            class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-4 inline-block">
            <i class="fas fa-plus mr-2"></i> Create New Projet
        </a>

        @if ($projets->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded-md mb-6">
                No projets available.
            </div>
        @else
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">#</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Nom Projet</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700">Description</th>
                            <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projets as $projet)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $projet->id_projet }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $projet->nom_projet }}</td>
                                <td class="px-4 py-2 text-sm text-gray-800">{{ $projet->objectif }}</td>
                                <td class="px-4 py-2 text-sm flex justify-evenly">
                                    <a href="{{ route('projets.show', $projet->id_projet) }}"
                                        class="bg-blue-500 text-white py-1 px-3 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <i class="fas fa-eye mr-2"></i> View
                                    </a>
                                    <a href="{{ route('projets.edit', $projet->id_projet) }}"
                                        class="bg-yellow-500 text-white py-1 px-3 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                        <i class="fas fa-edit mr-2"></i> Edit
                                    </a>
                                    <form action="{{ route('projets.destroy', $projet->id_projet) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-red-500 text-white py-1 px-3 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500"
                                            onclick="return confirm('Are you sure you want to delete this projet?')">
                                            <i class="fas fa-trash-alt mr-2"></i> Delete
                                        </button>
                                    </form>
                                    <!-- New button to view reports -->
                                    <a href="{{ route('projets.rapports', $projet->id_projet) }}"
                                        class="bg-green-500 text-white py-1 px-3 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
                                        <i class="fas fa-file-alt mr-2"></i> View Reports
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
