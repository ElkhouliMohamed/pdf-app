@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="max-w-7xl mx-auto p-6 bg-white shadow-xl rounded-xl mt-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Liste des Rapports</h1>

        <!-- Table Container -->
        <div class="overflow-x-auto shadow-lg rounded-lg">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gradient-to-r from-gray-800 to-gray-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-lg font-semibold">Projet</th>
                        <th class="px-6 py-4 text-left text-lg font-semibold">Nom du Rapport</th>
                        <th class="px-6 py-4 text-left text-lg font-semibold">Période</th>
                        <th class="px-6 py-4 text-left text-lg font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rapports as $rapport)
                        <tr class="border-b hover:bg-gray-100 transition-colors duration-200">
                            <td class="px-6 py-4 text-gray-800 text-lg">{{ $rapport->projet->nom_projet }}</td>
                            <td class="px-6 py-4 text-gray-800 text-lg">{{ $rapport->nom_rapport }}</td>
                            <td class="px-6 py-4 text-gray-800 text-lg">{{ $rapport->periode->format('F Y') }}</td>
                            <td class="px-6 py-4 flex space-x-4">
                                <!-- View Action -->
                                <a href="{{ route('rapports.show', $rapport->id_rapport) }}"
                                    class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                                    <i class="fas fa-eye mr-1"></i> Voir
                                </a>
                                <a href="{{ route('chart-data.show', $rapport->id_rapport) }}"
                                    class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                                    <i class="fas fa-chart-line mr-1"></i> Graphique
                                </a>

                                <!-- Edit Action -->
                                <a href="{{ route('rapports.edit', $rapport->id_rapport) }}"
                                    class="flex items-center text-yellow-600 hover:text-yellow-800 transition-colors">
                                    <i class="fas fa-edit mr-1"></i> Modifier
                                </a>

                                <!-- Delete Action with SweetAlert -->
                                <form action="{{ route('rapports.destroy', $rapport->id_rapport) }}" method="POST"
                                    class="inline delete-form" data-id="{{ $rapport->id_rapport }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="flex items-center mt-2 text-red-600 hover:text-red-800 transition-colors delete-btn">
                                        <i class="fas fa-trash-alt mr-1"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500 text-lg">
                                Aucun rapport trouvé.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert2 Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const form = this.closest('.delete-form');

                    Swal.fire({
                        title: 'Êtes-vous sûr ?',
                        text: "Vous ne pourrez pas revenir en arrière !",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Oui, supprimer !',
                        cancelButtonText: 'Annuler'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                            Swal.fire(
                                'Supprimé !',
                                'Le rapport a été supprimé.',
                                'success'
                            );
                        }
                    });
                });
            });
        });
    </script>
@endsection
