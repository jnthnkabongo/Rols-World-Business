<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProduitUnites extends Model
{
    protected $table = 'produit_unites';

    protected $fillable = [
        'produit_id',
        'numero_serie', 
        'quantite_produit',
        'statut',
    ];

    public function produit()
    {
        return $this->belongsTo(Produits::class);
    }

    public function venteDetails()
    {
        return $this->hasMany(VenteDetails::class);
    }

    public function garanties()
    {
        return $this->hasMany(Garanties::class);
    }
}
