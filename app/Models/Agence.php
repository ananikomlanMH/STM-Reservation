<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Agence extends Eloquent
{
    use HasFactory;

    protected $collection = 'agences';

    protected $fillable = [
        'id',
        'agence',
        'localite',
        'region',
    ];
}
