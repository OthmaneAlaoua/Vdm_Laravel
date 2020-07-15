<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Statistique extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'statistiques';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


}
