<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    //protected $table = 'countries';

    public $timestamps = false;

    public function cities()
    {
        return $this->hasOne('App\Model\City', 'id', 'city_id');
    }
}
