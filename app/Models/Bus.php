<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Bus extends Eloquent
{
    use HasFactory;

    protected $collection = 'bus';

    protected $fillable = [
        'id',
        'numero',
        'nbreSiege',
    ];

    public function setNbreSiegeAttribute($value){
        $this->attributes['nbreSiege'] = intval($value);
    }
}
