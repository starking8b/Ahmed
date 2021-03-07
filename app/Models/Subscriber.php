<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $table = 'isp_users';

    public $timestamps = false;

    /*public function profile()
    {
        return $this->belongsTo('App\Models\Profile', 'owner');
    }*/


    public function owners()
    {
        return $this->hasOne('App\Models\User', 'id', 'owner');
    }
    
    public function radAcctData() {
        return $this->hasOne('App\Models\RadAcct', 'username', 'username');
    }
    
    public function usermac() {
        return $this->hasOne('App\Models\UserMAC', 'username', 'username');
    }

    public function onlineuser() {
        return $this->belongsTo('App\Models\RadAcct', 'username', 'username')->whereNull('acctstoptime');
    }


}
