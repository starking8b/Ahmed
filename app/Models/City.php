<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    //protected $table = 'countries';

    public $timestamps = false;

    public function states()
    {
        return $this->hasOne('App\Models\State', 'id', 'state_id');
    }
}
