<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable = [
        'nom',
        'description'
    ];

    public function produits()
    {
        return $this->hasMany(Produits::class);
    }

    public function marques()
    {
        return $this->belongsTo(Marques::class);
    }
}
