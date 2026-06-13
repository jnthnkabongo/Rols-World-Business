<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('page-auth');
Route::post('/', [AuthController::class, 'create'])->name('connexion');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
//mecanique roles CRUD
Route::get('liste-role', [DashboardController::class, 'roles'])->name('liste-roles');
Route::post('ajout-role', [DashboardController::class, 'AjouterRole'])->name('ajout-role');
Route::post('modifier-role/{id}', [DashboardController::class, 'ModifierRole'])->name('modifier-role');
Route::post('supprimer-role/{id}', [DashboardController::class, 'SupprimerRole'])->name('delete-role');

//mecanique utilisateurs CRUD
Route::get('liste-utilisateur', [DashboardController::class, 'utilisateurs'])->name('liste-utilisateurs');
Route::post('ajout-utilisateur', [DashboardController::class, 'AjouterUtilisateur'])->name('ajout-utilisateur');
Route::post('modifier-utilisateur/{id}', [DashboardController::class, 'ModifierUtilisateur'])->name('modifier-utilisateur');
Route::post('supprimer-utilisateur/{id}', [DashboardController::class, 'SupprimerUtilisateur'])->name('supprimer-utilisateur');

//mecanique fournisseurs CRUD
Route::get('liste-fournisseur', [DashboardController::class, 'fournisseurs'])->name('liste-fournisseurs');

//mecanique marques CRUD
Route::post('ajout-marque', [DashboardController::class, 'AjouterMarque'])->name('ajout-marque');

//mecanique categories CRUD
Route::post('ajout-categorie', [DashboardController::class, 'AjouterCategorie'])->name('ajout-categorie');


//mecanique produits CRUD
Route::get('liste-produit', [DashboardController::class, 'produits'])->name('liste-produits');
Route::post('ajout-produit', [DashboardController::class, 'AjouterProduit'])->name('ajout-produit');
Route::post('modifier-produit/{id}', [DashboardController::class, 'ModifierProduit'])->name('modifier-produit');
Route::post('supprimer-produit/{id}', [DashboardController::class, 'SupprimerProduit'])->name('supprimer-produit');
Route::get('api/products/{id}', [DashboardController::class, 'getProductData'])->name('get-product-data');
Route::post('changer-statut-remise/{id}', [DashboardController::class, 'changerStatutRemise'])->name('changer-statut-remise');
Route::post('changer-statut-vendu/{id}', [DashboardController::class, 'changerStatutVendu'])->name('changer-statut-vendu');

//mecanique ventes CRUD
Route::get('liste-vente', [DashboardController::class, 'ventes'])->name('liste-ventes');

//mecanique remises CRUD
Route::get('liste-remise', [DashboardController::class, 'remises'])->name('liste-remises');

//mecanique rapports CRUD
Route::get('liste-rapport', [DashboardController::class, 'rapports'])->name('liste-rapports');

//mecanique historiques CRUD
Route::get('liste-historique', [DashboardController::class, 'historiques'])->name('liste-historiques');