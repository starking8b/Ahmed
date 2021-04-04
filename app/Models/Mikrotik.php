<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NAS extends Model
{
    protected $table = 'nas';

    public function users()
    {
        return $this->morphedByMany('App\Models\User', 'user_nasable');
    }

    public function customers() {
        return $this->hasMany('App\Models\Radacct', 'shortname','shortname');
    }

    public $timestamps = false;
}
