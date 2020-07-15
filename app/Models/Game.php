<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Game extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'game';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'Nom', 'Jour','Horaire','VR','User_Id'
    ];

}
