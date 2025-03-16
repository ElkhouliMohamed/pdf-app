@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="max-w-4xl mx-auto p-6 bg-white shadow-xl rounded-xl mt-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Pages de Session les Plus Visitées</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg shadow-md mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Add New Button -->
        <a href="{{ route('topSessionPages.create') }}"
            class="inline-flex items-center bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 mb-6 transition-colors">
            <i class="fas fa-plus mr-2"></i> Ajouter une Nouvelle Page de Session
        </a>

        <div class="overflow-x-auto shadow-lg rounded-lg">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gradient-to-r from-gray-800 to-gray-700 text-white">
                    <tr>
                        <th class="px-6 py-4 text-left text-lg font-semibold">URL de la Page</th>
                        <th class="px-6 py-4 text-left text-lg font-semibold">Durée Moyenne</th>
                        <th class="px-6 py-4 text-left text-lg font-semibold">Rapport</th>
                        <th class="px-6 py-4 text-left text-lg font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($topSessionPages as $sessionPage)
                        <tr class="border-b hover:bg-gray-100 transition-colors">
                            <td class="px-6 py-4 text-gray-800 text-lg">{{ $sessionPage->url_page }}</td>
                            <td class="px-6 py-4 text-gray-800 text-lg">{{ $sessionPage->duree_moyenne }}</td>
                            <td class="px-6 py-4 text-gray-800 text-lg">{{ $sessionPage->rapport->nom_rapport ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 flex space-x-4">
                                <!-- Edit Action -->
                                <a href="{{ route('topSessionPages.edit', $sessionPage->id_session_page) }}"
                                    class="flex items-center text-yellow-600 hover:text-yellow-800 transition-colors">
                                    <i class="fas fa-edit mr-1"></i> Modifier
                                </a>

                                <!-- Delete Action with SweetAlert -->
                                <form action="{{ route('topSessionPages.destroy', $sessionPage->id_session_page) }}"
                                    method="POST" class="inline delete-form" data-id="{{ $sessionPage->id_session_page }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                        class="flex items-center text-red-600 hover:text-red-800 transition-colors delete-btn">
                                        <i class="fas fa-trash-alt mr-1"></i> Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500 text-lg">
                                Aucune page de session trouvée.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- SweetAlert2 CDN -->
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
                                'La page de session a été supprimée.',
                                'success'
                            );
                        }
                    });
                });
            });
        });
    </script>
@endsection
    