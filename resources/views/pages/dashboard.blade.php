@extends('pages.entete')
@section('content')
    <!-- Main Content -->

    <main class="p-4 md:p-8 overflow-y-auto flex-1">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
            <div class="bg-white p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-xs md:text-sm">Total quantité électroniques</p>
                        <p class="text-xs md:text-sm font-bold text-gray-800 mt-1">12,450 $ | 45 pcs</p>
                    </div>
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-box text-blue-600 text-xs md:text-sm"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-xs md:text-sm">Total ventes</p>
                        <p class="text-xs md:text-sm font-bold text-gray-800 mt-1">156 $ | 23 pcs</p>
                    </div>
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-green-600 text-xs md:text-sm"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-xs md:text-sm">Vente journalière</p>
                        <p class="text-xs md:text-sm font-bold text-gray-800 mt-1">89 $ | 12 pcs</p>
                    </div>
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-red-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shopping-bag text-red-600 text-xs md:text-sm"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-xs md:text-sm">Remises</p>
                        <p class="text-xs md:text-sm font-bold text-gray-800 mt-1">23 $ | 5 pcs</p>
                    </div>
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-tags text-orange-600 text-sm md:text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
            <div class="bg-white p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-xs md:text-sm">Total quantité chaussures</p>
                        <p class="text-xs md:text-sm font-bold text-gray-800 mt-1">12,450 $ | 45 pcs</p>
                    </div>
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shoe-prints text-blue-600 text-sm md:text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-xs md:text-sm">Total Ventes</p>
                        <p class="text-xs md:text-sm font-bold text-gray-800 mt-1">156 $ | 12 pcs</p>
                    </div>
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-green-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-green-600 text-sm md:text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-xs md:text-sm">Vente journalière</p>
                        <p class="text-xs md:text-sm font-bold text-gray-800 mt-1">89 $ | 3 pcs</p>
                    </div>
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-red-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-shopping-bag text-red-600 text-sm md:text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-xs md:text-sm">Remises</p>
                        <p class="text-xs md:text-sm font-bold text-gray-800 mt-1">23 $ | 2 pcs</p>
                    </div>
                    <div class="w-10 h-10 md:w-12 md:h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                        <i class="fas fa-tags text-orange-600 text-sm md:text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tableau des ventes -->

        <div>
            <h2 class="flex items-center space-x-3 text-xl md:text-2xl font-bold text-gray-800 mb-4">
                <i class="fas fa-table text-blue-600"></i>
                <span>Tableau des ventes</span>
            </h2>

            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Client</th>
                                <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date</th>
                                <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Montant</th>
                                <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                                <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                                <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                                <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                                <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm font-medium text-gray-900">#1254</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-700">Jean Dupont</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">09/06/2026</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">09/06/2026</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">09/06/2026</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">09/06/2026</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm font-semibold text-gray-900">450 €</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap">
                                    <span class="px-2 md:px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Complété
                                    </span>
                                </td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">
                                    <a href="" class="group relative px-2 md:px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                        <i class="fas fa-eye text-sm md:text-sm text-blue-600"></i>
                                    </a>
                                    &nbsp;
                                    <a href="" class="group relative px-2 md:px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                        <i class="fas fa-edit text-sm md:text-sm text-gray-600"></i>
                                    </a>
                                    &nbsp;
                                    <a href="" class="group relative px-2 md:px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                        <i class="fas fa-trash text-sm md:text-sm text-red-600"></i>
                                    </a>
                                </td>
                            </tr>
                             <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm font-medium text-gray-900">#1254</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-700">Jean Dupont</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">09/06/2026</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">09/06/2026</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">09/06/2026</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">09/06/2026</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm font-semibold text-gray-900">450 €</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap">
                                    <span class="px-2 md:px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Complété
                                    </span>
                                </td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">
                                    <a href="" class="group relative px-2 md:px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                        <i class="fas fa-eye text-sm md:text-sm text-blue-600"></i>
                                    </a>
                                    &nbsp;
                                    <a href="" class="group relative px-2 md:px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                        <i class="fas fa-edit text-sm md:text-sm text-gray-600"></i>
                                    </a>
                                    &nbsp;
                                    <a href="" class="group relative px-2 md:px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                        <i class="fas fa-trash text-sm md:text-sm text-red-600"></i>
                                    </a>
                                </td>
                            </tr>
                             <tr class="hover:bg-gray-50 transition">
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm font-medium text-gray-900">#1254</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-700">Jean Dupont</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">09/06/2026</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">09/06/2026</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">09/06/2026</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">09/06/2026</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm font-semibold text-gray-900">450 €</td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap">
                                    <span class="px-2 md:px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Complété
                                    </span>
                                </td>
                                <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">
                                    <a href="" class="group relative px-2 md:px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                        <i class="fas fa-eye text-sm md:text-sm text-blue-600"></i>
                                    </a>
                                    &nbsp;
                                    <a href="" class="group relative px-2 md:px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                        <i class="fas fa-edit text-sm md:text-sm text-gray-600"></i>
                                    </a>
                                    &nbsp;
                                    <a href="" class="group relative px-2 md:px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                        <i class="fas fa-trash text-sm md:text-sm text-red-600"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main


@endsection

