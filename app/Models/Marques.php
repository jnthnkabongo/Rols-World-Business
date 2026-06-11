<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marques extends Model
{
    protected $fillable = [
        'nom', 
        'description',
        'logo'
    ];

    protected $casts = [
        'logo' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function produits()
    {
        return $this->hasMany(Produits::class);
    }
}
