@extends('pages.entete')
@section('content')
    <div class="p-8 overflow-y-auto flex-1">
        <!-- En-tête avec bouton d'ajout -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Liste des Ventes</h2>
            <button onclick="openModal('addRoleModal')" class="flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-lg">
                <i class="fas fa-plus"></i>
                <span>Ajouter une vente</span>
            </button>
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
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prix unitaire</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Vendu par</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date de vente</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase truncate">Total</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($liste_ventes as $vente)
                            <tr class="hover:bg-gray-50 transition" data-role-id="{{ $vente->id }}" data-role-data='{{ json_encode(['nom' => $vente->nom, 'description' => $vente->description]) }}'>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"># {{ ($liste_ventes->perPage() * ($liste_ventes->currentPage() - 1 ))+ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">{{ $vente->ventedetails->first()?->produit_unite_id->produitUnite->produit_id ?? '0' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ ucfirst($vente->client->nom_client) }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $vente->ventedetails->first()?->prix_unitaire ?? '0' }} 
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $vente->user->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $vente->date_vente }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Actif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        {{-- <button onclick="openViewModal({{ $role->id }})" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                            <i class="fas fa-eye"></i>
                                        </button> --}}
                                        <button onclick="openEditModal({{ $vente->id }})" class="px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
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