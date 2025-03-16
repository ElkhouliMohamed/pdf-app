<nav class="bg-gray-800 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <a href="{{ route('projets.index') }}" class="text-white text-3xl font-semibold">Générateur de Rapports
                PDF</a>

            <!-- Desktop Navigation -->
            <div class="hidden sm:flex space-x-4">
                <!-- Projets Dropdown -->
                <div class="relative group">
                    <button
                        class="text-gray-300 hover:bg-gray-700 hover:text-white px-4 py-2 rounded-md text-lg font-medium">
                        <i class="fas fa-project-diagram mr-2"></i>Projets
                    </button>
                    <div class="dropdown-content absolute left-0 bg-gray-800 shadow-lg rounded-md w-40 mt-1 py-2">
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
                        class="text-gray-300 hover:bg-gray-700 hover:text-white px-4 py-2 rounded-md text-lg font-medium">
                        <i class="fas fa-file-alt mr-2"></i>Rapports
                    </button>
                    <div class="dropdown-content absolute left-0 bg-gray-800 shadow-lg rounded-md w-40 mt-1 py-2">
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
                        class="text-gray-300 hover:bg-gray-700 hover:text-white px-4 py-2 rounded-md text-lg font-medium">
                        <i class="fas fa-key mr-2"></i>Top Keyword
                    </button>
                    <div class="dropdown-content absolute left-0 bg-gray-800 shadow-lg rounded-md w-40 mt-1 py-2">
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
                        class="text-gray-300 hover:bg-gray-700 hover:text-white px-4 py-2 rounded-md text-lg font-medium">
                        <i class="fas fa-list-alt mr-2"></i>Top Session Pages
                    </button>
                    <div class="dropdown-content absolute left-0 bg-gray-800 shadow-lg rounded-md w-40 mt-1 py-2">
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
            </div>

            <!-- Mobile Menu Button -->
            <button id="mobile-menu-button" class="sm:hidden p-2 text-gray-400 hover:text-white focus:outline-none">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden sm:hidden bg-gray-800 py-2">
        <a href="{{ route('projets.index') }}" class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
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
        <!-- Mobile Top Keyword Links -->
        <a href="{{ route('topKeywords.index') }}"
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-key mr-2"></i>Top Keyword
        </a>
        <a href="{{ route('topKeywords.create') }}"
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-plus mr-2"></i>Créer un Top Keyword
        </a>
        <!-- Mobile Top Session Pages Links -->
        <a href="{{ route('topSessionPages.index') }}"
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-list-alt mr-2"></i>Top Session Pages
        </a>
        <a href="{{ route('topSessionPages.create') }}"
            class="block px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white">
            <i class="fas fa-plus mr-2"></i>Créer une Page
        </a>
    </div>
</nav>
