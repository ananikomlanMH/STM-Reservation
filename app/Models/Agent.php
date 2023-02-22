<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Agent extends Eloquent
{
    use HasFactory;

    protected $collection = 'agents';

    protected $fillable = [
        'id',
        'matricule',
        'nom',
        'prenom',
        'tel',
        'image',
        'agence',
    ];
}
