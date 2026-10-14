@extends('pages.entete')
@section('content')
    <div class="p-8 overflow-y-auto flex-1">
        <!-- En-tête -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <h2 class="text-2xl font-bold text-gray-800">Liste stock épuisé</h2>

        </div>

        <form method="GET" action="{{ route('liste-produits-epures') }}" class="bg-white rounded-2xl shadow-lg p-4 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                <div class="md:col-span-2 relative">
                    <label for="recherche" class="sr-only">Rechercher un produit</label>
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="search" name="recherche_epures" id="recherche" value="{{ $recherche_epures }}"
                        placeholder="Rechercher par nom, marque, modèle ou numéro de série"
                        class="w-full pl-11 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex gap-3">
                    <div class="flex-1">
                        <label for="statut" class="sr-only">Filtrer par état</label>
                        <select name="statut_epures" id="statut" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Tous les états</option>
                            <option value="en_stock" @selected($statut_epures === 'en_stock')>En stock</option>
                            <option value="vendu" @selected($statut_epures === 'vendu')>Vendu</option>
                        </select>
                    </div>
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-5 py-3 text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-filter"></i>
                        <span>Filtrer</span>
                    </button>
                </div>
            </div>
            @if($recherche_epures !== '' || $statut_epures)
                <a href="{{ route('liste-produits') }}" class="inline-flex items-center gap-2 mt-3 text-sm text-gray-600 hover:text-blue-600">
                    <i class="fas fa-times"></i>
                    Réinitialiser les filtres
                </a>
            @endif
        </form>

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
                    <button onclick="switchTab('tools')" id="tab-tools" class="tab-button border-b-2 border-transparent py-4 px-1 text-sm font-medium text-gray-500 hover:text-gray-700">
                        <i class="fas fa-mobile-alt mr-2"></i></i><i class="fas fa-plug mr-2"></i>Accesoires
                    </button>
                </nav>
            </div>

            <!-- Contenu Onglet Appareils Électroniques -->
            <div id="content-electronics" class="tab-content p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Appareils Électroniques</h3>
                    
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Marque</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Modele</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Numéro série</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prix d'achat</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prix vente</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($produits_electroniques_epures as $produit)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ ($produits_electroniques_epures->perPage() * ($produits_electroniques_epures->currentPage() - 1 ))+ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">{{ ucfirst($produit->nom) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($produit->marque->nom ?? '-') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($produit->modele ?? '-') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $produit->produitUnites->first()->numero_serie ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ number_format($produit->prix_achat, 2, ',', ' ') }} {{ $produit->produitDevise->logo ?? '-'}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ number_format($produit->prix_vente, 2, ',', ' ') }} {{ $produit->produitDevise->logo ?? '-'}}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $unite = $produit->produitUnites->first();
                                    @endphp

                                    @if($unite && $unite->statut == 'en_stock')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                            Disponible
                                        </span>
                                    @elseif($unite && $unite->statut == 'vendu')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Vendu
                                        </span>
                                    @elseif($unite && $unite->statut == 'remise')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Remise
                                        </span>
                                    @elseif($unite && $unite->statut == 'defecteux')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Défectueux
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Rupture
                                        </span>
                                    @endif
                                </td>
                              
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                 <div class="mt-6 pb-4 mr-4 flex justify-end bg-primary">
                    {{ $produits_electroniques_epures->withQueryString()->links() }}
                </div>
            </div>

            <!-- Contenu Onglet Chaussures -->
            <div id="content-shoes" class="tab-content p-6 hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Chaussures</h3>
                   
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Marque</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Modéle</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Taille</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prix d'achat</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prix de vente</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Stock de vente</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($liste_chaussures_epures as $produit)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ ($liste_chaussures_epures->perPage() * ($liste_chaussures_epures->currentPage() - 1 ))+ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">{{ ucfirst($produit->nom) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($produit->marque->nom ?? '-') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($produit->modele ?? '-') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">N {{ $produit->taille ?? '-' }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ number_format($produit->prix_achat, 2, ',', ' ') }} {{ $produit->produitDevise->logo ?? '-'}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ number_format($produit->prix_vente, 2, ',', ' ') }} {{ $produit->produitDevise->logo ?? '-'}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $produit->produitUnites->sum('quantite_produit') ?? 0 }} Pièces</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $unite = $produit->produitUnites->first();
                                    @endphp

                                    @if($unite && $unite->statut == 'en_stock')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                            Disponible
                                        </span>
                                    @elseif($unite && $unite->statut == 'vendu')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Vendu
                                        </span>
                                    @elseif($unite && $unite->statut == 'remise')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Remise
                                        </span>
                                    @elseif($unite && $unite->statut == 'defecteux')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Défectueux
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Rupture
                                        </span>
                                    @endif
                                </td>
                             
                            </tr>
                            @empty
                            <tr class="hover:bg-gray-50 transition">
                                <td colspan="10" class="px-6 py-4 text-center text-gray-500">
                                    Aucune chaussure trouvée
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-6 pb-4 mr-4 flex justify-end bg-primary">
                    {{ $liste_chaussures_epures->withQueryString()->links() }}
                </div>
            </div>

            <!-- Contenu Onglet Tools -->
            <div id="content-tools" class="tab-content p-6 hidden">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Accesoires</h3>
                  
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nom</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Marque</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Modéle</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prix d'achat</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prix de vente</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Stock de vente</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($liste_accessoires_epures as $accesoire)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#{{ ($liste_accessoires_epures->perPage() * ($liste_accessoires_epures->currentPage() - 1 ))+ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">{{ ucfirst($accesoire->nom) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($accesoire->marque->nom ?? '-') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ ucfirst($accesoire->modele ?? '-') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ number_format($accesoire->prix_achat, 2, ',', ' ') }} {{ $accesoire->produitDevise->logo ?? '-'}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ number_format($accesoire->prix_vente, 2, ',', ' ') }} {{ $accesoire->produitDevise->logo ?? '-'}}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $accesoire->produitUnites->sum('quantite_produit') ?? 0 }} Pièces</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $unite = $accesoire->produitUnites->first();
                                    @endphp

                                    @if($unite && $unite->statut == 'en_stock')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                            Disponible
                                        </span>
                                    @elseif($unite && $unite->statut == 'vendu')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            Vendu
                                        </span>
                                    @elseif($unite && $unite->statut == 'remise')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                            Remise
                                        </span>
                                    @elseif($unite && $unite->statut == 'defecteux')
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Défectueux
                                        </span>
                                    @else
                                        <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            Rupture
                                        </span>
                                    @endif
                                </td>
                           
                            </tr>
                            @empty
                            <tr class="hover:bg-gray-50 transition">
                                <td colspan="10" class="px-6 py-4 text-center text-gray-500">
                                    Aucune accesoire trouvé
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
                <!-- Pagination -->
                <div class="mt-6 pb-4 mr-4 flex justify-end bg-primary">
                    {{ $liste_accessoires_epures->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>


    <script>
        function switchTab(tabName, updateUrl = true) {
            const validTabs = ['electronics', 'shoes', 'tools'];

            if (!validTabs.includes(tabName)) {
                tabName = 'electronics';
            }

            if (updateUrl) {
                const url = new URL(window.location.href);
                url.searchParams.set('tab', tabName);
                window.history.replaceState({}, '', url);
            }

            document.querySelectorAll('.tab-content nav[role="navigation"] a[href]').forEach(link => {
                const url = new URL(link.href, window.location.origin);
                url.searchParams.set('tab', tabName);
                link.href = url;
            });

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

        document.addEventListener('DOMContentLoaded', () => {
            const tab = new URLSearchParams(window.location.search).get('tab');
            switchTab(tab || 'electronics', false);

            if (tab) {
                document.getElementById('content-' + tab)?.scrollIntoView({ block: 'start' });
            }
        });

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
            } else if (modalId === 'addToolsModal') {
                document.getElementById('addToolsForm').reset();
                validateAddToolsForm();
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

        // Validation formulaire Tools
        function validateAddToolsForm() {
            const name = document.getElementById('addToolsName').value.trim();
            const brand = document.getElementById('addToolsBrand').value;
            const modele = document.getElementById('addToolsSaleModele').value.trim();
            const purchasePrice = document.getElementById('addToolsSalePurchasePrice').value;
            const salePrice = document.getElementById('addToolsSalePrice').value;
            const quantity = document.getElementById('addToolsSaleQuantity').value;
            const addBtn = document.getElementById('addToolsBtn');

            if (name && brand && modele && purchasePrice && salePrice && quantity) {
                addBtn.disabled = false;
                addBtn.classList.remove('opacity-50', 'cursor-not-allowed')
            } else {
                addBtn.disabled = true;
                addBtn.classList.add('opacity-50', 'cursor-not-allowed')
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
            const name = document.getElementById('editElectronicsName')?.value.trim() || '';
            const brand = document.getElementById('editElectronicsBrand')?.value || '';
            const modele = document.getElementById('editElectronicsModele')?.value.trim() || '';
            const numberSerie = document.getElementById('editElectronicsSerialNumber')?.value.trim() || '';
            const prix = document.getElementById('editElectronicsVente')?.value;
            const price = document.getElementById('editElectronicsPrice')?.value;
            const stock = document.getElementById('editElectronicsStock')?.value;
            const status = document.getElementById('editElectronicsStatus')?.value || '';
            const editBtn = document.getElementById('editElectronicsBtn');

            // Vérifie que les champs texte ne sont pas vides et que les champs numériques ont une valeur
            const hasTextFields = name && brand && modele && numberSerie && status;
            const hasNumericFields = (prix !== undefined && prix !== '') && (price !== undefined && price !== '') && (stock !== undefined && stock !== '');

            if (hasTextFields && hasNumericFields) {
                editBtn.disabled = false;
                editBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                editBtn.disabled = true;
                editBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        // Validation formulaire Modifier Chaussure
        function validateEditShoesForm() {
            const name = document.getElementById('editShoesName')?.value.trim() || '';
            const brand = document.getElementById('editShoesBrand')?.value || '';
            const modele = document.getElementById('editShoesModele')?.value.trim() || '';
            const size = document.getElementById('editShoesSize').value;
            const stock = document.getElementById('editShoesStock').value;
            const numberSeries = document.getElementById('editShoesSerialNumber')?.value.trim() || '';
            const price = document.getElementById('editShoesPrice').value;
            const vente = document.getElementById('editShoesVente').value;
            const status = document.getElementById('editShoesStatus').value;
            const editBtn = document.getElementById('editShoesBtn');

            if (name && brand && modele && size && stock && numberSeries && price && vente && status) {
                editBtn.disabled = false;
                editBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                editBtn.disabled = true;
                editBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        //Validation formulaire Modifier Accesoire
        function validateEditToolsForm(){
            const name = document.getElementById('editToolsName')?.value.trim() || '';
            const brand = document.getElementById('editToolsBrand')?.value || '';
            const modele = document.getElementById('editToolsModele')?.value || '';
            const vente = document.getElementById('editToolsVente').value;
            const price = document.getElementById('editToolsPrice').value;
            const status = document.getElementById('editToolsStatus').value;
            const editBtn = document.getElementById('editToolsBtn');

            if (name && brand && modele && vente && price && status) {
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

        // Fonction ouvertureModal Modification Electronics
        function openEditElectronicsModal(id) {
            // Fetch product data from server
            fetch(`{{ route('get-product-data', ['id' => '__id__']) }}`.replace('__id__', id))
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editElectronicsName').value = data.nom;
                    document.getElementById('editElectronicsBrand').value = data.marque_id;
                    document.getElementById('editElectronicsModele').value = data.modele;
                    document.getElementById('editElectronicsSerialNumber').value = data.numero_serie;
                    // Set the produit_unite id so we update the correct row
                    if (document.getElementById('editElectronicsUnitId')) {
                        document.getElementById('editElectronicsUnitId').value = data.produit_unite_id || '';
                    }
                    document.getElementById('editElectronicsVente').value = data.prix_achat;
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

        // Fonction ouvertureModal suppression Electronics
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
                    document.getElementById('editShoesModele').value = data.modele;
                    document.getElementById('editShoesSize').value = data.taille || '';
                    document.getElementById('editShoesStock').value = data.quantite_produit;
                    document.getElementById('editShoesSerialNumber').value = data.numero_serie;
                    // Set the produit_unite id so we update the correct row
                    if (document.getElementById('editShoesUnitId')) {
                        document.getElementById('editShoesUnitId').value = data.produit_id || '';
                    }
                    document.getElementById('editShoesPrice').value = data.prix_vente;
                    document.getElementById('editShoesVente').value = data.prix_achat;
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

        // Fonction pour les Accessoires
        function openToolsModal() {
            openModal('addToolsModal');
        }

        // Fonction pour ouverture
        function openEditToolsModal(id){
            // Fetch product data from server
            fetch(`{{ route('get-product-data', ['id' => '__id__']) }}`.replace('__id__', id))
                .then(response => response.json())
                .then(data => {
                    document.getElementById('editToolsName').value = data.nom;
                    document.getElementById('editToolsBrand').value = data.marque_id;
                    document.getElementById('editToolsModele').value = data.modele;
                    document.getElementById('editToolsVente').value = data.prix_achat;
                    document.getElementById('editToolsPrice').value = data.prix_vente;
                    document.getElementById('editToolsSerialNumers').value = data.numero_serie;
                    // Set the produit_unite id so we update the correct row
                    if (document.getElementById('editShoesUnitId')) {
                        document.getElementById('editShoesUnitId').value = data.produit_id || '';
                    }
                    document.getElementById('editToolsStock').value = data.quantite_produit;
                    document.getElementById('editShoesStatus').value = data.status;

                    // Update form action with correct ID
                    const form = document.getElementById('editToolsForm');
                    form.action = form.action.replace('__id__', id);

                    openModal('editToolsModal');
                    validateEditToolsForm();
                })
                .catch(error => console.error('Error fetching product:', error));
        }

        function openDeleteToolsModal(id) {
            // Update form action with correct ID
            const form = document.getElementById('deleteToolsForm');
            form.action = form.action.replace('__id__', id);
            openModal('deleteToolsForm');
        }

        // Fonction pour ouvrir/fermer les dropdowns
        function toggleDropdown(dropdownId) {
            const dropdown = document.getElementById(dropdownId);
            dropdown.classList.toggle('hidden');
        }

        // Fonction pour ouvrir/fermer les dropdown More
        function toggleDropdownMore(dropdownIdMore) {
            const dropdown = document.getElementById(dropdownIdMore);
            dropdown.classList.toggle('hidden');
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

        // Fonction pour ouvrir le modal de vente
        function openVenteModal(productId, price, currency) {
            const form = document.getElementById('venteForm');
            form.action = form.action.replace('__id__', productId);
            form.reset();
            document.getElementById('venteProduitPrix').value = price;
            document.getElementById('venteProduitDevise').textContent = currency;
            validateVenteForm();
            openModal('venteModal');
        }

        function validateVenteForm() {
            const nomClient = document.getElementById('nom_client').value.trim();
            const quantite = document.getElementById('vente_quantite').value.trim();
            const btn = document.getElementById('venteBtn');

            if (nomClient && quantite && Number(quantite) > 0) {
                btn.disabled = false;
                btn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                btn.disabled = true;
                btn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        // Fonction pour ouvrir le modal de remise
        function openRemiseModal(productId, produitNom) {
            const form = document.getElementById('remiseForm');
            form.action = form.action.replace('__id__', productId);
            document.getElementById('remiseProduitNom').value = produitNom;
            openModal('remiseModal');
        }
    </script>

@endsection
