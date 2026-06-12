<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marques extends Model
{
    protected $fillable = [
        'nom', 
        'description',
        'categorie_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function produits()
    {
        return $this->hasMany(Produits::class);
    }
}
