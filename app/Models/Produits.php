<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produits extends Model
{
    protected $fillable = [
        'nom', 
        'categorie_id', 
        'marque_id', 
        'modele', 
        'description', 
        'prix_achat', 
        'prix_vente',
        'devise_id', 
        'status',
        'taille'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categories::class);
    }

    public function marque()
    {
        return $this->belongsTo(Marques::class);
    }

    public function produitUnites()
    {
        return $this->hasMany(ProduitUnites::class, 'produit_id');
    }

    public function approvisionnementDetails()
    {
        return $this->hasMany(ApprovisionnementDetail::class);
    }

    public function produitDevise()
    {
        return $this->belongsTo(Devise::class, 'devise_id');
    }
}
