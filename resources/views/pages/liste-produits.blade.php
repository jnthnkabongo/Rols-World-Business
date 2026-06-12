@extends('pages.entete')
@section('content')
    <div class="p-8 overflow-y-auto flex-1">
        <!-- En-tête -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <h2 class= "
            text-2xl font-bold text-gray-800"
            >Liste des Produits</h2>

            
            <div class="flex gap-3">
                <button onclick="openModal('addPhoneBrandModal')"
                    class="inline-flex items-center justify-center w-12 h-12 text-white rounded-full shadow-lg bg-blue-700 hover:bg-blue-800 transition">
                    <i class="fas fa-mobile-screen-button"></i>
                </button>

                <button onclick="openModal('addShoeBrandModal')"
                    class="inline-flex items-center justify-center w-12 h-12 text-white rounded-full shadow-lg bg-blue-700 hover:bg-blue-800 transition">
                    <i class="fas fa-shoe-prints"></i>
                </button>
            </div>
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
                        <span>Ajouter appareil</span>
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
                            @foreach($produits_electroniques as $produit)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $produit->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">{{ $produit->nom }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $produit->marque->nom ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ number_format($produit->prix_vente, 2, ',', ' ') }} $</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $produit->stock }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($produit->status == 'available')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Disponible</span>
                                    @elseif($produit->status == 'low_stock')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Faible stock</span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rupture</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        {{-- <button onclick="openViewElectronicsModal({{ $produit->id }})" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                            <i class="fas fa-eye"></i>
                                        </button> --}}
                                        <button onclick="openEditElectronicsModal({{ $produit->id }})" class="px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteElectronicsModal({{ $produit->id }})" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
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
                        <span>Ajouter chaussure</span>
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
                            @foreach($chaussures as $produit)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ $produit->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">{{ $produit->nom }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $produit->marque->nom ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $produit->taille ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ number_format($produit->prix_vente, 2, ',', ' ') }} $</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($produit->status == 'available')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Disponible</span>
                                    @elseif($produit->status == 'low_stock')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Faible stock</span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">Rupture</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        {{-- <button onclick="openViewShoesModal({{ $produit->id }})" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                            <i class="fas fa-eye"></i>
                                        </button> --}}
                                        <button onclick="openEditShoesModal({{ $produit->id }})" class="px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteShoesModal({{ $produit->id }})" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ajout Appareil Electronique -->
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
            <form action="{{ route('ajout-produit') }}" method="POST" class="p-6" id="addElectronicsForm">
                @csrf

                <input type="hidden" name="categorie_id"
                    value="{{ $categories->where('nom', 'electrniques')->first()->id ?? 1 }}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- Nom du produit -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nom du produit
                        </label>
                        <input
                            type="text"
                            name="nom"
                            id="addElectronicsName"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Ex: iPhone 15 Pro"
                            required
                            oninput="validateAddElectronicsForm()">
                    </div>

                    <!-- Marque -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Marque
                        </label>
                        <select
                            name="marque_id"
                            id="addElectronicsBrand"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required
                            onchange="validateAddElectronicsForm()">
                            <option value="">Sélectionner...</option>
                            @foreach($marques_electroniques as $marque)
                                <option value="{{ $marque->id }}">
                                    {{ $marque->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Modèle -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="">Modèle</label>
                        <input 
                            type="text" 
                            name="modele" 
                            id="addElectronicsModele"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Ex: A465DF67"
                            required
                            oninput="validateAddElectronicsForm()"
                        >
                    </div>

                    <!-- Numéro série -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2" for="">Numéro série</label>
                        <input 
                            type="text" 
                            name="numero_serie" 
                            id="addElectronicsNumberSerie"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" 
                            placeholder="Ex: A465DF67"
                            required
                            oninput="validateAddElectronicsForm()"
                        >
                    </div>

                    <!-- Prix d'achat -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Prix d'achat ($)
                        </label>
                        <input
                            type="number"
                            name="prix_achat"
                            id="addElectronicsPurchasePrice"
                            step="0.01"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Ex: 1299"
                            required
                            oninput="validateAddElectronicsForm()">
                    </div>

                    <!-- Prix de vente -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Prix de vente ($)
                        </label>
                        <input
                            type="number"
                            name="prix_vente"
                            id="addElectronicsSalePrice"
                            step="0.01"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Ex: 1299"
                            required
                            oninput="validateAddElectronicsForm()">
                    </div>

                    <!-- Quantité -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Description
                        </label>
                        <input type="text" name="description" id="">
                        <input
                            type="number"
                            name="quantite"
                            id="addElectronicsQuantity"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Ex: 10"
                            required
                            oninput="validateAddElectronicsForm()" hidden value="1">
                    </div>

                </div>
            </form>
            <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeModal('addElectronicsModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                <button type="submit" form="addElectronicsForm" id="addElectronicsBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition opacity-50 cursor-not-allowed" disabled>Ajouter</button>
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
            <form action="{{ route('modifier-produit', ['id' => '__id__']) }}" method="POST" class="p-6 space-y-4" id="editElectronicsForm">
                @csrf
                @method('POST')
                <input type="hidden" name="categorie_id" value="{{ $categories->where('nom', 'Électronique')->first()->id ?? 1 }}">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom du produit</label>
                    <input type="text" name="nom" id="editElectronicsName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required oninput="validateEditElectronicsForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Marque</label>
                    <select name="marque_id" id="editElectronicsBrand" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required onchange="validateEditElectronicsForm()">
                        <option value="">Sélectionner...</option>
                        @foreach($marques_electroniques as $marque)
                            <option value="{{ $marque->id }}">{{ $marque->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Prix de vente (€)</label>
                    <input type="number" name="prix_vente" step="0.01" id="editElectronicsPrice" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required oninput="validateEditElectronicsForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Stock</label>
                    <input type="number" name="stock" id="editElectronicsStock" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required oninput="validateEditElectronicsForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Statut</label>
                    <select name="status" id="editElectronicsStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required onchange="validateEditElectronicsForm()">
                        <option value="available">Disponible</option>
                        <option value="low_stock">Faible stock</option>
                        <option value="out_of_stock">Rupture</option>
                    </select>
                </div>
            </form>
            <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeModal('editElectronicsModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                <button type="submit" form="editElectronicsForm" id="editElectronicsBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition opacity-50 cursor-not-allowed" disabled>Modifier</button>
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
                    <form action="{{ route('supprimer-produit', ['id' => '__id__']) }}" method="POST" id="deleteElectronicsForm">
                        @csrf
                        @method('POST')
                        <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Supprimer</button>
                    </form>
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
            <form action="{{ route('ajout-produit') }}" method="POST" class="p-6 space-y-4" id="addShoesForm">
                @csrf
                <input type="hidden" name="categorie_id" value="{{ $categories->where('nom', 'Chaussures')->first()->id ?? 2 }}">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div >
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nom de la chaussure</label>
                        <input type="text" name="nom" id="addShoesName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: Air Max 90" required oninput="validateAddShoesForm()">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Marque de la chaussure</label>
                        <select name="marque_id" id="addShoesBrand" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required onchange="validateAddShoesForm()">
                            <option value="">Sélectionner...</option>
                            @foreach($marques_chaussures as $marque)
                                <option value="{{ $marque->id }}">{{ $marque->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Modèle de la chaussure</label>
                        <input type="text" name="modele" id="addShoesSaleModele" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: Ralph lauren" required oninput="validateAddShoesForm()">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Taille de la chaussure</label>
                        <input type="number" name="taille" id="addShoesSaleTaille" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 42" required oninput="validateAddShoesForm()">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Prix d'achat ($)</label>
                        <input type="number" name="prix_achat" id="addShoesSalePurchasePrice" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 100" required oninput="validateAddShoesForm()">
                    </div>
                     <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Prix de vente ($)</label>
                        <input type="number" name="prix_vente" id="addShoesSalePrice" step="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 149" required oninput="validateAddShoesForm()">
                    </div>
                    <div>
                        <label for="">Description</label>
                        <input type="text" name="description" id="addShoesDescription" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: Chaussure en cuir" required oninput="validateAddShoesForm()">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Quantité</label>
                        <input type="number" name="quantite" id="addShoesSaleQuantity" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 10" required oninput="validateAddShoesForm()">
                    </div>
                </div>

                <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                    <button onclick="closeModal('addShoesModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                    <button type="submit" form="addShoesForm" id="addShoesBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition opacity-50 cursor-not-allowed" disabled>Ajouter</button>
                </div>
            </form>
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
            <form action="{{ route('modifier-produit', ['id' => '__id__']) }}" method="POST" class="p-6 space-y-4" id="editShoesForm">
                @csrf
                @method('POST')
                <input type="hidden" name="categorie_id" value="{{ $categories->where('nom', 'Chaussures')->first()->id ?? 2 }}">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom du produit</label>
                    <input type="text" name="nom" id="editShoesName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required oninput="validateEditShoesForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Marque</label>
                    <select name="marque_id" id="editShoesBrand" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required onchange="validateEditShoesForm()">
                        <option value="">Sélectionner...</option>
                        @foreach($marques_chaussures as $marque)
                            <option value="{{ $marque->id }}">{{ $marque->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Taille</label>
                    <input type="text" name="taille" id="editShoesSize" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="validateEditShoesForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Prix de vente (€)</label>
                    <input type="number" name="prix_vente" step="0.01" id="editShoesPrice" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required oninput="validateEditShoesForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Stock</label>
                    <input type="number" name="stock" id="editShoesStock" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required oninput="validateEditShoesForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Statut</label>
                    <select name="status" id="editShoesStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required onchange="validateEditShoesForm()">
                        <option value="available">Disponible</option>
                        <option value="low_stock">Faible stock</option>
                        <option value="out_of_stock">Rupture</option>
                    </select>
                </div>
            </form>
            <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeModal('editShoesModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                <button type="submit" form="editShoesForm" id="editShoesBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition opacity-50 cursor-not-allowed" disabled>Modifier</button>
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
                    <form action="{{ route('supprimer-produit', ['id' => '__id__']) }}" method="POST" id="deleteShoesForm">
                        @csrf
                        @method('POST')
                        <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Ajouter Marque Téléphone -->
    <div id="addPhoneBrandModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Ajouter une Marque de Téléphone</h3>
                    <button onclick="closeModal('addPhoneBrandModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <form action="{{ route('ajout-marque') }}" method="POST" class="p-6 space-y-4" id="addPhoneBrandForm">
                @csrf
                <input type="number" name="categorie_id" value="1">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom de la marque</label>
                    <input type="text" name="nom" id="addPhoneBrandName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: Apple, Samsung, Xiaomi" required oninput="validateAddPhoneBrandForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Description (optionnel)</label>
                    <textarea name="description" id="addPhoneBrandDescription" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Description de la marque..." required oninput="validateAddPhoneBrandForm()"></textarea>
                </div>

                <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                    <button onclick="closeModal('addPhoneBrandModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                    <button type="submit" form="addPhoneBrandForm" id="addPhoneBrandBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition opacity-50 cursor-not-allowed" disabled>Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Ajouter Marque Chaussure -->
    <div id="addShoeBrandModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Ajouter une Marque de Chaussure</h3>
                    <button onclick="closeModal('addShoeBrandModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <form action="{{ route('ajout-marque') }}" method="POST" class="p-6 space-y-4" id="addShoeBrandForm">
                @csrf
                <input type="number" name="categorie_id" id="categorie_id" value="2" hidden>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom de la marque</label>
                    <input type="text" name="nom" id="addShoeBrandName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: Nike, Adidas, Puma" required oninput="validateAddShoeBrandForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Description (optionnel)</label>
                    <textarea name="description" id="addShoeBrandDescription" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Description de la marque..." oninput="validateAddShoeBrandForm()"></textarea>
                </div>

                <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                    <button onclick="closeModal('addShoeBrandModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                    <button type="submit" form="addShoeBrandForm" id="addShoeBrandBtn" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition opacity-50 cursor-not-allowed" disabled>Ajouter</button>
                </div>
            </form>
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
                validateAddElectronicsForm();
            } else if (modalId === 'addShoesModal') {
                document.getElementById('addShoesForm').reset();
                validateAddShoesForm();
            } else if (modalId === 'addPhoneBrandModal') {
                document.getElementById('addPhoneBrandForm').reset();
                validateAddPhoneBrandForm();
            } else if (modalId === 'addShoeBrandModal') {
                document.getElementById('addShoeBrandForm').reset();
                validateAddShoeBrandForm();
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Validation formulaire Appareils Électroniques
        function validateAddElectronicsForm() {
            const name = document.getElementById('addElectronicsName').value.trim();
            const brand = document.getElementById('addElectronicsBrand').value;
            const modele = document.getElementById('addElectronicsModele').value.trim();
            const numberSerie = document.getElementById('addElectronicsNumberSerie').value;
            const purchasePrice = document.getElementById('addElectronicsPurchasePrice').value;
            const salePrice = document.getElementById('addElectronicsSalePrice').value;
            const addBtn = document.getElementById('addElectronicsBtn');
            
            if (name && brand && modele && numberSerie && salePrice && purchasePrice) {
                addBtn.disabled = false;
                addBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                addBtn.disabled = true;
                addBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        // Validation formulaire Chaussures
        function validateAddShoesForm() {
            const name = document.getElementById('addShoesName').value.trim();
            const modele = document.getElementById('addShoesSaleModele').value.trim();
            const brand = document.getElementById('addShoesBrand').value;
            const taille = document.getElementById('addShoesSaleTaille').value;
            const purchasePrice = document.getElementById('addShoesSalePurchasePrice').value;
            const salePrice = document.getElementById('addShoesSalePrice').value;
            const addBtn = document.getElementById('addShoesBtn');
            
            if (name && brand && modele && taille && purchasePrice && salePrice ) {
                addBtn.disabled = false;
                addBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                addBtn.disabled = true;
                addBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        // Validation formulaire Marque Téléphone
        function validateAddPhoneBrandForm() {
            const name = document.getElementById('addPhoneBrandName').value.trim();
            const description = document.getElementById('addPhoneBrandDescription').value.trim();
            const addBtn = document.getElementById('addPhoneBrandBtn');
            
            if (name && description) {
                addBtn.disabled = false;
                addBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                addBtn.disabled = true;
                addBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        // Validation formulaire Marque Chaussure
        function validateAddShoeBrandForm() {
            const name = document.getElementById('addShoeBrandName').value.trim();
            const description = document.getElementById('addShoeBrandDescription').value.trim();
            const addBtn = document.getElementById('addShoeBrandBtn');
            
            if (name && description) {
                addBtn.disabled = false;
                addBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                addBtn.disabled = true;
                addBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        // Validation formulaire Modifier Appareil Électronique
        function validateEditElectronicsForm() {
            const name = document.getElementById('editElectronicsName').value.trim();
            const brand = document.getElementById('editElectronicsBrand').value;
            const price = document.getElementById('editElectronicsPrice').value;
            const stock = document.getElementById('editElectronicsStock').value;
            const status = document.getElementById('editElectronicsStatus').value;
            const editBtn = document.getElementById('editElectronicsBtn');
            
            if (name && brand && price && stock && status) {
                editBtn.disabled = false;
                editBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                editBtn.disabled = true;
                editBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        // Validation formulaire Modifier Chaussure
        function validateEditShoesForm() {
            const name = document.getElementById('editShoesName').value.trim();
            const brand = document.getElementById('editShoesBrand').value;
            const size = document.getElementById('editShoesSize').value;
            const price = document.getElementById('editShoesPrice').value;
            const stock = document.getElementById('editShoesStock').value;
            const status = document.getElementById('editShoesStatus').value;
            const editBtn = document.getElementById('editShoesBtn');
            
            if (name && brand && size && price && stock && status) {
                editBtn.disabled = false;
                editBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                editBtn.disabled = true;
                editBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        // Fonctions pour les Appareils Électroniques
        function openViewElectronicsModal(id) {
            // Fetch product data from server
            fetch(`{{ route('get-product-data', ['id' => '__id__']) }}`.replace('__id__', id))
                .then(response => response.json())
                .then(data => {
                    document.getElementById('viewElectronicsId').textContent = '#' + data.id;
                    document.getElementById('viewElectronicsName').textContent = data.nom;
                    document.getElementById('viewElectronicsBrand').textContent = data.marque ? data.marque.nom : '-';
                    document.getElementById('viewElectronicsPrice').textContent = number_format(data.prix_vente, 2, ',', ' ') + ' €';
                    document.getElementById('viewElectronicsStock').textContent = data.stock;
                    
                    let statusText = 'Disponible';
                    let statusClass = 'bg-green-100 text-green-800';
                    if (data.status === 'low_stock') {
                        statusText = 'Faible stock';
                        statusClass = 'bg-yellow-100 text-yellow-800';
                    } else if (data.status === 'out_of_stock') {
                        statusText = 'Rupture';
                        statusClass = 'bg-red-100 text-red-800';
                    }
                    
                    const statusElement = document.getElementById('viewElectronicsStatus');
                    statusElement.textContent = statusText;
                    statusElement.className = `px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}`;
                    
                    openModal('viewElectronicsModal');
                })
                .catch(error => console.error('Error fetching product:', error));
        }

        function openEditElectronicsModal(id) {
            // Fetch product data from server
            fetch(`{{ route('get-product-data', ['id' => '__id__']) }}`.replace('__id__', id))
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editElectronicsName').value = data.nom;
                    document.getElementById('editElectronicsBrand').value = data.marque_id;
                    document.getElementById('editElectronicsPrice').value = data.prix_vente;
                    document.getElementById('editElectronicsStock').value = data.stock;
                    document.getElementById('editElectronicsStatus').value = data.status;
                    
                    // Update form action with correct ID
                    const form = document.getElementById('editElectronicsForm');
                    form.action = form.action.replace('__id__', id);
                    
                    openModal('editElectronicsModal');
                    validateEditElectronicsForm();
                })
                .catch(error => console.error('Error fetching product:', error));
        }

        function openDeleteElectronicsModal(id) {
            // Update form action with correct ID
            const form = document.getElementById('deleteElectronicsForm');
            form.action = form.action.replace('__id__', id);
            openModal('deleteElectronicsModal');
        }

        // Fonctions pour les Chaussures
        function openViewShoesModal(id) {
            // Fetch product data from server
            fetch(`{{ route('get-product-data', ['id' => '__id__']) }}`.replace('__id__', id))
                .then(response => response.json())
                .then(data => {
                    document.getElementById('viewShoesId').textContent = '#' + data.id;
                    document.getElementById('viewShoesName').textContent = data.nom;
                    document.getElementById('viewShoesBrand').textContent = data.marque ? data.marque.nom : '-';
                    document.getElementById('viewShoesSize').textContent = data.taille || '-';
                    document.getElementById('viewShoesPrice').textContent = number_format(data.prix_vente, 2, ',', ' ') + ' €';
                    document.getElementById('viewShoesStock').textContent = data.stock;
                    
                    let statusText = 'Disponible';
                    let statusClass = 'bg-green-100 text-green-800';
                    if (data.status === 'low_stock') {
                        statusText = 'Faible stock';
                        statusClass = 'bg-yellow-100 text-yellow-800';
                    } else if (data.status === 'out_of_stock') {
                        statusText = 'Rupture';
                        statusClass = 'bg-red-100 text-red-800';
                    }
                    
                    const statusElement = document.getElementById('viewShoesStatus');
                    statusElement.textContent = statusText;
                    statusElement.className = `px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full ${statusClass}`;
                    
                    openModal('viewShoesModal');
                })
                .catch(error => console.error('Error fetching product:', error));
        }

        function openEditShoesModal(id) {
            // Fetch product data from server
            fetch(`{{ route('get-product-data', ['id' => '__id__']) }}`.replace('__id__', id))
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editShoesName').value = data.nom;
                    document.getElementById('editShoesBrand').value = data.marque_id;
                    document.getElementById('editShoesSize').value = data.taille || '';
                    document.getElementById('editShoesPrice').value = data.prix_vente;
                    document.getElementById('editShoesStock').value = data.stock;
                    document.getElementById('editShoesStatus').value = data.status;
                    
                    // Update form action with correct ID
                    const form = document.getElementById('editShoesForm');
                    form.action = form.action.replace('__id__', id);
                    
                    openModal('editShoesModal');
                    validateEditShoesForm();
                })
                .catch(error => console.error('Error fetching product:', error));
        }

        function openDeleteShoesModal(id) {
            // Update form action with correct ID
            const form = document.getElementById('deleteShoesForm');
            form.action = form.action.replace('__id__', id);
            openModal('deleteShoesModal');
        }

        // Helper function for number formatting
        function number_format(number, decimals, dec_point, thousands_sep) {
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
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