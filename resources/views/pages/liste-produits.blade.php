@extends('pages.entete')
@section('content')
    <div class="p-8 overflow-y-auto flex-1">
        <!-- En-tête -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Liste des Produits</h2>
        </div>

        <!-- Onglets -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8 px-6" aria-label="Tabs">
                    <button onclick="switchTab('electronics')" id="tab-electronics" class="tab-button border-b-2 border-blue-600 py-4 px-1 text-sm font-medium text-blue-600">
                        <i class="fas fa-laptop mr-2"></i>Appareils Électroniques
                    </button>
                    <button onclick="switchTab('shoes')" id="tab-shoes" class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700">
                        <i class="fas fa-shoe-prints mr-2"></i>Chaussures
                    </button>
                </nav>
            </div>

            <!-- Contenu Onglet Appareils Électroniques -->
            <div id="content-electronics" class="tab-content p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Appareils Électroniques</h3>
                    <button onclick="openModal('addElectronicsModal')" class="flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-lg">
                        <i class="fas fa-plus"></i>
                        <span>Ajouter</span>
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Marque</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prix</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Stock</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">iPhone 15 Pro</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Apple</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">1 299 €</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">25</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Disponible</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="openViewElectronicsModal(2)" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="openEditElectronicsModal(2)" class="px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteElectronicsModal(2)" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#2</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">MacBook Pro 14"</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Apple</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">2 499 €</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">12</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Disponible</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="openViewElectronicsModal(2)" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="openEditElectronicsModal(2)" class="px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteElectronicsModal(2)" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#3</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">Samsung Galaxy S24</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Samsung</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">899 €</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rupture</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="openViewElectronicsModal(3)" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="openEditElectronicsModal(3)" class="px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteElectronicsModal(3)" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Contenu Onglet Chaussures -->
            <div id="content-shoes" class="tab-content p-6 hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Chaussures</h3>
                    <button onclick="openModal('addShoesModal')" class="flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-lg">
                        <i class="fas fa-plus"></i>
                        <span>Ajouter</span>
                    </button>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Marque</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Taille</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prix</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Stock</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#1</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">Air Max 90</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Nike</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">42</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">149 €</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">30</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Disponible</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="openViewShoesModal(1)" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="openEditShoesModal(1)" class="px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteShoesModal(1)" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#2</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">Ultra Boost</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Adidas</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">43</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">179 €</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">15</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Disponible</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="openViewShoesModal(2)" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="openEditShoesModal(2)" class="px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteShoesModal(2)" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#3</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">Classic Leather</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Reebok</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">41</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">89 €</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">5</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Faible stock</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="openViewShoesModal(3)" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button onclick="openEditShoesModal(3)" class="px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteShoesModal(3)" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ajout Appareil Électronique -->
    <div id="addElectronicsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Ajouter un Appareil Électronique</h3>
                    <button onclick="closeModal('addElectronicsModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <form class="p-6 space-y-4" id="addElectronicsForm">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom du produit</label>
                    <input type="text" id="electronicsName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: iPhone 15 Pro" oninput="validateElectronicsForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Marque</label>
                    <input type="text" id="electronicsBrand" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: Apple" oninput="validateElectronicsForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Prix (€)</label>
                    <input type="number" id="electronicsPrice" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 1299" oninput="validateElectronicsForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Stock</label>
                    <input type="number" id="electronicsStock" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 25" oninput="validateElectronicsForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Statut</label>
                    <select id="electronicsStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="validateElectronicsForm()">
                        <option value="">Sélectionner...</option>
                        <option value="available">Disponible</option>
                        <option value="out_of_stock">Rupture</option>
                    </select>
                </div>
            </form>
            <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeModal('addElectronicsModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                <button id="addElectronicsBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition opacity-50 cursor-not-allowed" disabled>Ajouter</button>
            </div>
        </div>
    </div>

    <!-- Modal Voir Appareil Électronique -->
    <div id="viewElectronicsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Détails de l'Appareil</h3>
                    <button onclick="closeModal('viewElectronicsModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">ID</span>
                    <span class="text-sm text-gray-800" id="viewElectronicsId">#1</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">Nom</span>
                    <span class="text-sm text-gray-800 font-semibold" id="viewElectronicsName">iPhone 15 Pro</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">Marque</span>
                    <span class="text-sm text-gray-800" id="viewElectronicsBrand">Apple</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">Prix</span>
                    <span class="text-sm text-gray-800 font-semibold" id="viewElectronicsPrice">1 299 €</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">Stock</span>
                    <span class="text-sm text-gray-800" id="viewElectronicsStock">25</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm font-semibold text-gray-600">Statut</span>
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800" id="viewElectronicsStatus">Disponible</span>
                </div>
            </div>
            <div class="p-6 border-t border-gray-200 flex justify-end">
                <button onclick="closeModal('viewElectronicsModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Fermer</button>
            </div>
        </div>
    </div>

    <!-- Modal Modifier Appareil Électronique -->
    <div id="editElectronicsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Modifier l'Appareil</h3>
                    <button onclick="closeModal('editElectronicsModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <form class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom du produit</label>
                    <input type="text" id="editElectronicsName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="iPhone 15 Pro">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Marque</label>
                    <input type="text" id="editElectronicsBrand" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="Apple">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Prix (€)</label>
                    <input type="number" id="editElectronicsPrice" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="1299">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Stock</label>
                    <input type="number" id="editElectronicsStock" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="25">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Statut</label>
                    <select id="editElectronicsStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="available" selected>Disponible</option>
                        <option value="out_of_stock">Rupture</option>
                    </select>
                </div>
            </form>
            <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeModal('editElectronicsModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Modifier</button>
            </div>
        </div>
    </div>

    <!-- Modal Suppression Appareil Électronique -->
    <div id="deleteElectronicsModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Confirmer la suppression</h3>
                <p class="text-gray-600 mb-6">Êtes-vous sûr de vouloir supprimer cet appareil ? Cette action est irréversible.</p>
                <div class="flex justify-center space-x-3">
                    <button onclick="closeModal('deleteElectronicsModal')" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                    <button class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ajout Chaussure -->
    <div id="addShoesModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Ajouter une Chaussure</h3>
                    <button onclick="closeModal('addShoesModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <form class="p-6 space-y-4" id="addShoesForm">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom du produit</label>
                    <input type="text" id="shoesName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: Air Max 90" oninput="validateShoesForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Marque</label>
                    <input type="text" id="shoesBrand" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: Nike" oninput="validateShoesForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Taille</label>
                    <input type="number" id="shoesSize" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 42" oninput="validateShoesForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Prix (€)</label>
                    <input type="number" id="shoesPrice" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 149" oninput="validateShoesForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Stock</label>
                    <input type="number" id="shoesStock" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 30" oninput="validateShoesForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Statut</label>
                    <select id="shoesStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="validateShoesForm()">
                        <option value="">Sélectionner...</option>
                        <option value="available">Disponible</option>
                        <option value="low_stock">Faible stock</option>
                        <option value="out_of_stock">Rupture</option>
                    </select>
                </div>
            </form>
            <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeModal('addShoesModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                <button id="addShoesBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition opacity-50 cursor-not-allowed" disabled>Ajouter</button>
            </div>
        </div>
    </div>

    <!-- Modal Voir Chaussure -->
    <div id="viewShoesModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Détails de la Chaussure</h3>
                    <button onclick="closeModal('viewShoesModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">ID</span>
                    <span class="text-sm text-gray-800" id="viewShoesId">#1</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">Nom</span>
                    <span class="text-sm text-gray-800 font-semibold" id="viewShoesName">Air Max 90</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">Marque</span>
                    <span class="text-sm text-gray-800" id="viewShoesBrand">Nike</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">Taille</span>
                    <span class="text-sm text-gray-800" id="viewShoesSize">42</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">Prix</span>
                    <span class="text-sm text-gray-800 font-semibold" id="viewShoesPrice">149 €</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">Stock</span>
                    <span class="text-sm text-gray-800" id="viewShoesStock">30</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm font-semibold text-gray-600">Statut</span>
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800" id="viewShoesStatus">Disponible</span>
                </div>
            </div>
            <div class="p-6 border-t border-gray-200 flex justify-end">
                <button onclick="closeModal('viewShoesModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Fermer</button>
            </div>
        </div>
    </div>

    <!-- Modal Modifier Chaussure -->
    <div id="editShoesModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Modifier la Chaussure</h3>
                    <button onclick="closeModal('editShoesModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <form class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom du produit</label>
                    <input type="text" id="editShoesName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="Air Max 90">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Marque</label>
                    <input type="text" id="editShoesBrand" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="Nike">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Taille</label>
                    <input type="number" id="editShoesSize" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="42">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Prix (€)</label>
                    <input type="number" id="editShoesPrice" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="149">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Stock</label>
                    <input type="number" id="editShoesStock" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="30">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Statut</label>
                    <select id="editShoesStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="available" selected>Disponible</option>
                        <option value="low_stock">Faible stock</option>
                        <option value="out_of_stock">Rupture</option>
                    </select>
                </div>
            </form>
            <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeModal('editShoesModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Modifier</button>
            </div>
        </div>
    </div>

    <!-- Modal Suppression Chaussure -->
    <div id="deleteShoesModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Confirmer la suppression</h3>
                <p class="text-gray-600 mb-6">Êtes-vous sûr de vouloir supprimer cette chaussure ? Cette action est irréversible.</p>
                <div class="flex justify-center space-x-3">
                    <button onclick="closeModal('deleteShoesModal')" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                    <button class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function switchTab(tabName) {
            // Cacher tout le contenu des onglets
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Réinitialiser les styles des boutons d'onglets
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('border-blue-600', 'text-blue-600');
                button.classList.add('border-transparent', 'text-gray-500');
            });

            // Afficher le contenu de l'onglet sélectionné
            document.getElementById('content-' + tabName).classList.remove('hidden');

            // Activer le style du bouton d'onglet sélectionné
            const activeButton = document.getElementById('tab-' + tabName);
            activeButton.classList.remove('border-transparent', 'text-gray-500');
            activeButton.classList.add('border-blue-600', 'text-blue-600');
        }

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Réinitialiser le formulaire d'ajout quand on ouvre le modal
            if (modalId === 'addElectronicsModal') {
                document.getElementById('addElectronicsForm').reset();
                validateElectronicsForm();
            } else if (modalId === 'addShoesModal') {
                document.getElementById('addShoesForm').reset();
                validateShoesForm();
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Validation formulaire Appareils Électroniques
        function validateElectronicsForm() {
            const name = document.getElementById('electronicsName').value.trim();
            const brand = document.getElementById('electronicsBrand').value.trim();
            const price = document.getElementById('electronicsPrice').value;
            const stock = document.getElementById('electronicsStock').value;
            const status = document.getElementById('electronicsStatus').value;
            
            const addBtn = document.getElementById('addElectronicsBtn');
            
            if (name && brand && price && stock && status) {
                addBtn.disabled = false;
                addBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                addBtn.disabled = true;
                addBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        // Validation formulaire Chaussures
        function validateShoesForm() {
            const name = document.getElementById('shoesName').value.trim();
            const brand = document.getElementById('shoesBrand').value.trim();
            const size = document.getElementById('shoesSize').value;
            const price = document.getElementById('shoesPrice').value;
            const stock = document.getElementById('shoesStock').value;
            const status = document.getElementById('shoesStatus').value;
            
            const addBtn = document.getElementById('addShoesBtn');
            
            if (name && brand && size && price && stock && status) {
                addBtn.disabled = false;
                addBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                addBtn.disabled = true;
                addBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        // Fonctions pour les Appareils Électroniques
        function openViewElectronicsModal(id) {
            const electronics = {
                1: { name: 'iPhone 15 Pro', brand: 'Apple', price: '1 299 €', stock: 25, status: 'Disponible' },
                2: { name: 'MacBook Pro 14"', brand: 'Apple', price: '2 499 €', stock: 12, status: 'Disponible' },
                3: { name: 'Samsung Galaxy S24', brand: 'Samsung', price: '899 €', stock: 0, status: 'Rupture' }
            };
            
            const item = electronics[id];
            document.getElementById('viewElectronicsId').textContent = '#' + id;
            document.getElementById('viewElectronicsName').textContent = item.name;
            document.getElementById('viewElectronicsBrand').textContent = item.brand;
            document.getElementById('viewElectronicsPrice').textContent = item.price;
            document.getElementById('viewElectronicsStock').textContent = item.stock;
            document.getElementById('viewElectronicsStatus').textContent = item.status;
            
            openModal('viewElectronicsModal');
        }

        function openEditElectronicsModal(id) {
            const electronics = {
                1: { name: 'iPhone 15 Pro', brand: 'Apple', price: 1299, stock: 25 },
                2: { name: 'MacBook Pro 14"', brand: 'Apple', price: 2499, stock: 12 },
                3: { name: 'Samsung Galaxy S24', brand: 'Samsung', price: 899, stock: 0 }
            };
            
            const item = electronics[id];
            document.getElementById('editElectronicsName').value = item.name;
            document.getElementById('editElectronicsBrand').value = item.brand;
            document.getElementById('editElectronicsPrice').value = item.price;
            document.getElementById('editElectronicsStock').value = item.stock;
            
            openModal('editElectronicsModal');
        }

        function openDeleteElectronicsModal(id) {
            openModal('deleteElectronicsModal');
        }

        // Fonctions pour les Chaussures
        function openViewShoesModal(id) {
            const shoes = {
                1: { name: 'Air Max 90', brand: 'Nike', size: 42, price: '149 €', stock: 30, status: 'Disponible' },
                2: { name: 'Ultra Boost', brand: 'Adidas', size: 43, price: '179 €', stock: 15, status: 'Disponible' },
                3: { name: 'Classic Leather', brand: 'Reebok', size: 41, price: '89 €', stock: 5, status: 'Faible stock' }
            };
            
            const item = shoes[id];
            document.getElementById('viewShoesId').textContent = '#' + id;
            document.getElementById('viewShoesName').textContent = item.name;
            document.getElementById('viewShoesBrand').textContent = item.brand;
            document.getElementById('viewShoesSize').textContent = item.size;
            document.getElementById('viewShoesPrice').textContent = item.price;
            document.getElementById('viewShoesStock').textContent = item.stock;
            document.getElementById('viewShoesStatus').textContent = item.status;
            
            openModal('viewShoesModal');
        }

        function openEditShoesModal(id) {
            const shoes = {
                1: { name: 'Air Max 90', brand: 'Nike', size: 42, price: 149, stock: 30 },
                2: { name: 'Ultra Boost', brand: 'Adidas', size: 43, price: 179, stock: 15 },
                3: { name: 'Classic Leather', brand: 'Reebok', size: 41, price: 89, stock: 5 }
            };
            
            const item = shoes[id];
            document.getElementById('editShoesName').value = item.name;
            document.getElementById('editShoesBrand').value = item.brand;
            document.getElementById('editShoesSize').value = item.size;
            document.getElementById('editShoesPrice').value = item.price;
            document.getElementById('editShoesStock').value = item.stock;
            
            openModal('editShoesModal');
        }

        function openDeleteShoesModal(id) {
            openModal('deleteShoesModal');
        }

        // Fermer les modals quand on clique en dehors
        window.onclick = function(event) {
            if (event.target.classList.contains('fixed')) {
                event.target.classList.add('hidden');
                event.target.classList.remove('flex');
            }
        }
    </script>
@endsection