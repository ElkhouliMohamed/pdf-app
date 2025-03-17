<!-- resources/views/erreurs404/index.blade.php -->
@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="container max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-xl mt-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Liste des Erreurs 404</h1>

        <!-- Display any success messages -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table Container -->
        <div class="overflow-x-auto shadow-lg rounded-lg">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gradient-to-r from-gray-800 to-gray-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-lg font-semibold">ID</th>
                        <th class="px-6 py-4 text-left text-lg font-semibold">Nombre de 404s</th>
                        <th class="px-6 py-4 text-left text-lg font-semibold">Fichier</th>
                        <th class="px-6 py-4 text-left text-lg font-semibold">Rapport Assigné</th>
                        <th class="px-6 py-4 text-left text-lg font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($erreurs as $erreur)
                        <tr class="border-b hover:bg-gray-100 transition-colors duration-200">
                            <td class="px-6 py-4 text-gray-800 text-lg">{{ $erreur->id_404 }}</td>
                            <td class="px-6 py-4 text-gray-800 text-lg">{{ $erreur->nb_404 }}</td>
                            <td class="px-6 py-4 text-gray-800 text-lg">{{ $erreur->file_data }}</td>
                            <td class="px-6 py-4 text-gray-800 text-lg">
                                @if ($erreur->rapport)
                                    {{ $erreur->rapport->nom_rapport ?? $erreur->rapport->id_rapport }}
                                @else
                                    Aucun Rapport Assigné
                                @endif
                            </td>
                            <td class="px-6 py-4 flex space-x-4">
                                <a href="{{ route('erreurs404.show', $erreur->id_404) }}"
                                    class="flex items-center text-blue-600 hover:text-blue-800 transition-colors">
                                    <i class="fas fa-eye mr-1"></i> Voir
                                </a>
                                <a href="{{ route('erreurs404.edit', $erreur->id_404) }}"
                                    class="flex items-center text-yellow-600 hover:text-yellow-800 transition-colors">
                                    <i class="fas fa-edit mr-1"></i> Modifier
                                </a>
                                <button type="button"
                                    class="flex items-center text-red-600 hover:text-red-800 transition-colors delete-btn"
                                    data-id="{{ $erreur->id_404 }}"
                                    data-url="{{ route('erreurs404.destroy', $erreur->id_404) }}">
                                    <i class="fas fa-trash-alt mr-1"></i> Supprimer
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500 text-lg">
                                Aucune erreur 404 trouvée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Add New Button -->
        <div class="mt-6">
            <a href="{{ route('erreurs404.create') }}"
                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors duration-200 shadow-md">
                <i class="fas fa-plus mr-2"></i> Ajouter une Erreur 404
            </a>
        </div>
    </div>

    <!-- Include SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert2 Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-btn');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const url = this.getAttribute('data-url');

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
                            // Create a form to simulate the DELETE request
                            let form = document.createElement('form');
                            form.method = 'POST';
                            form.action = url;

                            // Add CSRF token
                            let csrfInput = document.createElement('input');
                            csrfInput.type = 'hidden';
                            csrfInput.name = '_token';
                            csrfInput.value = '{{ csrf_token() }}';

                            // Add DELETE method
                            let methodInput = document.createElement('input');
                            methodInput.type = 'hidden';
                            methodInput.name = '_method';
                            methodInput.value = 'DELETE';

                            // Append inputs and submit
                            form.appendChild(csrfInput);
                            form.appendChild(methodInput);
                            document.body.appendChild(form);
                            form.submit();

                            Swal.fire(
                                'Supprimé !',
                                "L'erreur 404 a été supprimée.",
                                'success'
                            );
                        }
                    });
                });
            });
        });
    </script>
@endsection
