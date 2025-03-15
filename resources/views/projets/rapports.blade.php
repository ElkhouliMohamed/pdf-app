@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-4xl font-semibold text-gray-800 mb-6">Reports for {{ $projet->nom_projet }}</h1>

        @if ($rapports->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded-md mb-6">
                No reports available for this project.
            </div>
        @else
            <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                <table class="min-w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="px-4 py-2 text-left text-lg font-semibold text-gray-700">#</th>
                            <th class="px-4 py-2 text-left text-lg font-semibold text-gray-700">Report Title</th>
                            <th class="px-4 py-2 text-left text-lg font-semibold text-gray-700">Period</th>
                            <th class="px-4 py-2 text-left text-lg font-semibold text-gray-700">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rapports as $rapport)
                            <tr class="border-b hover:bg-gray-50 cursor-pointer"
                                onclick="window.location.href='{{ route('rapport.show', $rapport->id_rapport) }}'">
                                <td class="px-4 py-2 text-lg text-gray-800">{{ $rapport->id_rapport }}</td>
                                <td class="px-4 py-2 text-lg text-gray-800">{{ $rapport->nom_rapport }}</td>
                                <td class="px-4 py-2 text-lg text-gray-800">{{ $rapport->periode->format('d-m-Y') }}</td>
                                <td class="px-4 py-2 text-lg text-gray-800">{{ $rapport->created_at->format('d-m-Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
