<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Voyageur extends Eloquent
{
    use HasFactory;

    protected $collection = 'voyageurs';

    protected $fillable = [
        'id',
        'nom',
        'prenom',
        'tel',
        'adresse',
    ];
}
