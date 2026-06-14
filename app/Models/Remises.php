<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Remises extends Model
{
    protected $fillable = [
        'user_id',
        'produit_id',
        'nom_remise',
        'telephone_remise'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function produitRemise()
    {
        return $this->belongsTo(Produits::class);
    }
}
