<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Reservation extends Eloquent
{
    use HasFactory;

    protected $collection = 'reservations';

    protected $fillable = [
        "datedepart",
        "heureDepart",
        "numBillet",
        "valise",
        "sac",
        "colis",
        "gyz",
        "siege",
        "etatVoyage",
        "typeVoyage",
        "alleRetour",
        "bus",
        "agent",
        "voyageur",
        "trajet",
        "montant",
    ];

}
