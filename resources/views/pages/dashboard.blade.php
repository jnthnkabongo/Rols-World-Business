@extends('pages.entete')
@section('content')
    <!-- Main Content -->

    <main class="p-4 md:p-8 overflow-y-auto flex-1">
        <!-- Welcome Banner -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-800 rounded-2xl shadow-lg p-6 md:p-8 mb-6 md:mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-white mb-2">Bienvenue sur votre Dashboard! {{ auth()->user()->name ?? 'Utilisateur' }} 👋</h1>
                    <p class="text-blue-100 text-sm md:text-base">Voici un aperçu de vos statistiques et activités récentes</p>
                </div>
                <div class="hidden md:block">
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-chart-pie text-white text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards Electroniques -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
            <div class="bg-gradient-to-br from-blue-400 to-blue-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-xs md:text-sm font-medium">Stock Électroniques</p>
                        <p class="text-lg md:text-2xl font-bold text-white mt-1">{{ number_format($electroniques_stock_value, 2, ',', ' ') }} $</p>
                        <p class="text-blue-100 text-xs mt-1">{{ $electroniques_stock_quantity }} pièces</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-laptop text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-400 to-green-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-xs md:text-sm font-medium">Ventes Électroniques</p>
                        <p class="text-lg md:text-2xl font-bold text-white mt-1">{{ number_format($electroniques_sales_value, 2, ',', ' ') }} $</p>
                        <p class="text-green-100 text-xs mt-1">{{ $electroniques_sales_quantity }} pièces</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-chart-line text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-400 to-purple-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-xs md:text-sm font-medium">Ventes Journalières</p>
                        <p class="text-lg md:text-2xl font-bold text-white mt-1">{{ number_format($electroniques_daily_sales, 2, ',', ' ') }} $</p>
                        <p class="text-purple-100 text-xs mt-1">{{ $electroniques_daily_quantity }} pièces</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-calendar-day text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-orange-400 to-orange-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-xs md:text-sm font-medium">Remises Électroniques</p>
                        <p class="text-lg md:text-2xl font-bold text-white mt-1">{{ $electroniques_remises }}</p>
                        <p class="text-orange-100 text-xs mt-1">{{ $electroniques_remises_quantity }} pièces</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-hand-holding text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards Chaussures -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
            <div class="bg-gradient-to-br from-indigo-400 to-indigo-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-indigo-100 text-xs md:text-sm font-medium">Stock Chaussures</p>
                        <p class="text-lg md:text-2xl font-bold text-white mt-1">{{ number_format($chaussures_stock_value, 2, ',', ' ') }} $</p>
                        <p class="text-indigo-100 text-xs mt-1">{{ $chaussures_stock_quantity }} pièces</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-shoe-prints text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-teal-400 to-teal-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-teal-100 text-xs md:text-sm font-medium">Ventes Chaussures</p>
                        <p class="text-lg md:text-2xl font-bold text-white mt-1">{{ number_format($chaussures_sales_value, 2, ',', ' ') }} $</p>
                        <p class="text-teal-100 text-xs mt-1">{{ $chaussures_sales_quantity }} pièces</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-shopping-bag text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-pink-400 to-pink-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-pink-100 text-xs md:text-sm font-medium">Ventes Journalières</p>
                        <p class="text-lg md:text-2xl font-bold text-white mt-1">{{ number_format($chaussures_daily_sales, 2, ',', ' ') }} $</p>
                        <p class="text-pink-100 text-xs mt-1">{{ $chaussures_daily_quantity }} pièces</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-clock text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-rose-400 to-rose-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-rose-100 text-xs md:text-sm font-medium">Remises Chaussures</p>
                        <p class="text-lg md:text-2xl font-bold text-white mt-1">{{ $chaussures_remises }}</p>
                        <p class="text-rose-100 text-xs mt-1">{{ $chaussures_remises_quantity }} pièces</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-exchange-alt text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards Accessoires -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
            <div class="bg-gradient-to-br from-indigo-400 to-indigo-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-indigo-100 text-xs md:text-sm font-medium">Stock Accesoires</p>
                        <p class="text-lg md:text-2xl font-bold text-white mt-1">{{ number_format($chaussures_stock_value, 2, ',', ' ') }} $</p>
                        <p class="text-indigo-100 text-xs mt-1">{{ $chaussures_stock_quantity }} pièces</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-shoe-prints text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-teal-400 to-teal-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-teal-100 text-xs md:text-sm font-medium">Ventes Accesoires</p>
                        <p class="text-lg md:text-2xl font-bold text-white mt-1">{{ number_format($chaussures_sales_value, 2, ',', ' ') }} $</p>
                        <p class="text-teal-100 text-xs mt-1">{{ $chaussures_sales_quantity }} pièces</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-shopping-bag text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-pink-400 to-pink-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-pink-100 text-xs md:text-sm font-medium">Ventes Accesoires</p>
                        <p class="text-lg md:text-2xl font-bold text-white mt-1">{{ number_format($chaussures_daily_sales, 2, ',', ' ') }} $</p>
                        <p class="text-pink-100 text-xs mt-1">{{ $chaussures_daily_quantity }} pièces</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-clock text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-rose-400 to-rose-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-rose-100 text-xs md:text-sm font-medium">Remises Accesoires</p>
                        <p class="text-lg md:text-2xl font-bold text-white mt-1">{{ $chaussures_remises }}</p>
                        <p class="text-rose-100 text-xs mt-1">{{ $chaussures_remises_quantity }} pièces</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-exchange-alt text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des ventes -->

        <div>
            <div class="bg-gradient-to-r from-gray-500 to-gray-600 rounded-2xl shadow-lg p-6 md:p-8 mb-2">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="text-xl md:text-2xl font-bold text-white flex items-center">
                            <i class="fas fa-receipt mr-3"></i>
                            Dernières ventes
                        </h2>
                        <p class="text-white text-sm mt-1">Vos 15 dernières transactions</p>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-shopping-cart text-white text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-full">
                        <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                            <tr>
                                <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                                <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Client</th>
                                <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Date</th>
                                <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Montant</th>
                                <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($dernieres_ventes as $vente)
                            <tr class="hover:bg-gradient-to-r hover:from-emerald-50 hover:to-teal-50 transition-all duration-300">
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm font-bold text-gray-900">#{{ $vente->id }}</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-700 font-medium">{{ $vente->client->nom_client ?? '-' }}</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-600">{{ \Carbon\Carbon::parse($vente->date_vente)->format('d/m/Y') }}</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm font-bold text-emerald-600">{{ number_format($vente->total, 2, ',', ' ') }} {{ $vente->venteDevise->logo ?? '$' }}</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap">
                                    <span class="px-2 md:px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $vente->statut == 'paye' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }}">
                                        {{ ucfirst($vente->statut) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-3 md:px-6 py-8 text-center text-xs md:text-sm text-gray-500">
                                    <i class="fas fa-inbox text-gray-300 text-3xl mb-2"></i>
                                    <p>Aucune vente trouvée</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main


@endsection

