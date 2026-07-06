<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login_api']);
Route::post('/logout', [AuthController::class, 'logout_api']);

Route::middleware('auth:sanctum')->group(function (){
    
    Route::get('dashboard', [DashboardController::class, 'dashboard_api']);
    Route::get('liste-produits', [DashboardController::class, 'liste_produits_api']);
    Route::get('liste-ventes', [DashboardController::class, 'liste_ventes_api']);
    Route::post('ajout-vente/{id}', [DashboardController::class, 'changerStatutVendu_api']);
    Route::get('liste-remises', [DashboardController::class, 'liste_remises_api']);
    Route::post('ajout-remise/{id}', [DashboardController::class, 'ajouter_remise_api']);
    Route::post('retourner-remise/{id}', [DashboardController::class, 'retourner_remise_produit']);
});