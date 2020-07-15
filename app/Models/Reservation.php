<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Reservation extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'reservation';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'Spectateur', 'Tarif','Game_Id'
    ];

}
