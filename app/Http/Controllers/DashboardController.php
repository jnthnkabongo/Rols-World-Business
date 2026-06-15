<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use App\Models\Categories;
use App\Models\Marques;
use App\Models\Produits;
use App\Models\ProduitUnites;
use App\Models\Clients;
use App\Models\Remises;
use App\Models\VenteDetails;
use App\Models\Ventes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            'categorie_id' => 'required|exists:categories,id'
        ]);

        try {
            $marque = new Marques();
            $marque->categorie_id = $validated['categorie_id'];
            $marque->nom = $validated['nom'];
            $marque->description = $validated['description'] ?? null;
            $marque->save();
            //dd($marque);
            
            return redirect()->route('liste-produits')->with('success', 'Marque ajoutée avec succès');

        } catch (\Throwable $th) {
            return redirect()->route('liste-produits')->with('error', 'Erreur lors de l\'ajout de la marque');
        }
    }
    
    //*************** La mecanique concernant la gestion des produits CRUD */ 

    //// 1. Lecture des donnees de la liste des produits
    public function produits()
    {
        $dernierId = ProduitUnites::max('id');
        $numeros = ($dernierId ?? 0) + 1;
        $reference = 'CHAUSSURE-' .str_pad($numeros, 3, '0', STR_PAD_LEFT);

        $produits_electroniques = Produits::with(['categorie', 'marque','produitUnites'])
            ->where('categorie_id', '=', 1)
            ->paginate(5);
        
        $chaussures = Produits::with(['categorie', 'marque', 'produitUnites'])
            ->where('categorie_id', '=', 2)
            ->paginate(3);
        
        $categories = Categories::all();
        $marques_electroniques = Marques::where('categorie_id', '=', 1)->get();
        $marques_chaussures = Marques::where('categorie_id', '=', 2)->get();
        
        return view('pages.liste-produits', compact('produits_electroniques', 'chaussures', 'categories', 'marques_electroniques', 'marques_chaussures', 'reference'));
    }

    // public function numeroSerieChaussure(){
    //     $numero = random_int(1,100000000000000000);
    //     $dernierId = ProduitUnites::max('id');
    //     $numeros = ($dernierId ?? 0) + 1;
    //     $reference = 'CHAUSSURE-' .str_pad($numeros, 3, '0', STR_PAD_LEFT);

    // }

    public function AjouterProduit(Request $request)
    {
        $validated = $request->validate([
            'nom'            => 'required|string|max:255',
            'categorie_id'   => 'required|exists:categories,id',
            'marque_id'      => 'required|exists:marques,id',
            'modele'         => 'nullable|string|max:100',
            'description'    => 'nullable|string',
            'prix_achat'     => 'nullable|numeric|min:0',
            'prix_vente'     => 'required|numeric|min:0',
            'taille'         => 'nullable|string|max:50',
            'numero_serie'   => 'required|string|max:255|unique:produit_unites,numero_serie',
            'quantite'       => 'required|numeric|min:0',
        ]);

        try {
            $produit = DB::transaction(function () use ($validated) {

                $produit = Produits::create([
                    'nom'          => $validated['nom'],
                    'categorie_id' => $validated['categorie_id'],
                    'marque_id'    => $validated['marque_id'],
                    'modele'       => $validated['modele'] ?? null,
                    'description'  => $validated['description'] ?? null,
                    'prix_achat'   => $validated['prix_achat'] ?? null,
                    'prix_vente'   => $validated['prix_vente'],
                    'taille'       => $validated['taille'] ?? null,
                ]);

                ProduitUnites::create([
                    'produit_id'   => $produit->id,
                    'numero_serie' => $validated['numero_serie'],
                    'statut'       => 'en_stock',
                    'quantite'     => $validated['quantite'] ?? null,
                ]);

                return $produit;
            });

            return redirect()
                ->route('liste-produits')
                ->with(
                    'success',
                    "Le produit {$produit->nom} a été ajouté avec succès."
                );

        } catch (\Exception $e) {

            \Log::error('Erreur lors de l\'ajout du produit', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with(
                    'error',
                    "Une erreur est survenue: " . $e->getMessage()
                );
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
            $produit->taille = $validated['taille'] ?? null;
            $produit->save();
            
            return redirect()->route('liste-produits')->with('success', 'Produit modifié avec succès');

        } catch (\Throwable $th) {
            return redirect()->route('liste-produits')->with('error', 'Erreur lors de la modification du produit')
            ->with('error', 'Erreur: ' . $th->getMessage());
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
            return redirect()->route('liste-produits')->with('error', 'Erreur lors de la suppression du produit')
            ->with('error', 'Erreur: ' . $th->getMessage());
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
            return response()->json(['error' => 'Erreur lors de la récupération du produit'], 500)
            ->with('error', 'Erreur: ' . $th->getMessage());
        }
    }

    //// Changer le statut du produit en remise
    public function changerStatutRemise(Request $request, $id)
    {
        $validated = $request->validate([
            'nom_remise' => 'required|string|max:255',
            'telephone_remise' => 'nullable|string|max:50',
            'quantite' => 'required|integer|max:255',
        ]);

        try {
            $produitUnite = ProduitUnites::where('produit_id', $id)->first();
            if (!$produitUnite) {
                return redirect()->route('liste-produits')->with('error', 'Unité de produit non trouvée');
            }

            $produitUnite->statut = 'remise';

            // Soustraire la quantité dans produit_unites (stock du produit)
            $currentQuantite = is_numeric($produitUnite->quantite) ? $produitUnite->quantite : 0;
            $produitUnite->quantite = max(0, $currentQuantite - $validated['quantite']);
            $produitUnite->save();

            // Enregistrer la remise dans la table remises
            $produit = Produits::find($id);
            if ($produit) {
                Remises::create([
                    'user_id' => Auth::id(),
                    'produit_id' => $id,
                    'nom_remise' => $validated['nom_remise'],
                    'telephone_remise' => $validated['telephone_remise'] ?? null,
                    'quantite' => $validated['quantite'] ?? null,
                ]);
            }

            return redirect()->route('liste-produits')->with('success', 'Statut changé en remise avec succès');
        } catch (\Throwable $th) {
            return redirect()->route('liste-produits')->with('error', 'Erreur lors du changement de statut');
        }
    }

    //// Changer le statut de la remise et la suppression dans la liste des remises
    public function changerStatutDisponible(Request $request, $id)
    {
        try {
            // Récupérer la remise
            $remise = Remises::findOrFail($id);

            // Récupérer le produit_unite correspondant
            $produitUnite = ProduitUnites::where('produit_id', $remise->produit_id)->first();

            if (!$produitUnite) {
                return redirect()->route('liste-remises')->with('error', 'Unité de produit non trouvée');
            }

            // Additionner la quantité de la remise avec la quantité du produit_unite
            $produitUnite->quantite += $remise->quantite;
            $produitUnite->statut = 'en_stock';
            $produitUnite->save();

            // Supprimer la remise
            $remise->delete();

            return redirect()->route('liste-remises')->with('success', 'Remise supprimée et quantité restituée avec succès');
        } catch (\Throwable $th) {
            return redirect()->route('liste-remises')->with('error', 'Erreur lors de la suppression de la remise');
        }
    }

    //// Changer le statut du produit en vendu & fonction d'enregistrement de vente
    public function changerStatutVendu(Request $request, $id)
    {
        $validated = $request->validate([
            'nom_client' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:150',
            'adresse' => 'nullable|string',
            'quantite' => 'required|integer|min:1',
        ]);

        try {

            DB::transaction(function () use ($validated, $id) {

                $produit = Produits::findOrFail($id);

                $produitUnite = ProduitUnites::where('produit_id', $id)->first();

                if (!$produitUnite) {
                    throw new \Exception('Unité de produit non trouvée');
                }

                if ($produitUnite->quantite < $validated['quantite']) {
                    throw new \Exception('Quantité insuffisante en stock');
                }

                $client = Clients::firstOrCreate(
                    ['nom_client' => $validated['nom_client']],
                    [
                        'telephone' => $validated['telephone'] ?? null,
                        'email' => $validated['email'] ?? null,
                        'adresse' => $validated['adresse'] ?? null,
                    ]
                );

                $vente = Ventes::create([
                    'client_id' => $client->id,
                    'user_id' => Auth::id(),
                    'date_vente' => now(),
                    'total' => $produit->prix_vente * $validated['quantite'],
                    'statut' => 'paye',
                ]);

                VenteDetails::create([
                    'vente_id' => $vente->id,
                    'produit_unite_id' => $produitUnite->id,
                    'quantite' => $validated['quantite'],
                    'prix_unitaire' => $produit->prix_vente,
                    'total' => $produit->prix_vente * $validated['quantite'],
                ]);

                $produitUnite->decrement('quantite', $validated['quantite']);

                $produitUnite->refresh();

                if ($produitUnite->quantite <= 0) {
                    $produitUnite->update([
                        'statut' => 'vendu'
                    ]);
                }
            });

            return redirect()
                ->route('liste-produits')
                ->with('success', 'Vente enregistrée avec succès');

        } catch (\Throwable $th) {

            \Log::error('Erreur vente', [
                'message' => $th->getMessage(),
                'line' => $th->getLine(),
                'file' => $th->getFile(),
            ]);

            return redirect()
                ->back()
                ->withInput()
                ->with('error', $th->getMessage());
        }
    }

    //// 1. Lecture des donnees de la liste des ventes
    public function ventes(Request $request)
    {
        $query = Ventes::with('client', 'user', 'ventedetails', 'paiements');

        // Filtrer par date de début et date de fin
        if ($request->filled('date_debut') && $request->filled('date_fin')) {
            $query->whereBetween('date_vente', [$request->date_debut, $request->date_fin]);
        } elseif ($request->filled('date_debut')) {
            $query->whereDate('date_vente', '>=', $request->date_debut);
        } elseif ($request->filled('date_fin')) {
            $query->whereDate('date_vente', '<=', $request->date_fin);
        }

        $liste_ventes = $query->paginate(10)->withQueryString();

        // Statistiques des ventes
        $ventes_aujourdhui = Ventes::whereDate('date_vente', today())->count();

        $ventes_aujourdhui_quantite = DB::table('ventes')
        ->join('vente_details', 'vente_details.vente_id', '=', 'ventes.id')
        ->whereDate('ventes.date_vente', today())
        ->where('vente_details.quantite', '>', 0)
        ->sum('vente_details.quantite');

        $total_ventes = Ventes::count();

         $ventes_total_quantite = DB::table('ventes')
        ->join('vente_details', 'vente_details.vente_id', '=', 'ventes.id')
        ->where('vente_details.quantite', '>', 0)
        ->sum('vente_details.quantite');

        $somme_ventes = Ventes::sum('total');

        return view('pages.liste-ventes', compact('liste_ventes', 'ventes_aujourdhui', 'total_ventes', 'somme_ventes','ventes_aujourdhui_quantite','ventes_total_quantite'));
    }

    public function clients(){
        $liste_clients = Clients::with('ventes', 'garanties')->paginate(10);
        return view('pages.liste-clients', compact('liste_clients'));
    }

    public function remises()
    {
        $liste_remises = Remises::with('users', 'produitRemise')->paginate(10);
        return view('pages.liste-remises', compact('liste_remises'));
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
