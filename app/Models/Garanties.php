<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Garanties extends Model
{
    protected $fillable = [
        'produit_unite_id', 
        'client_id', 
        'date_debut', 
        'date_fin'
    ];

    public function produitUnite()
    {
        return $this->belongsTo(ProduitUnites::class);
    }

    public function client()
    {
        return $this->belongsTo(Clients::class);
    }
}
