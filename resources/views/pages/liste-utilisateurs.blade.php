@extends('pages.entete')
@section('content')
    <div class="p-8 overflow-y-auto flex-1">
        <!-- En-tête avec bouton d'ajout -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Liste des Utilisateurs</h2>
            <button onclick="openModal('addUserModal')" class="flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-lg">
                <i class="fas fa-plus"></i>
                <span>Ajouter un utilisateur</span>
            </button>
        </div>

        <!-- Tableau des utilisateurs -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Rôle</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Date de création</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($liste_utilisateurs as $utilisateur)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"># {{ ($liste_utilisateurs->perPage() * ($liste_utilisateurs->currentPage() - 1 ))+ $loop->iteration }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">{{ $utilisateur->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $utilisateur->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">{{ $utilisateur->role->nom }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">01/06/2026</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Actif</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center space-x-2">
                                    {{-- <button onclick="openViewModal(1)" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                        <i class="fas fa-eye"></i>
                                    </button> --}}
                                    <button onclick="openEditModal(1)" class="px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="openDeleteModal(1)" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                Aucun utilisateur trouvé
                            </td>
                        </tr>
                        @endforelse
                        {{-- <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#2</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">Marie Martin</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">marie.martin@email.com</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Manager</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">02/06/2026</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Actif</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center space-x-2">
                                    <button onclick="openViewModal(2)" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="openEditModal(2)" class="px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="openDeleteModal(2)" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#3</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">Pierre Bernard</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">pierre.bernard@email.com</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Utilisateur</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">03/06/2026</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Actif</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center space-x-2">
                                    <button onclick="openViewModal(3)" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="openEditModal(3)" class="px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="openDeleteModal(3)" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">#4</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">Sophie Petit</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">sophie.petit@email.com</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Utilisateur</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">04/06/2026</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Inactif</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex items-center space-x-2">
                                    <button onclick="openViewModal(4)" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="openEditModal(4)" class="px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="openDeleteModal(4)" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Ajout Utilisateur -->
    <div id="addUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Ajouter un Utilisateur</h3>
                    <button onclick="closeModal('addUserModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <form method="POST" action="{{ route('ajout-utilisateur')}}" class="p-6 space-y-4" id="addUserForm">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom complet</label>
                    <input type="text" id="userName" name="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: Jean Dupont" oninput="validateAddForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" id="userEmail" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: jean.dupont@email.com" oninput="validateAddForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Mot de passe</label>
                    <input type="password" id="userPassword" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Mot de passe" oninput="validateAddForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Confirmer le mot de passe</label>
                    <input type="password" id="userPasswordConfirm" name="passwordConfirm" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Confirmer le mot de passe" oninput="validateAddForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Rôle</label>
                    <select id="userRole" name="role_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="validateAddForm()">
                        <option value="">Sélectionner...</option>
                        @foreach($liste_roles as $role)
                            <option value="{{ $role->id }}">{{ $role->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                    <button onclick="closeModal('addUserModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                    <button id="addUserBtn" type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition opacity-50 cursor-not-allowed" disabled>Ajouter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Voir Détails -->
    <div id="viewUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Détails de l'Utilisateur</h3>
                    <button onclick="closeModal('viewUserModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">ID</span>
                    <span class="text-sm text-gray-800" id="viewUserId">#1</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">Nom</span>
                    <span class="text-sm text-gray-800 font-semibold" id="viewUserName">Jean Dupont</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">Email</span>
                    <span class="text-sm text-gray-800" id="viewUserEmail">jean.dupont@email.com</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">Rôle</span>
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800" id="viewUserRole">Administrateur</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">Date de création</span>
                    <span class="text-sm text-gray-800" id="viewUserDate">01/06/2026</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm font-semibold text-gray-600">Statut</span>
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800" id="viewUserStatus">Actif</span>
                </div>
            </div>
            <div class="p-6 border-t border-gray-200 flex justify-end">
                <button onclick="closeModal('viewUserModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Fermer</button>
            </div>
        </div>
    </div>

    <!-- Modal Modifier Utilisateur -->
    <div id="editUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Modifier l'Utilisateur</h3>
                    <button onclick="closeModal('editUserModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <form class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom complet</label>
                    <input type="text" id="editUserName" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="Jean Dupont">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                    <input type="email" id="editUserEmail" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="jean.dupont@email.com">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Rôle</label>
                    <select id="editUserRole" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="admin" selected>Administrateur</option>
                        <option value="manager">Manager</option>
                        <option value="user">Utilisateur</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Statut</label>
                    <select id="editUserStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="active" selected>Actif</option>
                        <option value="inactive">Inactif</option>
                    </select>
                </div>
            </form>
            <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeModal('editUserModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Modifier</button>
            </div>
        </div>
    </div>

    <!-- Modal Confirmation Suppression -->
    <div id="deleteUserModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Confirmer la suppression</h3>
                <p class="text-gray-600 mb-6">Êtes-vous sûr de vouloir supprimer cet utilisateur ? Cette action est irréversible.</p>
                <div class="flex justify-center space-x-3">
                    <button onclick="closeModal('deleteUserModal')" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                    <button class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Supprimer</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            
            // Réinitialiser le formulaire d'ajout quand on ouvre le modal
            if (modalId === 'addUserModal') {
                document.getElementById('addUserForm').reset();
                validateAddForm();
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function validateAddForm() {
            const userName = document.getElementById('userName').value.trim();
            const userEmail = document.getElementById('userEmail').value.trim();
            const userPassword = document.getElementById('userPassword').value;
            const userPasswordConfirm = document.getElementById('userPasswordConfirm').value;
            const userRole = document.getElementById('userRole').value;
            const addBtn = document.getElementById('addUserBtn');
            
            if (userName && userEmail && userPassword && userPasswordConfirm && userRole && userPassword === userPasswordConfirm) {
                addBtn.disabled = false;
                addBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                addBtn.disabled = true;
                addBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        function openViewModal(userId) {
            // Simuler le chargement des données de l'utilisateur
            const users = {
                1: { name: 'Jean Dupont', email: 'jean.dupont@email.com', role: 'Administrateur', date: '01/06/2026', status: 'Actif' },
                2: { name: 'Marie Martin', email: 'marie.martin@email.com', role: 'Manager', date: '02/06/2026', status: 'Actif' },
                3: { name: 'Pierre Bernard', email: 'pierre.bernard@email.com', role: 'Utilisateur', date: '03/06/2026', status: 'Actif' },
                4: { name: 'Sophie Petit', email: 'sophie.petit@email.com', role: 'Utilisateur', date: '04/06/2026', status: 'Inactif' }
            };
            
            const user = users[userId];
            document.getElementById('viewUserId').textContent = '#' + userId;
            document.getElementById('viewUserName').textContent = user.name;
            document.getElementById('viewUserEmail').textContent = user.email;
            document.getElementById('viewUserRole').textContent = user.role;
            document.getElementById('viewUserDate').textContent = user.date;
            document.getElementById('viewUserStatus').textContent = user.status;
            
            openModal('viewUserModal');
        }

        function openEditModal(userId) {
            // Simuler le chargement des données pour l'édition
            const users = {
                1: { name: 'Jean Dupont', email: 'jean.dupont@email.com' },
                2: { name: 'Marie Martin', email: 'marie.martin@email.com' },
                3: { name: 'Pierre Bernard', email: 'pierre.bernard@email.com' },
                4: { name: 'Sophie Petit', email: 'sophie.petit@email.com' }
            };
            
            const user = users[userId];
            document.getElementById('editUserName').value = user.name;
            document.getElementById('editUserEmail').value = user.email;
            
            openModal('editUserModal');
        }

        function openDeleteModal(userId) {
            openModal('deleteUserModal');
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