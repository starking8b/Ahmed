<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $table = 'isp_users';

    public $timestamps = false;

    /*public function profile()
    {
        return $this->belongsTo('App\Model\Profile', 'owner');
    }*/



    
    public function radAcctData() {
        return $this->hasOne('App\Model\RadAcct', 'username', 'username');
    }
    
    public function usermac() {
        return $this->hasOne('App\Model\UserMAC', 'username', 'username');
    }

    public function onlineuser() {
        return $this->belongsTo('App\Model\RadAcct', 'username', 'username')->whereNull('acctstoptime');
    }


}
