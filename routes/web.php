<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('page-auth');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
//mecanique roles CRUD
Route::get('liste-role', [DashboardController::class, 'roles'])->name('liste-roles');
Route::post('ajout-role', [DashboardController::class, 'AjouterRole'])->name('ajout-role');
Route::post('modifier-role/{id}', [DashboardController::class, 'ModifierRole'])->name('modifier-role');
Route::post('supprimer-role/{id}', [DashboardController::class, 'SupprimerRole'])->name('supprimer-role');

//mecanique utilisateurs CRUD
Route::get('liste-utilisateur', [DashboardController::class, 'utilisateurs'])->name('liste-utilisateurs');

//mecanique fournisseurs CRUD
Route::get('liste-fournisseur', [DashboardController::class, 'fournisseurs'])->name('liste-fournisseurs');

//mecanique produits CRUD
Route::get('liste-produit', [DashboardController::class, 'produits'])->name('liste-produits');

//mecanique ventes CRUD
Route::get('liste-vente', [DashboardController::class, 'ventes'])->name('liste-ventes');

//mecanique remises CRUD
Route::get('liste-remise', [DashboardController::class, 'remises'])->name('liste-remises');

//mecanique rapports CRUD
Route::get('liste-rapport', [DashboardController::class, 'rapports'])->name('liste-rapports');

//mecanique historiques CRUD
Route::get('liste-historique', [DashboardController::class, 'historiques'])->name('liste-historiques');