<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('page-auth');
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('liste-role', [DashboardController::class, 'roles'])->name('liste-roles');
Route::post('ajout-role', [DashboardController::class, 'AjouterRole'])->name('ajout-role');
Route::get('liste-utilisateur', [DashboardController::class, 'utilisateurs'])->name('liste-utilisateurs');
Route::get('liste-fournisseur', [DashboardController::class, 'fournisseurs'])->name('liste-fournisseurs');
Route::get('liste-produit', [DashboardController::class, 'produits'])->name('liste-produits');
Route::get('liste-vente', [DashboardController::class, 'ventes'])->name('liste-ventes');
Route::get('liste-remise', [DashboardController::class, 'remises'])->name('liste-remises');
Route::get('liste-rapport', [DashboardController::class, 'rapports'])->name('liste-rapports');
Route::get('liste-historique', [DashboardController::class, 'historiques'])->name('liste-historiques');