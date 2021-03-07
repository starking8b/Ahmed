<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //protected $table = 'countries';

    public $timestamps = false;

    public function states()
    {
        return $this->hasOne('App\Model\State', 'id', 'state_id');
    }
}
