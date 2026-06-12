<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use App\Models\Produit;
use App\Models\Categorie;
use App\Models\Categories;
use App\Models\Marque;
use App\Models\Marques;
use App\Models\Produits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.dashboard');
    }


    //*************** La mecanique concernant la gestion des roles CRUD */ 
    
    ///// 1. Lecture des donnees de la liste de roles
    public function roles()
    {
        $liste_roles = Roles::paginate(2);
        return view('pages.liste-roles', compact('liste_roles'));
    }
    ///// 2. La creation d'un role
    public function AjouterRole(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            $role = new Roles();
            $role->nom = $validated['nom'];
            $role->description = $validated['description'] ?? null;
            $role->save();
            //dd($role);
            return redirect()->route('liste-roles')->with('success', 'Rôle ajouté avec succès');

        } catch (\Throwable $th) {
            return redirect()->route('liste-roles')->with('error', 'Erreur lors de l\'ajout du rôle');
        }
    }
    ///// 3. La modification d'un role
    public function ModifierRole(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        try {
            $role = Roles::find($id);
            $role->nom = $validated['nom'];
            $role->description = $validated['description'] ?? null;
            $role->save();
            //dd($role);
            return redirect()->route('liste-roles')->with('success', 'Rôle modifié avec succès');

        } catch (\Throwable $th) {
            return redirect()->route('liste-roles')->with('error', 'Erreur lors de la modification du rôle');
        }
    }
    ///// 4. La suppression d'un role
    public function SupprimerRole($id)
    {
        try {
            $role = Roles::find($id);
            $role->delete();
            //dd($role);
            return redirect()->route('liste-roles')->with('success', 'Rôle supprimé avec succès');

        } catch (\Throwable $th) {
            return redirect()->route('liste-roles')->with('error', 'Erreur lors de la suppression du rôle');
        }
    }


    //*************** La mecanique concernant la gestion des roles CRUD */ 
    
    //// 1. Lecture des donnees de la liste des utilisateurs
    public function utilisateurs()
    {
        $liste_utilisateurs = User::with('role')->paginate(2);
        $liste_roles = Roles::orderBy('nom', 'asc')->get();
        return view('pages.liste-utilisateurs', compact('liste_utilisateurs', 'liste_roles'));
    }
    //// 2. Creation de l'utilisateur
    public function AjouterUtilisateur(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role_id' => 'required|exists:roles,id',
        ]);
        
        try {
            $user = new User();
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->password = bcrypt($validated['password']);
            $user->role_id = $validated['role_id'];
            $user->save();
            //dd($user);
            return redirect()->route('liste-utilisateurs')->with('success', 'Utilisateur ajouté avec succès');

        } catch (\Throwable $th) {
            return redirect()->route('liste-utilisateurs')->with('error', 'Erreur lors de l\'ajout de l\'utilisateur');
        }
    }
    //// 3. Modification de l'utilisateur
    public function ModifierUtilisateur(Request $request, $id){
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role_id' => 'required|exists:roles,id',
        ]);
        
        try {
            $user = User::find($id);
            $user->name = $validated['name'];
            $user->email = $validated['email'];
            $user->password = bcrypt($validated['password']) ?? null;
            $user->role_id = $validated['role_id'] ?? null;
            $user->save();
            dd($user);
            return redirect()->route('liste-utilisateurs')->with('success', 'Utilisateur modifié avec succès');

        } catch (\Throwable $th) {
            return redirect()->route('liste-utilisateurs')->with('error', 'Erreur lors de la modification de l\'utilisateur');
        }
    }
    //// 4. Suppression de l'utilisateur
    public function SupprimerUtilisateur($id){
        try {
            $user = User::find($id);
            $user->delete();
            return redirect()->route('liste-utilisateurs')->with('success', 'Utilisateur supprimé avec succès');
        } catch (\Throwable $th) {
            return redirect()->route('liste-utilisateurs')->with('error', 'Erreur lors de la suppression de l\'utilisateur');
        }
    }

    //*************** La mecanique concernant la gestion des founitures CRUD */ 

    //// 1. Lecture des donnees de la liste des fournisseurs
    public function fournisseurs()
    {
        return view('pages.liste-fournisseurs');
    }

    //// Ajout d'une marque
    public function AjouterMarque(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255|unique:marques,nom',
            'description' => 'nullable|string',
        ]);

        try {
            $marque = new Marques();
            $marque->categorie_id = $validated['categorie_id'];
            $marque->nom = $validated['nom'];
            $marque->description = $validated['description'] ?? null;
            $marque->save();
            
            return redirect()->route('liste-produits')->with('success', 'Marque ajoutée avec succès');

        } catch (\Throwable $th) {
            return redirect()->route('liste-produits')->with('error', 'Erreur lors de l\'ajout de la marque');
        }
    }
    
    //*************** La mecanique concernant la gestion des produits CRUD */ 

    //// 1. Lecture des donnees de la liste des produits
    public function produits()
    {
        
        $produits_electroniques = Produits::with(['categorie', 'marque'])
            ->where('categorie_id', '=', 1)
            ->paginate(10);
        
        $chaussures = Produits::with(['categorie', 'marque'])
            ->where('categorie_id', '=', 2)
            ->paginate(10);
        
        $categories = Categories::all();
        $marques_electroniques = Marques::where('categorie_id', '=', 1)->get();
        $marques_chaussures = Marques::where('categorie_id', '=', 2)->get();
        
        return view('pages.liste-produits', compact('produits_electroniques', 'chaussures', 'categories', 'marques_electroniques', 'marques_chaussures'));
    }

    //// 2. Ajout d'un produit
    public function AjouterProduit(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'marque_id' => 'required|exists:marques,id',
            'modele' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'prix_achat' => 'nullable|numeric',
            'prix_vente' => 'required|numeric',
            'stock_min' => 'nullable|integer',
            'status' => 'required|string|in:available,low_stock,out_of_stock',
            'taille' => 'nullable|string',
        ]);

        try {
            $produit = new Produits();
            $produit->nom = $validated['nom'];
            $produit->categorie_id = $validated['categorie_id'];
            $produit->marque_id = $validated['marque_id'];
            $produit->modele = $validated['modele'] ?? null;
            $produit->description = $validated['description'] ?? null;
            $produit->prix_achat = $validated['prix_achat'] ?? null;
            $produit->prix_vente = $validated['prix_vente'];
            $produit->stock_min = $validated['stock_min'] ?? 1;
            $produit->status = $validated['status'];
            $produit->taille = $validated['taille'] ?? null;
            $produit->save();
            
            return redirect()->route('liste-produits')->with('success', 'Produit ajouté avec succès');

        } catch (\Throwable $th) {
            return redirect()->route('liste-produits')->with('error', 'Erreur lors de l\'ajout du produit');
        }
    }

    //// 3. Modification d'un produit
    public function ModifierProduit(Request $request, $id)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'categorie_id' => 'required|exists:categories,id',
            'marque_id' => 'required|exists:marques,id',
            'modele' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'prix_achat' => 'nullable|numeric',
            'prix_vente' => 'required|numeric',
            'stock_min' => 'nullable|integer',
            'stock' => 'required|integer',
            'status' => 'required|string|in:available,low_stock,out_of_stock',
            'taille' => 'nullable|string',
        ]);

        try {
            $produit = Produits::find($id);
            $produit->nom = $validated['nom'];
            $produit->categorie_id = $validated['categorie_id'];
            $produit->marque_id = $validated['marque_id'];
            $produit->modele = $validated['modele'] ?? null;
            $produit->description = $validated['description'] ?? null;
            $produit->prix_achat = $validated['prix_achat'] ?? null;
            $produit->prix_vente = $validated['prix_vente'];
            $produit->stock_min = $validated['stock_min'] ?? 1;
            $produit->stock = $validated['stock'];
            $produit->status = $validated['status'];
            $produit->taille = $validated['taille'] ?? null;
            $produit->save();
            
            return redirect()->route('liste-produits')->with('success', 'Produit modifié avec succès');

        } catch (\Throwable $th) {
            return redirect()->route('liste-produits')->with('error', 'Erreur lors de la modification du produit');
        }
    }

    //// 4. Suppression d'un produit
    public function SupprimerProduit($id)
    {
        try {
            $produit = Produits::find($id);
            $produit->delete();
            return redirect()->route('liste-produits')->with('success', 'Produit supprimé avec succès');
        } catch (\Throwable $th) {
            return redirect()->route('liste-produits')->with('error', 'Erreur lors de la suppression du produit');
        }
    }

    //// 5. Récupérer les données d'un produit pour les modals
    public function getProductData($id)
    {
        try {
            $produit = Produits::with(['categorie', 'marque'])->find($id);
            if (!$produit) {
                return response()->json(['error' => 'Produit non trouvé'], 404);
            }
            return response()->json($produit);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Erreur lors de la récupération du produit'], 500);
        }
    }

    //// 1. Lecture des donnees de la liste des ventes
    public function ventes()
    {
        return view('pages.liste-ventes');
    }

    public function remises()
    {
        return view('pages.liste-remises');
    }

    public function rapports(){
        return view('pages.rapport-page');
    }

    public function historiques()
    {
        return view('pages.historiques');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
