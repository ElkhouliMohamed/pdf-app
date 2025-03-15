@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white shadow-lg rounded-lg mt-8 w-full">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Rapports List</h1>

        <!-- Table Styling -->
        <div class="overflow-x-auto shadow-md rounded-lg ">
            <table class="min-w-full bg-white border border-gray-300 table-auto">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-4 py-3 text-left text-xl font-semibold text-gray-600">Project</th>
                        <th class="px-4 py-3 text-left text-xl font-semibold text-gray-600">Nom Rapport</th>
                        <th class="px-4 py-3 text-left text-xl font-semibold text-gray-600">Periode</th>
                        <th class="px-4 py-3 text-left text-xl font-semibold text-gray-600"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rapports as $rapport)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2 text-xl text-gray-700">{{ $rapport->projet->nom_projet }}</td>
                            <td class="px-4 py-2 text-xl text-gray-700">{{ $rapport->nom_rapport }}</td>
                            <td class="px-4 py-2 text-xl text-gray-700">{{ $rapport->periode->format('F Y') }}</td>
                            <td class="px-4 py-2 text-xl text-gray-700">
                                <!-- View Action with Icon -->
                                <a href="{{ route('rapports.show', $rapport->id_rapport) }}"
                                    class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-eye"></i> View
                                </a>

                                <!-- Edit Action with Icon -->
                                <a href="{{ route('rapports.edit', $rapport->id_rapport) }}"
                                    class="text-yellow-600 hover:text-yellow-800 ml-4">
                                    <i class="fas fa-edit"></i> Edit
                                </a>

                                <!-- Delete Action with Icon -->
                                <form action="{{ route('rapports.destroy', $rapport->id_rapport) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 ml-4">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
