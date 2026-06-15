@extends('pages.entete')
@section('content')
    <div class="p-8 overflow-y-auto flex-1">
        <!-- En-tête avec bouton d'ajout -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Liste des Ventes</h2>
            {{-- <button onclick="openModal('addRoleModal')" class="flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-lg">
                <i class="fas fa-plus"></i>
                <span>Ajouter une vente</span>
            </button> --}}
        </div>


        <!-- Cards statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Card ventes aujourd'hui -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Ventes aujourd'hui</p>
                        <p class="text-sm font-bold text-gray-800 mt-2">{{ $ventes_aujourdhui }} Ventes | {{ $ventes_aujourdhui_quantite}} Pièces</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-calendar-day text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Card total ventes -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total des ventes</p>
                        <p class="text-sm font-bold text-gray-800 mt-2">{{ $total_ventes }} Ventes | {{ $ventes_total_quantite }} Pièces</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-shopping-cart text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <!-- Card somme ventes -->
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Somme des ventes</p>
                        <p class="text-sm font-bold text-gray-800 mt-2">{{ number_format($somme_ventes, 2, ',', ' ') }} $</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-dollar-sign text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        
        <!-- Formulaire de filtre par date -->
        <div class="bg-white rounded-2xl shadow-lg p-3 mb-3">
            <form action="{{ route('liste-ventes') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Date de début</label>
                    <input type="date" name="date_debut" value="{{ request('date_debut') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex-1">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Date de fin</label>
                    <input type="date" name="date_fin" value="{{ request('date_fin') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    {{-- <input type="month" name="" id="" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"> --}}
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        <i class="fas fa-filter mr-2"></i>Filtrer
                    </button>
                    <a href="{{ route('liste-ventes') }}" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">
                        <i class="fas fa-times mr-2"></i>Réinitialiser
                    </a>
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                        <i class="fas fa-print mr-2"></i>Exporter
                    </button>
                </div>
            </form>
        </div>
        <!-- Tableau des rôles -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Produit</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Client</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Quantité</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prix unitaire</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prix total</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Vendu par</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date de vente</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($liste_ventes as $vente)
                            <tr class="hover:bg-gray-50 transition" data-role-id="{{ $vente->id }}" data-role-data='{{ json_encode(['nom' => $vente->nom, 'description' => $vente->description]) }}'>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"># {{ ($liste_ventes->perPage() * ($liste_ventes->currentPage() - 1 ))+ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ ucfirst($vente->ventedetails->first()?->produitUnite->produit->nom ?? '-') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ ucfirst($vente->client->nom_client) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $vente->ventedetails->first()?->quantite ?? '0' }} Pcs</td>   
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $vente->ventedetails->first()?->prix_unitaire ?? '0' }} $</td>   
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $vente->ventedetails->first()?->total ?? '0' }} $</td>   
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $vente->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $vente->date_vente }}</td>
                              
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        {{-- <button onclick="openViewModal({{ $role->id }})" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                            <i class="fas fa-eye"></i>
                                        </button> --}}
                                        <button onclick="openEditModal({{ $vente->id }})" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteModal({{ $vente->id }})" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        <tr class="hover:bg-gray-50 transition">
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                Aucun rôle trouvé
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 pb-4 mr-4 flex justify-end bg-primary">
                {{ $liste_ventes->withQueryString()->links() }}
            </div>
   
        </div>
    </div>
@endsection