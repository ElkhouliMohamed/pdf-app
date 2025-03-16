@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/js/app.js'])

@section('content')
    <div class="container max-w-4xl mx-auto p-6 bg-white rounded-xl shadow-xl mt-10">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Liste des Mots-Clés Principaux</h1>

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
                        <th class="px-6 py-4 text-left text-lg font-semibold">Mot-Clé</th>
                        <th class="px-6 py-4 text-left text-lg font-semibold">Nombre de Requêtes</th>
                        <th class="px-6 py-4 text-left text-lg font-semibold">Rapport Assigné</th>
                        <th class="px-6 py-4 text-left text-lg font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($topKeywords as $topKeyword)
                        <tr class="border-b hover:bg-gray-100 transition-colors duration-200">
                            <td class="px-6 py-4 text-gray-800 text-lg">{{ $topKeyword->keyword }}</td>
                            <td class="px-6 py-4 text-gray-800 text-lg">{{ $topKeyword->nombre_requetes }}</td>
                            <td class="px-6 py-4 text-gray-800 text-lg">
                                @if ($topKeyword->rapport)
                                    {{ $topKeyword->rapport->nom_rapport }}
                                @else
                                    Aucun Rapport Assigné
                                @endif
                            </td>
                            <td class="px-6 py-4 flex space-x-4">
                                <!-- Edit Action -->
                                <a href="{{ route('topKeywords.edit', $topKeyword->id_keyword) }}"
                                    class="flex items-center text-yellow-600 hover:text-yellow-800 transition-colors">
                                    <i class="fas fa-edit mr-1"></i> Modifier
                                </a>

                                <!-- Delete Action with SweetAlert -->
                                <button type="button"
                                    class="flex items-center text-red-600 hover:text-red-800 transition-colors delete-btn"
                                    data-id="{{ $topKeyword->id_keyword }}"
                                    data-url="{{ route('topKeywords.destroy', $topKeyword->id_keyword) }}">
                                    <i class="fas fa-trash-alt mr-1"></i> Supprimer
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-500 text-lg">
                                Aucun mot-clé trouvé.
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
                                'Le mot-clé a été supprimé.',
                                'success'
                            );
                        }
                    });
                });
            });
        });
    </script>
@endsection
