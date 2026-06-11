<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Rol's World Business</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        body {
            font-family: 'Inter', sans-serif;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #EEEEF2 0%, #BBB9BC 100%);
        }
        .sidebar-gradient {
            background: #1e3a8a;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
        }
        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        .nav-item.active {
            background: rgba(255, 255, 255, 0.2);
            border-left: 4px solid white;
        }
        .dropdown-menu {
            display: none;
        }
        .dropdown-menu.show {
            display: block;
        }

    </style>
</head>
<body class="gradient-bg h-screen flex flex-col">
    <!-- Header en haut sur toute la largeur -->
    <header class="bg-white shadow-md p-6 flex-shrink-0 z-20">
        <div class="flex justify-between items-center w-full">
            <div class="flex items-center space-x-4">
                <div class="inline-flex items-center justify-center w-20 h-20">
                    <img src="{{ asset('images/logo-1.png') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-800">{{ $pageTitle ?? 'Tableau de bord' }}</h1>
                    <p class="text-gray-500 mt-1">{{ $pageSubtitle ?? 'Vue d\'ensemble de votre activité' }}</p>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Rechercher..." class="pl-10 pr-4 py-2 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <button class="relative p-2 bg-white rounded-xl shadow hover:shadow-md transition">
                    <i class="fas fa-bell text-gray-600"></i>
                    <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full text-xs text-white flex items-center justify-center">3</span>
                </button>
                
                <!-- User Dropdown -->
                <div class="relative">
                    <button onclick="toggleDropdown()" class="flex items-center space-x-3 bg-white rounded-xl shadow px-4 py-2 hover:shadow-md transition">
                        <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <span class="font-medium text-gray-700">Admin</span>
                        <i class="fas fa-chevron-down text-gray-400 text-sm"></i>
                    </button>
                    
                    <div id="userDropdown" class="dropdown-menu absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg py-2 z-30">
                        <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                            <i class="fas fa-user w-5 text-gray-400"></i>
                            <span class="ml-3">Profil</span>
                        </a>
                        <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 transition">
                            <i class="fas fa-cog w-5 text-gray-400"></i>
                            <span class="ml-3">Paramètres</span>
                        </a>
                        <hr class="my-2">
                        <a href="/logout" class="flex items-center px-4 py-2 text-red-600 hover:bg-red-50 transition">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span class="ml-3">Se déconnecter</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Conteneur principal avec sidebar et contenu -->
    <div class="flex flex-1 overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 sidebar-gradient text-white flex flex-col h-full flex-shrink-0">
            
            <!-- Navigation -->
            <nav class="flex-1 p-4 space-y-2">
                <a href="{{ route('dashboard') }}" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200">
                    <i class="fas fa-home w-5"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('liste-roles') }}" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200">
                    <i class="fas fa-user-shield w-5"></i>
                    <span>Rôles</span>
                </a>

                <a href="{{ route('liste-utilisateurs') }}" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200">
                    <i class="fas fa-users w-5"></i>
                    <span>Utilisateurs</span>
                </a>
                <a href="{{ route('liste-fournisseurs') }}" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200">
                    <i class="fas fa-truck w-5"></i>
                    <span>Fournisseurs</span>
                </a>
                <a href="{{ route('liste-produits')}}" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200">
                    <i class="fas fa-box w-5"></i>
                    <span>Produits</span>
                </a>
                <a href="{{ route('liste-ventes') }}" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200">
                    <i class="fas fa-shopping-cart w-5"></i>
                    <span>Ventes</span>
                </a>
                <a href="{{ route('liste-remises') }}" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200">
                    <i class="fas fa-tags w-5"></i>
                    <span>Remises</span>
                </a>

                <a href="{{ route('liste-rapports') }}" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200">
                    <i class="fas fa-file-alt w-5"></i>
                    <span>Rapports</span>
                </a>
                <a href="{{ route('liste-historiques') }}" class="nav-item flex items-center space-x-3 px-4 py-3 rounded-lg transition-all duration-200">
                    <i class="fas fa-history w-5"></i>
                    <span>Historiques</span>
                </a>
            </nav>
        </aside>
        
        <!-- Contenu principal -->
        <main class="flex-1 overflow-y-auto">
            @yield('content')
        </main>
    </div>
    
    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('userDropdown');
            dropdown.classList.toggle('show');
        }
        
        // Fermer le dropdown quand on clique ailleurs
        window.onclick = function(event) {
            if (!event.target.closest('.relative')) {
                const dropdown = document.getElementById('userDropdown');
                if (dropdown && dropdown.classList.contains('show')) {
                    dropdown.classList.remove('show');
                }
            }
        }
    </script>
</body>
</html>