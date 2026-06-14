<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remises extends Model
{
    protected $fillable = [
        'user_id',
        'produit_id',
        'nom_remise',
        'telephone_remise',
        'quantite'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function produitRemise()
    {
        return $this->belongsTo(Produits::class, 'produit_id');
    }
}
