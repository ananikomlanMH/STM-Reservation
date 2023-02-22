<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Forfait extends Eloquent
{
    use HasFactory;

    protected $collection = 'forfaits';

    protected $fillable = [
        'id',
        'villeDepart',
        'villeDestination',
        'montant',
        'typeVoyage',
    ];
}
