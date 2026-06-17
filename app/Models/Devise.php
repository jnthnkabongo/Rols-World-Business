<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devise extends Model
{
    protected $fillable = [
        'nom_devise',
        'description',
        'logo'
    ];

}
