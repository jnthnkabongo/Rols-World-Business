<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiements extends Model
{
    protected $fillable = [
        'vente_id', 
        'montant', 
        'methode', 
        'date'
    ];

    public function vente()
    {
        return $this->belongsTo(Ventes::class);
    }
}
