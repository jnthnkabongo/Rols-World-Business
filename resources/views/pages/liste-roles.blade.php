@extends('pages.entete')
@section('content')
    <div class="p-8 overflow-y-auto flex-1">
        <!-- En-tête avec bouton d'ajout -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Liste des Rôles</h2>
            <button onclick="openModal('addRoleModal')" class="flex items-center space-x-2 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow-lg">
                <i class="fas fa-plus"></i>
                <span>Ajouter un rôle</span>
            </button>
        </div>

        <!-- Tableau des rôles -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Permissions</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Statut</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($liste_roles as $role)
                            <tr class="hover:bg-gray-50 transition" data-role-id="{{ $role->id }}" data-role-data='{{ json_encode(['nom' => $role->nom, 'description' => $role->description]) }}'>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"># {{ ($liste_roles->perPage() * ($liste_roles->currentPage() - 1 ))+ $loop->iteration }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-semibold">{{ $role->nom }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $role->description }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">CRUD</span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">Settings</span>
                                        <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded text-xs">Users</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Actif</span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center space-x-2">
                                        {{-- <button onclick="openViewModal({{ $role->id }})" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-all duration-200">
                                            <i class="fas fa-eye"></i>
                                        </button> --}}
                                        <button onclick="openEditModal({{ $role->id }})" class="px-3 py-2 bg-gray-50 text-gray-600 rounded-lg hover:bg-gray-100 transition-all duration-200">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button onclick="openDeleteModal({{ $role->id }})" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-all duration-200">
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
            <div class="mt-6 pb-4 mr-2 flex justify-end bg-primary">
                {{ $liste_roles->withQueryString()->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Ajout Rôle -->
    <div id="addRoleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Ajouter un Rôle</h3>
                    <button onclick="closeModal('addRoleModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <form method="POST" action="{{ route('ajout-role') }}" class="p-6 space-y-4" id="addRoleForm">
                @csrf
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom du rôle</label>
                    <input type="text" id="roleName" name="nom" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Ex: Administrateur" oninput="validateAddForm()">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <textarea id="roleDescription" name="description" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" placeholder="Description du rôle..." oninput="validateAddForm()"></textarea>
                </div>
                <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeModal('addRoleModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                <button id="addRoleBtn" type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition opacity-50 cursor-not-allowed" disabled>Ajouter</button>
            </div>
            </form>
        </div>
    </div>

    <!-- Modal Voir Détails -->
    <div id="viewRoleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Détails du Rôle</h3>
                    <button onclick="closeModal('viewRoleModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">ID</span>
                    <span class="text-sm text-gray-800" id="viewRoleId">#1</span>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">Nom</span>
                    <span class="text-sm text-gray-800 font-semibold" id="viewRoleName">Administrateur</span>
                </div>
                <div class="py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600 block mb-1">Description</span>
                    <p class="text-sm text-gray-800" id="viewRoleDescription">Accès complet au système</p>
                </div>
                <div class="py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600 block mb-1">Permissions</span>
                    <div class="flex flex-wrap gap-1" id="viewRolePermissions">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">CRUD</span>
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">Settings</span>
                        <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded text-xs">Users</span>
                    </div>
                </div>
                <div class="flex justify-between items-center py-2 border-b border-gray-100">
                    <span class="text-sm font-semibold text-gray-600">Utilisateurs</span>
                    <span class="text-sm text-gray-800" id="viewRoleUsers">3</span>
                </div>
                <div class="flex justify-between items-center py-2">
                    <span class="text-sm font-semibold text-gray-600">Statut</span>
                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800" id="viewRoleStatus">Actif</span>
                </div>
            </div>
            <div class="p-6 border-t border-gray-200 flex justify-end">
                <button onclick="closeModal('viewRoleModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Fermer</button>
            </div>
        </div>
    </div>

    <!-- Modal Modifier Rôle -->
    <div id="editRoleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg mx-4 transform transition-all">
            <div class="p-6 border-b border-gray-200">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Modifier le Rôle</h3>
                    <button onclick="closeModal('editRoleModal')" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            <form action="{{ route('modifier-role', ['id' => ':id']) }}" method="POST" class="p-6 space-y-4" id="editRoleForm">
                @csrf
                <input type="hidden" id="editRoleId" name="id" value="">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nom du rôle</label>
                    <input type="text" id="editRoleName" name="nom" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" value="Administrateur">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <textarea id="editRoleDescription" name="description" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3">Accès complet au système</textarea>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Permissions</label>
                    <div class="grid grid-cols-2 gap-2">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" checked class="w-4 h-4 text-blue-600 rounded">
                            <span class="text-sm text-gray-700">CRUD Utilisateurs</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" checked class="w-4 h-4 text-blue-600 rounded">
                            <span class="text-sm text-gray-700">Gestion Ventes</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" checked class="w-4 h-4 text-blue-600 rounded">
                            <span class="text-sm text-gray-700">Paramètres</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="w-4 h-4 text-blue-600 rounded">
                            <span class="text-sm text-gray-700">Rapports</span>
                        </label>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Statut</label>
                    <select id="editRoleStatus" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="active" selected>Actif</option>
                        <option value="inactive">Inactif</option>
                    </select>
                </div>
            </form>
            <div class="p-6 border-t border-gray-200 flex justify-end space-x-3">
                <button onclick="closeModal('editRoleModal')" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                <button type="submit" form="editRoleForm" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">Modifier</button>
            </div>
        </div>
    </div>

    <!-- Modal Confirmation Suppression -->
    <div id="deleteRoleModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 transform transition-all">
            <div class="p-6 text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-red-600 text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Confirmer la suppression</h3>
                <p class="text-gray-600 mb-6">Êtes-vous sûr de vouloir supprimer ce rôle ? Cette action est irréversible.</p>
                <div class="flex justify-center space-x-3">
                    <button onclick="closeModal('deleteRoleModal')" class="px-6 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition">Annuler</button>
                    <form action="{{ route('supprimer-role', ['id' => ':id']) }}" method="POST" id="deleteRoleForm">
                        @csrf
                        <input type="hidden" id="deleteRoleId" name="id" value="">
                        <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Supprimer</button>
                    </form>
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
            if (modalId === 'addRoleModal') {
                document.getElementById('addRoleForm').reset();
                validateAddForm();
            }
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function validateAddForm() {
            const roleName = document.getElementById('roleName').value.trim();
            const roleDescription = document.getElementById('roleDescription').value.trim();
            const addBtn = document.getElementById('addRoleBtn');
            
            if (roleName && roleDescription) {
                addBtn.disabled = false;
                addBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            } else {
                addBtn.disabled = true;
                addBtn.classList.add('opacity-50', 'cursor-not-allowed');
            }
        }

        function openViewModal(roleId) {
            // Simuler le chargement des données du rôle
            const roles = {
                1: { name: 'Administrateur', description: 'Accès complet au système', permissions: ['CRUD', 'Settings', 'Users'], users: 3, status: 'Actif' },
                2: { name: 'Manager', description: 'Gestion des ventes et clients', permissions: ['Read', 'Sales'], users: 5, status: 'Actif' },
                3: { name: 'Utilisateur', description: 'Accès limité aux ventes', permissions: ['Read'], users: 12, status: 'Actif' },
                4: { name: 'Invité', description: 'Accès en lecture seule', permissions: ['View'], users: 0, status: 'Inactif' }
            };
            
            const role = roles[roleId];
            document.getElementById('viewRoleId').textContent = '#' + roleId;
            document.getElementById('viewRoleName').textContent = role.name;
            document.getElementById('viewRoleDescription').textContent = role.description;
            document.getElementById('viewRoleUsers').textContent = role.users;
            document.getElementById('viewRoleStatus').textContent = role.status;
            
            const permissionsContainer = document.getElementById('viewRolePermissions');
            permissionsContainer.innerHTML = role.permissions.map(perm => 
                `<span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">${perm}</span>`
            ).join('');
            
            openModal('viewRoleModal');
        }

        function openEditModal(roleId) {
            // Trouver le rôle dans les données de la vue
            const roleElement = document.querySelector(`[data-role-id="${roleId}"]`);
            if (roleElement) {
                const roleData = JSON.parse(roleElement.getAttribute('data-role-data'));
                document.getElementById('editRoleName').value = roleData.nom;
                document.getElementById('editRoleDescription').value = roleData.description || '';
            }
            
            // Mettre à jour l'action du formulaire avec l'ID réel
            const form = document.getElementById('editRoleForm');
            form.action = form.action.replace(':id', roleId);
            document.getElementById('editRoleId').value = roleId;
            
            openModal('editRoleModal');
        }

        function openDeleteModal(roleId) {
            // Mettre à jour l'action du formulaire avec l'ID réel
            const form = document.getElementById('deleteRoleForm');
            form.action = form.action.replace(':id', roleId);
            document.getElementById('deleteRoleId').value = roleId;
            
            openModal('deleteRoleModal');
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