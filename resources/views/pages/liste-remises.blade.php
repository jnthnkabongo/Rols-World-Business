@extends('pages.entete')
@section('content')
    <div class="p-8 overflow-y-auto flex-1">
        <!-- En-tête avec bouton d'ajout -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Liste des Remises</h2>
         
        </div>

        <!-- Tableau des rôles -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Produit</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Quantité</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Numéro série</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nom preneur</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Téléphone</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Donné par</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date remise</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($liste_remises as $remise)
                            <tr class="hover:bg-gray-50 transition" data-role-id="{{ $remise->id }}" data-role-data='{{ json_encode(['nom' => $remise->nom, 'description' => $remise->description]) }}'>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"># {{ ($liste_remises->perPage() * ($liste_remises->currentPage() - 1 ))+ $loop->iteration }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ ucfirst($remise->produitRemise->nom ?? '-') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ ucfirst($remise->quantite) }} </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $remise->numero_serie }}</td> 
                                <td class="px-6 py-4 text-sm text-gray-500">{{ ucfirst($remise->nom_remise) }} </td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $remise->telephone_remise}}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $remise->users->name ?? '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $remise->created_at }}</td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <form action="{{ route('changer-statut-disponible', $remise->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                                <i class="fas fa-arrow-right"></i>
                                            </button>
                                        </form>
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

    <!-- Modal Vente -->
    <div id="venteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Enregistrer une Vente</h3>
                    <button onclick="closeModal('venteModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <form action="{{ route('changer-statut-vendu', ['id' => '__id__']) }}" method="POST" class="p-6 space-y-4" id="venteForm">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom du client</label>
                    <input type="text" name="nom_client" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: Jean Dupont" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Téléphone</label>
                    <input type="text" name="telephone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 0123456789">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: jean@example.com">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Adresse</label>
                    <textarea name="adresse" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 123 Rue de la Paix" rows="2"></textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Quantité</label>
                    <input type="number" name="quantite" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: 1" min="1" required>
                </div>
            </form>
            <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeModal('venteModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                <button type="submit" form="venteForm" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Enregistrer la vente</button>
            </div>
        </div>
    </div>
    <script>
         // Fonction pour ouvrir/fermer les dropdown More
        function toggleDropdownMore(dropdownIdMore) {
            const dropdown = document.getElementById(dropdownIdMore);
            dropdown.classList.toggle('hidden');
        }
    </script>
@endsection