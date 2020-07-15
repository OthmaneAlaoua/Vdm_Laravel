<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Acheteurs extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'acheteurs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'Civilite', 'Nom','Prenom','Age','Email',
    ];

    public function game()
    {
        return $this->hasOne(Game::class,'User_Id','_id');
    }

}
