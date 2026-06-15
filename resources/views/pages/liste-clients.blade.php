@extends('pages.entete')
@section('content')
    <div class="p-8 overflow-y-auto flex-1">
        <!-- En-tête avec bouton d'ajout -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Liste des Clients</h2>
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
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Noms clients</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">E-mail client</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Téléphone</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Adresse</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Produit acheté</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prix</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Vendu par</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($liste_clients as $client)
                            <tr class="hover:bg-gray-50 transition" data-role-id="{{ $client->id }}" data-role-data='{{ json_encode(['nom' => $client->nom, 'description' => $client->description]) }}'>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"># {{ ($liste_clients->perPage() * ($liste_clients->currentPage() - 1 ))+ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">{{ $client->nom_client }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $client->email }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $client->telephone }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $client->adresse }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $client->ventes->first()?->ventedetails->first()?->produitUnite->produit->nom ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $client->ventes->first()?->total ?? '-' }} $</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $client->ventes->first()?->user->name ?? '-' }} </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="openEditModal({{ $client->id }})" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteModal({{ $client->id }})" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        <tr class="hover:bg-gray-50 transition">
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                Aucun rôle trouvé
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 pb-4 mr-4 flex justify-end bg-primary">
                {{ $liste_clients->withQueryString()->links() }}
            </div>
   
        </div>
    </div>
@endsection