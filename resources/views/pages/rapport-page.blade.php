@extends('pages.entete')
@section('content')
    <!-- Main Content -->
    <main class="p-4 md:p-8 overflow-y-auto flex-1">
     
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Rapport de ventes</h2>
            <button onclick="openModal('addUserModal')" class="flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-lg">
                <i class="fas fa-plus"></i>
                <span>Rapport de vente</span>
            </button>
        </div>

        <!-- Stats Cards with Gradients - Devise 1 ($) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
            <div class="bg-gradient-to-br from-green-400 to-green-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-xs md:text-sm font-medium">Bénéfice Total ($)</p>
                        <p class="text-xl md:text-3xl font-bold text-white mt-1">{{ number_format($benefice_total_dollar, 2, ',', ' ') }} $</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-chart-line text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-blue-400 to-blue-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-xs md:text-sm font-medium">Total Ventes ($)</p>
                        <p class="text-xl md:text-3xl font-bold text-white mt-1">{{ number_format($somme_ventes_dollar, 2, ',', ' ') }} $</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-shopping-cart text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-orange-400 to-orange-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-xs md:text-sm font-medium">Bénéfice Moyen ($)</p>
                        <p class="text-xl md:text-3xl font-bold text-white mt-1">{{ number_format($benefice_moyen_dollar, 2, ',', ' ') }} $</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-calculator text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-amber-400 to-amber-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-amber-100 text-xs md:text-sm font-medium">Meilleur Produit ($)</p>
                        <p class="text-xl md:text-3xl font-bold text-white mt-1">{{ $meilleur_produit_dollar->nom ?? '-' }}</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-trophy text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Cards with Gradients - Devise 2 (FC) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mb-6 md:mb-8">
            <div class="bg-gradient-to-br from-purple-400 to-purple-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-xs md:text-sm font-medium">Bénéfice Total (FC)</p>
                        <p class="text-xl md:text-3xl font-bold text-white mt-1">{{ number_format($benefice_total_fc, 2, ',', ' ') }} FC</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-chart-line text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-indigo-400 to-indigo-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-indigo-100 text-xs md:text-sm font-medium">Total Ventes (FC)</p>
                        <p class="text-xl md:text-3xl font-bold text-white mt-1">{{ number_format($somme_ventes_fc, 2, ',', ' ') }} FC</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-shopping-cart text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-pink-400 to-pink-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-pink-100 text-xs md:text-sm font-medium">Bénéfice Moyen (FC)</p>
                        <p class="text-xl md:text-3xl font-bold text-white mt-1">{{ number_format($benefice_moyen_fc, 2, ',', ' ') }} FC</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-calculator text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-rose-400 to-rose-600 p-4 md:p-6 rounded-2xl shadow-lg card-hover transition-all duration-300 transform hover:scale-105">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-rose-100 text-xs md:text-sm font-medium">Meilleur Produit (FC)</p>
                        <p class="text-xl md:text-3xl font-bold text-white mt-1">{{ $meilleur_produit_fc->nom ?? '-' }}</p>
                    </div>
                    <div class="w-12 h-12 md:w-16 md:h-16 bg-white bg-opacity-20 rounded-2xl flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-trophy text-white text-xl md:text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-2xl shadow-lg p-2 md:p-4 mb-4 md:mb-8">
            
            <form action="{{ route('liste-rapports') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-4">
                <div>
                    <h2 class="text-lg md:text-xl font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-filter text-blue-600 mr-2"></i>
                        Filtres
                    </h2>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date début</label>
                    <input type="date" name="date_debut" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ request('date_debut') ?? '' }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Date fin</label>
                    <input type="date" name="date_fin" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ request('date_fin') ?? '' }}">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Produit</label>
                    <select name="produit_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Tous les produits</option>
                        @foreach($liste_produits as $produit)
                            <option value="{{ $produit->id }}" {{ request('produit_id') == $produit->id ? 'selected' : '' }}>{{ $produit->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Devise</label>
                    <select name="devise_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Toutes les devises</option>
                        <option value="1" {{ request('devise_id') == '1' ? 'selected' : '' }}>Dollar ($)</option>
                        <option value="2" {{ request('devise_id') == '2' ? 'selected' : '' }}>FC</option>
                    </select>
                </div>
                <div class="flex items-end space-x-2">
                    <button type="submit" class="flex-1 bg-gradient-to-r from-blue-600 to-blue-600 text-white py-2 px-2 rounded-lg hover:from-blue-700 hover:to-blue-700 transition-all duration-300">
                        <i class="fas fa-search mr-2"></i>Filtrer
                    </button>
                    <a href="{{ route('liste-rapports') }}" class="flex-1 bg-gray-100 text-gray-700 py-2 px-2 rounded-lg hover:from-gray-200 transition">
                        <i class="fas fa-redo mr-2"></i>Réinitialiser
                    </a>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-4 md:p-6">
                <h2 class="text-lg md:text-xl font-bold text-white flex items-center">
                    <i class="fas fa-table mr-2"></i>
                    Détails des Ventes
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Produit</th>
                            <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date Vente</th>
                            <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Numéro Série</th>
                            <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prix d'achat</th>
                            <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Prix Vente</th>
                            <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Quantité</th>
                            <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Coût Total</th>
                            <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Bénéfice</th>
                            <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Marge</th>
                            <th class="px-3 md:px-6 py-3 md:py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Devise</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($details_ventes as $detail)
                        @php
                            $prix_achat = $detail->produitUnite->produit->prix_achat ?? 0;
                            $cout_total = $detail->total;
                            $cout_achat = $prix_achat * $detail->quantite;
                            $benefice = $cout_total - $cout_achat;
                            $prix_vente_unitaire = $detail->quantite > 0 ? $detail->total / $detail->quantite : 0;
                            $marge = $prix_vente_unitaire > 0 ? (($prix_vente_unitaire - $prix_achat) / $prix_vente_unitaire) * 100 : 0;
                        @endphp
                        <tr class="hover:bg-blue-50 transition">
                            <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-700">{{ $detail->produitUnite->produit->nom ?? '-' }}</td>
                            {{-- <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">{{ $detail->date_vente->format('d/m/Y') }}</td> --}}
                            <td class="...">
                                {{ \Carbon\Carbon::parse($detail->date_vente)->format('d/m/Y') }}
                            </td>
                            <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-500">{{ $detail->produitUnite->numero_serie ?? '-' }}</td>
                            <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-700">{{ number_format($prix_achat, 2, ',', ' ') }} {{ $detail->vente->venteDevise->logo ?? '-' }}</td>
                            <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-700">{{ number_format($prix_vente_unitaire, 2, ',', ' ') }} {{ $detail->vente->venteDevise->logo ?? '-' }}</td>
                            <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-700">{{ $detail->quantite ?? '-' }}</td>
                            <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-700">{{ number_format($cout_total, 2, ',', ' ') }} {{ $detail->vente->venteDevise->logo ?? '-' }}</td>
                            <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm font-semibold {{ $benefice >= 0 ? 'text-green-600' : 'text-red-600' }}">{{ number_format($benefice, 2, ',', ' ') }} {{ $detail->vente->venteDevise->logo ?? '-' }}</td>
                            <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm font-semibold {{ $marge >= 0 ? 'text-green-600' : 'text-red-600' }}">{{ number_format($marge, 2, ',', ' ') }} %</td>
                            <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap text-xs md:text-sm text-gray-700">{{ $detail->vente->venteDevise->logo ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-3 md:px-6 py-3 md:py-4 text-center text-xs md:text-sm text-gray-500">Aucune vente trouvée</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            @if($details_ventes->hasPages())
            <div class="p-4 md:p-6 border-t border-gray-200">
                {{ $details_ventes->links() }}
            </div>
            @endif
        </div>
    </main>
@endsection