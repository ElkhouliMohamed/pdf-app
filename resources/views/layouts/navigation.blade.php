<!-- Barre de Navigation -->
<style>
    /* Add this to your existing CSS */
    .dropdown:hover .dropdown-menu {
        visibility: visible;
        opacity: 1;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        /* Slow down the menu hide/show */
    }

    .dropdown .dropdown-menu {
        visibility: hidden;
        opacity: 0;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        /* Slow down the menu hide/show */
    }
</style>
<nav class="bg-gray-800 shadow-md">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <button id="mobile-menu-button" type="button"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                    aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Ouvrir le menu principal</span>
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                <a href="{{ route('projets.index') }}" class="text-white text-3xl font-semibold">Générateur de Rapports
                    PDF</a>
            </div>
            <div class="hidden sm:block sm:ml-6">
                <div class="flex space-x-4">
                    <!-- Groupe 1: Liens des Projets avec Dropdown -->
                    <div class="relative group">
                        <button
                            class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-lg font-medium">
                            <i class="fas fa-project-diagram mr-2"></i>Projets
                        </button>
                        <div
                            class="dropdown-content absolute hidden bg-gray-800 shadow-lg rounded-md w-40 mt-1 transition-all duration-500 ease-in-out group-hover:block">
                            <a href="{{ route('projets.index') }}"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 text-sm">
                                <i class="fas fa-home mr-2"></i>Accueil
                            </a>
                            <a href="{{ route('projets.create') }}"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 text-sm">
                                <i class="fas fa-plus mr-2"></i>Créer un Projet
                            </a>
                        </div>
                    </div>

                    <!-- Groupe 2: Liens des Rapports avec Dropdown -->
                    <div class="relative group">
                        <button
                            class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-lg font-medium">
                            <i class="fas fa-file-alt mr-2"></i>Rapports
                        </button>
                        <div
                            class="dropdown-content absolute hidden bg-gray-800 shadow-lg rounded-md w-40 mt-1 transition-all duration-500 ease-in-out group-hover:block">
                            <a href="{{ route('rapports.index') }}"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 text-sm">
                                <i class="fas fa-file mr-2"></i>Rapports
                            </a>
                            <a href="{{ route('rapports.create') }}"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 text-sm">
                                <i class="fas fa-plus mr-2"></i>Créer un Rapport
                            </a>
                        </div>
                    </div>

                    <!-- Groupe 3: Autres Liens avec Dropdown -->
                    <div class="relative group">
                        <button
                            class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-lg font-medium">
                            <i class="fas fa-info-circle mr-2"></i>Autres
                        </button>
                        <div
                            class="dropdown-content absolute hidden bg-gray-800 shadow-lg rounded-md w-40 mt-1 transition-all duration-500 ease-in-out group-hover:block">
                            <a href="#"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 text-sm">
                                <i class="fas fa-info mr-2"></i>À Propos
                            </a>
                            <a href="#"
                                class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 text-sm">
                                <i class="fas fa-phone-alt mr-2"></i>Contact
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Menu Mobile -->
    <div class="sm:hidden" id="mobile-menu" class="hidden">
        <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
            <a href="{{ route('projets.index') }}"
                class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                <i class="fas fa-home mr-2"></i>Accueil
            </a>
            <a href="{{ route('projets.create') }}"
                class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                <i class="fas fa-plus mr-2"></i>Créer un Projet
            </a>
            <a href="{{ route('rapports.index') }}"
                class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                <i class="fas fa-file-alt mr-2"></i>Rapports
            </a>
            <a href="{{ route('rapports.create') }}"
                class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                <i class="fas fa-plus mr-2"></i>Créer un Rapport
            </a>
            <a href="#"
                class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                <i class="fas fa-info-circle mr-2"></i>À Propos
            </a>
            <a href="#"
                class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
                <i class="fas fa-phone-alt mr-2"></i>Contact
            </a>
        </div>
    </div>
</nav>

<script>
    // Display dropdown on hover
    document.querySelectorAll('.group').forEach(function(menu) {
        menu.addEventListener('mouseenter', function() {
            this.querySelector('.dropdown-content').classList.remove('hidden');
        });
        menu.addEventListener('mouseleave', function() {
            this.querySelector('.dropdown-content').classList.add('hidden');
        });
    });
</script>

<!-- Ensure Font Awesome is loaded -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
