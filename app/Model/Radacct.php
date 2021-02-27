<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radacct extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function radauth()
    {
        return $this->belongsTo('App\Model\RadPostAuth', 'username', 'username');
    }

    public function user()
    {
        return $this->belongsTo('App\Model\Subscriber', 'username', 'username')->where('status', '!=', 3);
    }
}
