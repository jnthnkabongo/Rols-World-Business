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
        // Statistiques pour les produits électroniques (catégorie_id = 1)
        $produits_electroniques = Produits::where('categorie_id', 1)->with('produitUnites')->get();
        
        $electroniques_stock_value = 0;
        $electroniques_stock_quantity = 0;
        foreach ($produits_electroniques as $produit) {
            foreach ($produit->produitUnites as $unite) {
                if ($unite->statut == 'en_stock') {
                    $electroniques_stock_value += $produit->prix_vente * $unite->quantite_produit;
                    $electroniques_stock_quantity += $unite->quantite_produit;
                }
            }
        }

        // Ventes électroniques
        $ventes_electroniques = Ventes::whereHas('ventedetails.produitUnite.produit', function($q) {
            $q->where('categorie_id', 1);
        })->get();
        
        $electroniques_sales_value = $ventes_electroniques->sum('total');
        $electroniques_sales_quantity = DB::table('vente_details')
            ->join('ventes', 'vente_details.vente_id', '=', 'ventes.id')
            ->join('produit_unites', 'vente_details.produit_unite_id', '=', 'produit_unites.id')
            ->join('produits', 'produit_unites.produit_id', '=', 'produits.id')
            ->where('produits.categorie_id', 1)
            ->sum('vente_details.quantite');

        // Ventes journalières électroniques
        $electroniques_daily_sales = Ventes::whereDate('date_vente', today())
            ->whereHas('ventedetails.produitUnite.produit', function($q) {
                $q->where('categorie_id', 1);
            })->sum('total');
        
        $electroniques_daily_quantity = DB::table('vente_details')
            ->join('ventes', 'vente_details.vente_id', '=', 'ventes.id')
            ->join('produit_unites', 'vente_details.produit_unite_id', '=', 'produit_unites.id')
            ->join('produits', 'produit_unites.produit_id', '=', 'produits.id')
            ->where('produits.categorie_id', 1)
            ->whereDate('ventes.date_vente', today())
            ->sum('vente_details.quantite');

        // Remises électroniques
        $electroniques_remises = Remises::whereHas('produitRemise', function($q) {
            $q->where('categorie_id', 1);
        })->count();
        
        $electroniques_remises_quantity = DB::table('remises')
            ->join('produits', 'remises.produit_id', '=', 'produits.id')
            ->where('produits.categorie_id', 1)
            ->sum('remises.quantite');

        // Statistiques pour les chaussures (catégorie_id = 2)
        $produits_chaussures = Produits::where('categorie_id', 2)->with('produitUnites')->get();
        
        $chaussures_stock_value = 0;
        $chaussures_stock_quantity = 0;
        foreach ($produits_chaussures as $produit) {
            foreach ($produit->produitUnites as $unite) {
                if ($unite->statut == 'en_stock') {
                    $chaussures_stock_value += $produit->prix_vente * $unite->quantite_produit;
                    $chaussures_stock_quantity += $unite->quantite_produit;
                }
            }
        }

        // Ventes chaussures
        $ventes_chaussures = Ventes::whereHas('ventedetails.produitUnite.produit', function($q) {
            $q->where('categorie_id', 2);
        })->get();
        
        $chaussures_sales_value = $ventes_chaussures->sum('total');
        $chaussures_sales_quantity = DB::table('vente_details')
            ->join('ventes', 'vente_details.vente_id', '=', 'ventes.id')
            ->join('produit_unites', 'vente_details.produit_unite_id', '=', 'produit_unites.id')
            ->join('produits', 'produit_unites.produit_id', '=', 'produits.id')
            ->where('produits.categorie_id', 2)
            ->sum('vente_details.quantite');

        // Ventes journalières chaussures
        $chaussures_daily_sales = Ventes::whereDate('date_vente', today())
            ->whereHas('ventedetails.produitUnite.produit', function($q) {
                $q->where('categorie_id', 2);
            })->sum('total');
        
        $chaussures_daily_quantity = DB::table('vente_details')
            ->join('ventes', 'vente_details.vente_id', '=', 'ventes.id')
            ->join('produit_unites', 'vente_details.produit_unite_id', '=', 'produit_unites.id')
            ->join('produits', 'produit_unites.produit_id', '=', 'produits.id')
            ->where('produits.categorie_id', 2)
            ->whereDate('ventes.date_vente', today())
            ->sum('vente_details.quantite');

        // Remises chaussures
        $chaussures_remises = Remises::whereHas('produitRemise', function($q) {
            $q->where('categorie_id', 2);
        })->count();
        
        $chaussures_remises_quantity = DB::table('remises')
            ->join('produits', 'remises.produit_id', '=', 'produits.id')
            ->where('produits.categorie_id', 2)
            ->sum('remises.quantite');

        // Statistiques pour les accessoires (catégorie_id = 3)
        $produits_accessoires = Produits::where('categorie_id', 3)->with('produitUnites')->get();
        
        $accessoires_stock_value = 0;
        $accessoires_stock_quantity = 0;
        foreach ($produits_accessoires as $produit) {
            foreach ($produit->produitUnites as $unite) {
                if ($unite->statut == 'en_stock') {
                    $accessoires_stock_value += $produit->prix_vente * $unite->quantite_produit;
                    $accessoires_stock_quantity += $unite->quantite_produit;
                }
            }
        }

        // Ventes accessoires
        $ventes_accessoires = Ventes::whereHas('ventedetails.produitUnite.produit', function($q) {
            $q->where('categorie_id', 3);
        })->get();
        
        $accessoires_sales_value = $ventes_accessoires->sum('total');
        $accessoires_sales_quantity = DB::table('vente_details')
            ->join('ventes', 'vente_details.vente_id', '=', 'ventes.id')
            ->join('produit_unites', 'vente_details.produit_unite_id', '=', 'produit_unites.id')
            ->join('produits', 'produit_unites.produit_id', '=', 'produits.id')
            ->where('produits.categorie_id', 3)
            ->sum('vente_details.quantite');

        // Ventes journalières accessoires
        $accessoires_daily_sales = Ventes::whereDate('date_vente', today())
            ->whereHas('ventedetails.produitUnite.produit', function($q) {
                $q->where('categorie_id', 3);
            })->sum('total');
        
        $accessoires_daily_quantity = DB::table('vente_details')
            ->join('ventes', 'vente_details.vente_id', '=', 'ventes.id')
            ->join('produit_unites', 'vente_details.produit_unite_id', '=', 'produit_unites.id')
            ->join('produits', 'produit_unites.produit_id', '=', 'produits.id')
            ->where('produits.categorie_id', 3)
            ->whereDate('ventes.date_vente', today())
            ->sum('vente_details.quantite');

        // Remises accessoires
        $accessoires_remises = Remises::whereHas('produitRemise', function($q) {
            $q->where('categorie_id', 3);
        })->count();
        
        $accessoires_remises_quantity = DB::table('remises')
            ->join('produits', 'remises.produit_id', '=', 'produits.id')
            ->where('produits.categorie_id', 3)
            ->sum('remises.quantite');

        // Dernières ventes pour le tableau
        $dernieres_ventes = Ventes::with('client')->latest()->take(15)->get();

        return view('pages.dashboard', compact(
            'electroniques_stock_value',
            'electroniques_stock_quantity',
            'electroniques_sales_value',
            'electroniques_sales_quantity',
            'electroniques_daily_sales',
            'electroniques_daily_quantity',
            'electroniques_remises',
            'electroniques_remises_quantity',
            'chaussures_stock_value',
            'chaussures_stock_quantity',
            'chaussures_sales_value',
            'chaussures_sales_quantity',
            'chaussures_daily_sales',
            'chaussures_daily_quantity',
            'chaussures_remises',
            'chaussures_remises_quantity',
            'accessoires_stock_value',
            'accessoires_stock_quantity',
            'accessoires_sales_value',
            'accessoires_sales_quantity',
            'accessoires_daily_sales',
            'accessoires_daily_quantity',
            'accessoires_remises',
            'accessoires_remises_quantity',
            'dernieres_ventes'
        ));
    }


    //*************** La mecanique concernant la gestion des roles CRUD */ 
    
    ///// 1. Lecture des donnees de la liste de roles
    public function roles()
    {
        $liste_roles = Roles::paginate(10);
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
        $liste_utilisateurs = User::with('role')->paginate(10);
        $liste_roles = Roles::orderBy('nom', 'asc')->get();
        return view('pages.liste-utilisateurs', compact('liste_utilisateurs', 'liste_roles'));
    }
    //// 2. Creation de l'utilisateur
    public function AjouterUtilisateur(Request $request)
    {
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
    public function ModifierUtilisateur(Request $request, $id)
    {
        
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
    public function SupprimerUtilisateur($id)
    {
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

        $numero_accesoire = ($dernierId ?? 0) + 1;
        $reference_accesoire = 'ACCESOIRE-' .str_pad($numero_accesoire, 3, '0', STR_PAD_LEFT);

        $produits_electroniques = Produits::with(['categorie', 'marque','produitUnites', 'produitDevise'])
            ->where('categorie_id', '=', 1)
            ->paginate(10);
        
        $chaussures = Produits::with(['categorie', 'marque', 'produitUnites', 'produitDevise'])
            ->where('categorie_id', '=', 2)
            ->paginate(10);

        $accessoires = Produits::with(['categorie', 'marque', 'produitUnites', 'produitDevise'])
            ->where('categorie_id', '=', 3)
            ->paginate(10);
        
        $categories = Categories::all();
        $marques_electroniques = Marques::where('categorie_id', '=', 1)->get();
        $marques_chaussures = Marques::where('categorie_id', '=', 2)->get();
        $marques_accessoires = Marques::where('categorie_id', '=', 3)->get();
        
        $liste_categories = Categories::orderBy('nom', 'asc')->get();

        return view('pages.liste-produits', compact('produits_electroniques', 'chaussures', 'accessoires', 'categories', 'marques_electroniques', 'marques_chaussures', 'marques_accessoires', 'reference', 'reference_accesoire', 'liste_categories'));
    }

    // Ajout d'un produit
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
            'devise_id'      => 'required|numeric|min:1',  
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
                    'devise_id'    => $validated['devise_id'] ?? null,
                ]);

                ProduitUnites::create([
                    'produit_id'   => $produit->id,
                    'numero_serie' => $validated['numero_serie'],
                    'statut'       => 'en_stock',
                    'quantite_produit'     => $validated['quantite'] ?? null,
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
            $currentQuantite = is_numeric($produitUnite->quantite_produit) ? $produitUnite->quantite_produit : 0;
            $produitUnite->quantite_produit = max(0, $currentQuantite - $validated['quantite']);
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
            $produitUnite->quantite_produit += $remise->quantite;
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

                if ($produitUnite->quantite_produit < $validated['quantite']) {
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
                    'devise_id' => $produit->devise_id,
                ]);

                VenteDetails::create([
                    'vente_id' => $vente->id,
                    'produit_unite_id' => $produitUnite->id,
                    'quantite' => $validated['quantite'],
                    'prix_unitaire' => $produit->prix_vente,
                    'total' => $produit->prix_vente * $validated['quantite'],
                ]);

                $produitUnite->decrement('quantite_produit', $validated['quantite']);

                $produitUnite->refresh();

                if ($produitUnite->quantite_produit <= 0) {
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
        $query = Ventes::with('client', 'user', 'ventedetails.produitUnite.produit', 'paiements');

        // Filtrer par date de début et date de fin
        if ($request->filled('date_debut') && $request->filled('date_fin')) {
            $query->whereBetween('date_vente', [$request->date_debut, $request->date_fin]);
        } elseif ($request->filled('date_debut')) {
            $query->whereDate('date_vente', '>=', $request->date_debut);
        } elseif ($request->filled('date_fin')) {
            $query->whereDate('date_vente', '<=', $request->date_fin);
        }

        // Filtrer par catégorie (accessoires, électroniques, chaussures)
        if ($request->filled('categorie_id')) {
            $query->whereHas('ventedetails.produitUnite.produit', function($q) use ($request) {
                $q->where('categorie_id', $request->categorie_id);
            });
        }

        $liste_ventes = $query->orderBy('id', 'desc')->paginate(10)->withQueryString();

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

        $somme_ventes = Ventes::where('devise_id', '1')->sum('total');

        $somme_ventes_fc = Ventes::where('devise_id', '2')->sum('total');

        return view('pages.liste-ventes', compact('liste_ventes', 'ventes_aujourdhui', 'total_ventes', 'somme_ventes','ventes_aujourdhui_quantite','ventes_total_quantite', 'somme_ventes_fc'));
    }

    public function clients(){
        $liste_clients = Clients::orderBy('id', 'desc')->with('ventes', 'garanties')->paginate(10);
        return view('pages.liste-clients', compact('liste_clients'));
    }

    public function remises()
    {
        $liste_remises = Remises::orderBy('id', 'desc')->with('users', 'produitRemise')->paginate(10);
        return view('pages.liste-remises', compact('liste_remises'));
    }

    public function rapports(Request $request)
    {
        // Statistiques générales
        $total_ventes = Ventes::count();
        $total_remises = Remises::count();
        $total_produits_count = Produits::count();
        $total_clients = Clients::count();
        $liste_produits = Produits::all();

        // Filtre par devise
        $devise_id = $request->devise_id;

        // Base query pour les statistiques avec filtre de devise
        $ventesQuery = Ventes::query();
        if ($devise_id) {
            $ventesQuery->where('devise_id', $devise_id);
        }

        // Base query pour les détails de ventes avec filtres
        $detailsQuery = VenteDetails::with('produitUnite.produit', 'vente.venteDevise')
            ->join('ventes', 'vente_details.vente_id', '=', 'ventes.id')
            ->select('vente_details.*', 'ventes.created_at as date_vente');

        // Appliquer le filtre de devise
        if ($devise_id) {
            $detailsQuery->where('ventes.devise_id', $devise_id);
        }

        // Appliquer le filtre de produit
        if ($request->produit_id) {
            $detailsQuery->whereHas('produitUnite.produit', function($q) use ($request) {
                $q->where('id', $request->produit_id);
            });
        }

        // Appliquer les filtres de date
        if ($request->date_debut && $request->date_fin) {
            $detailsQuery->whereBetween('ventes.created_at', [$request->date_debut, $request->date_fin]);
        } elseif ($request->date_debut) {
            $detailsQuery->whereDate('ventes.created_at', '>=', $request->date_debut);
        } elseif ($request->date_fin) {
            $detailsQuery->whereDate('ventes.created_at', '<=', $request->date_fin);
        }

        $details_ventes = $detailsQuery->orderByDesc('ventes.created_at')->paginate(10);

        // Statistiques financières - devise_id 1 ($)
        $somme_ventes_dollar = Ventes::where('devise_id', 1)->sum('total');
        $ventes_aujourdhui = Ventes::whereDate('created_at', today())->count();
        $remises_aujourdhui = Remises::whereDate('created_at', today())->count();

        // Bénéfice total pour devise_id 1 ($)
        $benefice_total_dollar = VenteDetails::selectRaw('SUM(vente_details.total - (produits.prix_achat * vente_details.quantite)) as benefice')
            ->join('produit_unites', 'vente_details.produit_unite_id', '=', 'produit_unites.id')
            ->join('produits', 'produit_unites.produit_id', '=', 'produits.id')
            ->join('ventes', 'vente_details.vente_id', '=', 'ventes.id')
            ->where('ventes.devise_id', 1)
            ->value('benefice') ?? 0;
        
        $ventes_dollar_count = Ventes::where('devise_id', 1)->count();
        $benefice_moyen_dollar = $ventes_dollar_count > 0 ? $benefice_total_dollar / $ventes_dollar_count : 0;

        // Meilleur produit pour devise_id 1 ($)
        $meilleur_produit_dollar = VenteDetails::select('produits.nom', DB::raw('SUM((vente_details.total - (produits.prix_achat * vente_details.quantite))) as benefice_total'))
            ->join('produit_unites', 'vente_details.produit_unite_id', '=', 'produit_unites.id')
            ->join('produits', 'produit_unites.produit_id', '=', 'produits.id')
            ->join('ventes', 'vente_details.vente_id', '=', 'ventes.id')
            ->where('ventes.devise_id', 1)
            ->groupBy('produits.id', 'produits.nom')
            ->orderByDesc('benefice_total')
            ->first();

        // Statistiques financières - devise_id 2 (FC)
        $somme_ventes_fc = Ventes::where('devise_id', 2)->sum('total');

        // Bénéfice total pour devise_id 2 (FC)
        $benefice_total_fc = VenteDetails::selectRaw('SUM(vente_details.total - (produits.prix_achat * vente_details.quantite)) as benefice')
            ->join('produit_unites', 'vente_details.produit_unite_id', '=', 'produit_unites.id')
            ->join('produits', 'produit_unites.produit_id', '=', 'produits.id')
            ->join('ventes', 'vente_details.vente_id', '=', 'ventes.id')
            ->where('ventes.devise_id', 2)
            ->value('benefice') ?? 0;
        
        $ventes_fc_count = Ventes::where('devise_id', 2)->count();
        $benefice_moyen_fc = $ventes_fc_count > 0 ? $benefice_total_fc / $ventes_fc_count : 0;

        // Meilleur produit pour devise_id 2 (FC)
        $meilleur_produit_fc = VenteDetails::select('produits.nom', DB::raw('SUM((vente_details.total - (produits.prix_achat * vente_details.quantite))) as benefice_total'))
            ->join('produit_unites', 'vente_details.produit_unite_id', '=', 'produit_unites.id')
            ->join('produits', 'produit_unites.produit_id', '=', 'produits.id')
            ->join('ventes', 'vente_details.vente_id', '=', 'ventes.id')
            ->where('ventes.devise_id', 2)
            ->groupBy('produits.id', 'produits.nom')
            ->orderByDesc('benefice_total')
            ->first();

        // Produits par statut
        $produits_en_stock = ProduitUnites::where('statut', 'en_stock')->count();
        $produits_en_remise = ProduitUnites::where('statut', 'remise')->count();
        $produits_vendus = ProduitUnites::where('statut', 'vendu')->count();

        // Dernières ventes
        $dernieres_ventes = Ventes::with('client')->latest()->take(5)->get();

        // Dernières remises
        $dernieres_remises = Remises::with('produitRemise', 'users')->latest()->take(5)->get();

        return view('pages.rapport-page', compact(
            'total_ventes',
            'total_remises',
            'total_produits_count',
            'total_clients',
            'somme_ventes_dollar',
            'somme_ventes_fc',
            'ventes_aujourdhui',
            'remises_aujourdhui',
            'produits_en_stock',
            'produits_en_remise',
            'produits_vendus',
            'benefice_total_dollar',
            'benefice_moyen_dollar',
            'meilleur_produit_dollar',
            'benefice_total_fc',
            'benefice_moyen_fc',
            'meilleur_produit_fc',
            'details_ventes',
            'liste_produits',
            'dernieres_ventes',
            'dernieres_remises'
        ));
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
