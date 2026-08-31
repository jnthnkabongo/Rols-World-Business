@extends('pages.entete')
@section('content')
    <div class="p-8 overflow-y-auto flex-1">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Liste des Dettes</h2>
            <button onclick="openModal('addDetteModal')" class="flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-lg">
                <i class="fas fa-plus"></i>
                <span>Ajouter une dette</span>
            </button>
        </div>

        {{-- @if(session('success'))
            <div class="mb-4 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="mb-4 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Dettes aujourd'hui</p>
                        <p class="text-sm font-bold text-gray-800 mt-2">{{ $somme_dettes_aujourd_hui }} Personnes | Dettes</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total des dettes</p>
                        <p class="text-sm font-bold text-gray-800 mt-2">{{ $somme_toutes_dettes }} Personnes | Dettes</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-money-bill text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Somme des dettes en attente $</p>
                        <p class="text-sm font-bold text-gray-800 mt-2">{{ number_format($somme_dettes_en_attente, 2, ',',' ') }} $</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-dollar-sign text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Somme des dettes payés</p>
                        <p class="text-sm font-bold text-gray-800 mt-2">{{ number_format($somme_dettes_payer, 2, ',', ' ') }} $</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-franc-sign text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Créancier</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Montant</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Montant payé</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Reste</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date création</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date d'échéance</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">État</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($liste_dettes as $dette)
                            <tr class="hover:bg-gray-50 transition" data-dette-id="{{ $dette->id }}" data-dette-data='{{ json_encode([
                                "creancier" => $dette->creancier,
                                "montant" => $dette->montant,
                                "montant_payer" => $dette->montant_payer,
                                "reste_a_payer" => $dette->reste_a_payer,
                                "date_echeance" => $dette->date_echeance,
                                "statut" => $dette->statut,
                                "motif" => $dette->motif,
                            ]) }}'>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"># {{ $dette->id }}</td>
                                <td class="px-6 py-4 text-sm text-gray-700 font-semibold">{{ $dette->creancier }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ number_format($dette->montant, 2, ',', ' ') }} $</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ number_format($dette->montant_payer, 2, ',', ' ') }} $</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ number_format($dette->reste_a_payer, 2, ',', ' ') }} $</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $dette->created_at ? $dette->created_at->format('d/m/Y') : '-' }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $dette->date_echeance ? date('d/m/Y', strtotime($dette->date_echeance)) : '-' }}</td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $dette->statut === 'payée' ? 'bg-green-100 text-green-800' : ($dette->statut === 'partiellement payée' ? 'bg-orange-100 text-orange-800' : 'bg-yellow-100 text-yellow-800') }}">
                                        {{ ucfirst($dette->statut) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        <button onclick="openPaymentModal({{ $dette->id }})" class="px-3 py-2 bg-green-50 text-green-600 rounded-lg hover:bg-green-100 transition-all duration-200" title="Payer progressivement">
                                            <i class="fas fa-wallet"></i>
                                        </button>
                                        <button onclick="openEditModal({{ $dette->id }})" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200" title="Modifier">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteModal({{ $dette->id }})" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200" title="Supprimer">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                        <tr class="hover:bg-gray-50 transition">
                            <td colspan="9" class="px-6 py-4 text-center text-gray-500">
                                Aucune dette trouvée
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6 pb-4 mr-4 flex justify-end">
                {{ $liste_dettes->withQueryString()->links() }}
            </div>
        </div>
    </div>

    <div id="addDetteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Ajouter une dette</h3>
                    <button type="button" onclick="closeModal('addDetteModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <form method="POST" action="{{ route('ajouter-dette') }}" class="p-6 space-y-4" id="addDetteForm">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Créancier</label>
                        <input type="text" id="creancier" name="creancier" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nom du créancier" oninput="validateAddForm()">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Montant total</label>
                        <input type="number" id="montant" name="montant" step="0.01" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="0.00" oninput="validateAddForm()">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Montant payé</label>
                        <input type="number" id="montant_payer" name="montant_payer" step="0.01" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="0.00" oninput="validateAddForm()">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Date d'échéance</label>
                        <input type="date" id="date_echeance" name="date_echeance" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" oninput="validateAddForm()">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">État</label>
                        <select id="statut" name="statut" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="validateAddForm()">
                            <option value="">Choisir un état</option>
                            <option value="en attente">En attente</option>
                            <option value="payée">Payée</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Motif</label>
                        <input type="text" id="motif" name="motif" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Motif de la dette" oninput="validateAddForm()">
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeModal('addDetteModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                    <button id="addDetteBtn" type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition opacity-50 cursor-not-allowed" disabled>Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editDetteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Modifier la dette</h3>
                    <button type="button" onclick="closeModal('editDetteModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <form method="POST" class="p-6 space-y-4" id="editDetteForm">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Créancier</label>
                        <input type="text" id="editCreancier" name="creancier" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Nom du créancier">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Montant total</label>
                        <input type="number" id="editMontant" name="montant" step="0.01" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="0.00">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Montant payé</label>
                        <input type="number" id="editMontantPayer" name="montant_payer" step="0.01" min="0" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="0.00">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Date d'échéance</label>
                        <input type="date" id="editDateEcheance" name="date_echeance" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">État</label>
                        <select id="editStatut" name="statut" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="en attente">En attente</option>
                            <option value="payée">Payée</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Motif</label>
                        <input type="text" id="editMotif" name="motif" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Motif de la dette">
                    </div>
                </div>

                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeModal('editDetteModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <div id="payDetteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Payer une dette</h3>
                    <button type="button" onclick="closeModal('payDetteModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>

            <form method="POST" action="{{ route('payer-dette', ['id' => ':id']) }}" class="p-6 space-y-4" id="payDetteForm">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Montant à payer</label>
                    <input type="number" id="payDetteMontant" name="montant_payer" step="0.01" min="0.01" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="0.00" oninput="validatePaymentForm()">
                </div>
                <div class="text-sm text-gray-500" id="payDetteRestInfo">Reste à payer : 0.00 $</div>
                <div class="flex justify-end space-x-3 pt-4 border-t border-gray-200">
                    <button type="button" onclick="closeModal('payDetteModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                    <button id="payDetteBtn" type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition opacity-50 cursor-not-allowed" disabled>Payer</button>
                </div>
            </form>
        </div>
    </div>

    <div id="deleteDetteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Confirmer la suppression</h3>
                <p class="text-gray-600 mb-6">Êtes-vous sûr de vouloir supprimer cette dette ?</p>
                <div class="flex justify-center space-x-3">
                    <button type="button" onclick="closeModal('deleteDetteModal')" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                    <form action="{{ route('supprimer-dette', ['id' => ':id']) }}" method="POST" id="deleteDetteForm">
                        @csrf
                        <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Supprimer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            }

            if (modalId === 'addDetteModal') {
                document.getElementById('addDetteForm').reset();
                validateAddForm();
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            if (modal) {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }
        }

        function validateAddForm() {
            const creancier = document.getElementById('creancier').value.trim();
            const montant = document.getElementById('montant').value.trim();
            const montantPayer = document.getElementById('montant_payer').value.trim();
            const dateEcheance = document.getElementById('date_echeance').value.trim();
            const statut = document.getElementById('statut').value.trim();
            const motif = document.getElementById('motif').value.trim();
            const addBtn = document.getElementById('addDetteBtn');

            if (creancier && montant && montantPayer && dateEcheance && statut && motif) {
                addBtn.disabled = false;
                addBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                addBtn.disabled = true;
                addBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        function openEditModal(detteId) {
            const detteElement = document.querySelector(`[data-dette-id="${detteId}"]`);
            if (!detteElement) return;

            const detteData = JSON.parse(detteElement.getAttribute('data-dette-data'));
            document.getElementById('editCreancier').value = detteData.creancier || '';
            document.getElementById('editMontant').value = detteData.montant || '';
            document.getElementById('editMontantPayer').value = detteData.montant_payer || '';
            document.getElementById('editDateEcheance').value = detteData.date_echeance || '';
            document.getElementById('editStatut').value = detteData.statut || 'en attente';
            document.getElementById('editMotif').value = detteData.motif || '';

            const form = document.getElementById('editDetteForm');
            form.action = '{{ route("modifier-dette", ["id" => ":id"]) }}'.replace(':id', detteId);

            openModal('editDetteModal');
        }

        function openPaymentModal(detteId) {
            const detteElement = document.querySelector(`[data-dette-id="${detteId}"]`);
            if (!detteElement) return;

            const detteData = JSON.parse(detteElement.getAttribute('data-dette-data'));
            const reste = Number(detteData.reste_a_payer || 0);
            const montantInput = document.getElementById('payDetteMontant');
            const info = document.getElementById('payDetteRestInfo');
            montantInput.max = reste;
            montantInput.value = '';
            info.textContent = 'Reste à payer : ' + Number(reste).toFixed(2) + ' $';

            const form = document.getElementById('payDetteForm');
            form.action = '{{ route("payer-dette", ["id" => ":id"]) }}'.replace(':id', detteId);

            validatePaymentForm();
            openModal('payDetteModal');
        }

        function validatePaymentForm() {
            const montantInput = document.getElementById('payDetteMontant');
            const btn = document.getElementById('payDetteBtn');
            const value = Number(montantInput.value || 0);
            const max = Number(montantInput.max || 0);

            if (value > 0 && value <= max) {
                btn.disabled = false;
                btn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                btn.disabled = true;
                btn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        function openDeleteModal(detteId) {
            const form = document.getElementById('deleteDetteForm');
            form.action = '{{ route("supprimer-dette", ["id" => ":id"]) }}'.replace(':id', detteId);
            openModal('deleteDetteModal');
        }

        window.onclick = function(event) {
            if (event.target.classList.contains('fixed')) {
                event.target.classList.add('hidden');
                event.target.classList.remove('flex');
            }
        }
    </script>
@endsection