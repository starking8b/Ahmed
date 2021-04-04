<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Thana extends Model
{
    //protected $table = 'countries';

    public $timestamps = false;

    public function cities()
    {
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }
}
