<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{


    public function thanas()
    {
        return $this->hasOne('App\Models\Thana', 'id', 'thana_id');
    }

    public $timestamps = false;
}
