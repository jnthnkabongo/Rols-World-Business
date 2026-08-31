<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dettes extends Model
{
    protected $fillable = [
        'creancier',
        'montant',
        'montant_payer',
        'reste_a_payer',
        'statut',
        'motif',
        'date_echeance'
    ];
}
