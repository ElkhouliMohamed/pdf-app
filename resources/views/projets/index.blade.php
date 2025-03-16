@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="container max-w-7xl mx-auto p-6 bg-white rounded-xl shadow-xl mt-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Liste des Projets</h1>

        <!-- Create New Project Button -->
        <a href="{{ route('projets.create') }}"
            class="bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 mb-6 inline-flex items-center transition-colors">
            <i class="fas fa-plus mr-2"></i> Créer un Nouveau Projet
        </a>

        @if ($projets->isEmpty())
            <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg mb-6 shadow-md">
                Aucun projet disponible.
            </div>
        @else
            <!-- Table Container -->
            <div class="overflow-x-auto shadow-lg rounded-lg">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead class="bg-gradient-to-r from-gray-800 to-gray-700 text-white">
                        <tr>
                            <th class="px-6 py-4 text-left text-lg font-semibold">#</th>
                            <th class="px-6 py-4 text-left text-lg font-semibold">Nom du Projet</th>
                            <th class="px-6 py-4 text-left text-lg font-semibold">Description</th>
                            <th class="px-6 py-4 text-left text-lg font-semibold">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($projets as $projet)
                            <tr class="border-b hover:bg-gray-100 transition-colors duration-200">
                                <td class="px-6 py-4 text-gray-800 text-lg">{{ $projet->id_projet }}</td>
                                <td class="px-6 py-4 text-gray-800 text-lg">{{ $projet->nom_projet }}</td>
                                <td class="px-6 py-4 text-gray-800 text-lg">{{ $projet->objectif }}</td>
                                <td class="px-6 py-4 flex space-x-4">
                                    <!-- View Action -->
                                    <a href="{{ route('projets.show', $projet->id_projet) }}"
                                        class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                                        <i class="fas fa-eye mr-1"></i> Voir
                                    </a>

                                    <!-- Edit Action -->
                                    <a href="{{ route('projets.edit', $projet->id_projet) }}"
                                        class="flex items-center text-yellow-600 hover:text-yellow-800 transition-colors">
                                        <i class="fas fa-edit mr-1"></i> Modifier
                                    </a>



                                    <!-- View Reports Action -->
                                    <a href="{{ route('projets.rapports', $projet->id_projet) }}"
                                        class="flex items-center text-green-600 hover:text-green-800 transition-colors">
                                        <i class="fas fa-file-alt mr-1"></i> Voir les Rapports
                                    </a>

                                    <!-- Delete Action with SweetAlert -->
                                    <form action="{{ route('projets.destroy', $projet->id_projet) }}" method="POST"
                                        class="inline delete-form" data-id="{{ $projet->id_projet }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="flex items-center text-red-600 hover:text-red-800 transition-colors delete-btn">
                                            <i class="fas fa-trash-alt mr-1"></i> Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
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
                                'Le projet a été supprimé.',
                                'success'
                            );
                        }
                    });
                });
            });
        });
    </script>
@endsection
