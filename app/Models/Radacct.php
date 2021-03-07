<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radacct extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function radauth()
    {
        return $this->belongsTo('App\Models\RadPostAuth', 'username', 'username');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\Subscriber', 'username', 'username')->where('status', '!=', 3);
    }
}
