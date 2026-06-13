<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VenteDetails extends Model
{
    protected $fillable = [
        'vente_id', 
        'produit_unite_id', 
        'prix_unitaire', 
        'total',
        'quantite'
    ];

    public function vente()
    {
        return $this->belongsTo(Ventes::class);
    }

    public function produitUnite()
    {
        return $this->belongsTo(ProduitUnites::class);
    }
}
