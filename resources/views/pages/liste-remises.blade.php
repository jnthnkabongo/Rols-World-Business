@extends('pages.entete')
@section('content')
    <div class="p-8 overflow-y-auto flex-1">
        <!-- En-tête avec bouton d'ajout -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Liste des Remises</h2>
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
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nom preneur</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Téléphone</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date remise</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Donner par</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($liste_remises as $remise)
                            <tr class="hover:bg-gray-50 transition" data-role-id="{{ $remise->id }}" data-role-data='{{ json_encode(['nom' => $remise->nom, 'description' => $remise->description]) }}'>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"># {{ ($liste_remises->perPage() * ($liste_remises->currentPage() - 1 ))+ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ ucfirst($remise->produitRemise->nom ?? '-') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ ucfirst($remise->nom_remise) }} $</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $remise->telephone_remise}}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $remise->users->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $remise->created_at }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="openEditModal({{ $remise->id }})" class="px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteModal({{ $remise->id }})" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        <tr class="hover:bg-gray-50 transition">
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                Aucune remise trouvé
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-6 pb-4 mr-4 flex justify-end bg-primary">
                {{ $liste_remises->withQueryString()->links() }}
            </div>
   
        </div>
    </div>
@endsection