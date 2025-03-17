<!-- resources/views/layouts/app.blade.php (or wherever your nav is) -->
<nav class="bg-gray-900 shadow-md p-4 text-xl">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ route('index') }}"
                    class="text-gray-300 hover:scale-110 ease-in-out duration-300 hover:text-white flex items-center space-x-2">
                    <i class="fa-solid fa-magnifying-glass-chart text-2xl"></i>
                    <span class="text-xl font-semibold hidden sm:inline">Rapport SiteWeb</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden sm:flex items-center space-x-4">
                <!-- Projets Dropdown -->
                <div class="relative group">
                    <button
                        class="text-gray-300 hover:bg-gray-700 hover:text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                        <i class="fas fa-project-diagram mr-2"></i>Projets
                    </button>
                    <div
                        class="dropdown-content absolute left-0 bg-gray-800 shadow-lg rounded-md w-40 mt-1 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out">
                        <a href="{{ route('projets.index') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-home mr-2"></i>Accueil
                        </a>
                        <a href="{{ route('projets.create') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-plus mr-2"></i>Créer un Projet
                        </a>
                    </div>
                </div>

                <!-- Rapports Dropdown -->
                <div class="relative group">
                    <button
                        class="text-gray-300 hover:bg-gray-700 hover:text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                        <i class="fas fa-file-alt mr-2"></i>Rapports
                    </button>
                    <div
                        class="dropdown-content absolute left-0 bg-gray-800 shadow-lg rounded-md w-40 mt-1 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out">
                        <a href="{{ route('rapports.index') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-file mr-2"></i>Rapports
                        </a>
                        <a href="{{ route('rapports.create') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-plus mr-2"></i>Créer un Rapport
                        </a>
                    </div>
                </div>

                <!-- Top Keyword Dropdown -->
                <div class="relative group">
                    <button
                        class="text-gray-300 hover:bg-gray-700 hover:text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                        <i class="fas fa-key mr-2"></i>Top Keyword
                    </button>
                    <div
                        class="dropdown-content absolute left-0 bg-gray-800 shadow-lg rounded-md w-40 mt-1 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out">
                        <a href="{{ route('topKeywords.index') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-file mr-2"></i>Top Keyword
                        </a>
                        <a href="{{ route('topKeywords.create') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-plus mr-2"></i>Créer un Top Keyword
                        </a>
                    </div>
                </div>

                <!-- Top Session Pages Dropdown -->
                <div class="relative group">
                    <button
                        class="text-gray-300 hover:bg-gray-700 hover:text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                        <i class="fas fa-list-alt mr-2"></i>Top Session Pages
                    </button>
                    <div
                        class="dropdown-content absolute left-0 bg-gray-800 shadow-lg rounded-md w-40 mt-1 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out">
                        <a href="{{ route('topSessionPages.index') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-file mr-2"></i>Top Session Pages
                        </a>
                        <a href="{{ route('topSessionPages.create') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-plus mr-2"></i>Créer une Page
                        </a>
                    </div>
                </div>

                <!-- Top Pages Dropdown -->
                <div class="relative group">
                    <button
                        class="text-gray-300 hover:bg-gray-700 hover:text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                        <i class="fas fa-pager mr-2"></i>Top Pages
                    </button>
                    <div
                        class="dropdown-content absolute left-0 bg-gray-800 shadow-lg rounded-md w-40 mt-1 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out">
                        <a href="{{ route('topPages.index') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-file mr-2"></i>Top Pages
                        </a>
                        <a href="{{ route('topPages.create') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-plus mr-2"></i>Créer une Top Page
                        </a>
                    </div>
                </div>

                <!-- Erreurs 404 Dropdown -->
                <div class="relative group">
                    <button
                        class="text-gray-300 hover:bg-gray-700 hover:text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Erreurs 404
                    </button>
                    <div
                        class="dropdown-content absolute left-0 bg-gray-800 shadow-lg rounded-md w-40 mt-1 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out">
                        <a href="{{ route('erreurs404.index') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-file mr-2"></i>Liste Erreurs 404
                        </a>
                        <a href="{{ route('erreurs404.create') }}"
                            class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white">
                            <i class="fas fa-plus mr-2"></i>Ajouter Erreur 404
                        </a>
                    </div>
                </div>

                <!-- Logout/Settings -->
                <div class="relative group text-sm">
                    <button
                        class="text-gray-300 hover:bg-gray-700 hover:text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                        <i class="fa-solid fa-gear"></i>
                    </button>
                    <div
                        class="dropdown-content absolute left-0 bg-gray-800 shadow-lg rounded-md w-40 mt-1 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 ease-in-out">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="block w-full text-left px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white text-sm">
                                <i class="fas fa-sign-out-alt mr-2 text-red-600"></i>Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="sm:hidden p-2 text-gray-400 hover:text-white focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden sm:hidden bg-gray-900 py-2">
        <a href="{{ route('projets.index') }}"
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-home mr-2"></i>Accueil
        </a>
        <a href="{{ route('projets.create') }}"
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-plus mr-2"></i>Créer un Projet
        </a>
        <a href="{{ route('rapports.index') }}"
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-file-alt mr-2"></i>Rapports
        </a>
        <a href="{{ route('rapports.create') }}"
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-plus mr-2"></i>Créer un Rapport
        </a>
        <a href="{{ route('topKeywords.index') }}"
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-key mr-2"></i>Top Keyword
        </a>
        <a href="{{ route('topKeywords.create') }}"
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-plus mr-2"></i>Créer un Top Keyword
        </a>
        <a href="{{ route('topSessionPages.index') }}"
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-list-alt mr-2"></i>Top Session Pages
        </a>
        <a href="{{ route('topSessionPages.create') }}"
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-plus mr-2"></i>Créer une Page
        </a>
        <a href="{{ route('topPages.index') }}"
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-pager mr-2"></i>Top Pages
        </a>
        <a href="{{ route('topPages.create') }}"
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-plus mr-2"></i>Créer une Top Page
        </a>
        <a href="{{ route('erreurs404.index') }}"
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-exclamation-triangle mr-2"></i>Erreurs 404
        </a>
        <a href="{{ route('erreurs404.create') }}"
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-plus mr-2"></i>Ajouter Erreur 404
        </a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="block w-full text-left px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
                <i class="fas fa-sign-out-alt mr-2"></i>Log Out
            </button>
        </form>
    </div>
</nav>
