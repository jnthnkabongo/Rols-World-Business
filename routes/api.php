<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login_api']);
Route::post('/logout', [AuthController::class, 'logout_api']);

Route::middleware('auth')->group(function (){
    
    Route::get('dashboard', [DashboardController::class, 'dashboard_api']);
    Route::get('liste-produits', [DashboardController::class, 'liste_produits_api']);
    Route::get('liste-vente', [DashboardController::class, 'liste_vente']);
    Route::post('ajout-vente', [DashboardController::class, 'ajouter_vente']);
    Route::get('liste-remises', [DashboardController::class, 'liste_remises']);
    Route::post('ajout-remise', [DashboardController::class, 'ajouter-remise']);
    Route::post('retourner-remise', [DashboardController::class, 'retour_remise']);
});