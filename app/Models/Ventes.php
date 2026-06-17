<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventes extends Model
{
    protected $fillable = [
        'client_id',
        'user_id', 
        'nom_client',
        'date_vente', 
        'devise_id',
        'total', 
        'statut'
    ];

    public function client()
    {
        return $this->belongsTo(Clients::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ventedetails()
    {
        return $this->hasMany(VenteDetails::class, 'vente_id');
    }

    public function paiements()
    {
        return $this->hasMany(Paiements::class, 'vente_id');
    }

    public function venteDevise()
    {
        return $this->belongsTo(Devise::class, 'devise_id'); // <-- note: fk
    }
}
