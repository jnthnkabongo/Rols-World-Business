<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $fillable = [
        'nom_client', 
        'telephone', 
        'email', 
        'adresse'];

    public function ventes()
    {
        return $this->hasMany(Ventes::class, 'client_id');
    }

    public function garanties()
    {
        return $this->hasMany(Garanties::class, 'client_id');
    }
}
