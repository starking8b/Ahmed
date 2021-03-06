<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{


    public function thanas()
    {
        return $this->hasOne('App\Model\Thana', 'id', 'thana_id');
    }

    public $timestamps = false;
}
