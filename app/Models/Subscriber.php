<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Subscriber
 *
 * @property-read \App\Models\Radacct $onlineuser
 * @property-read \App\Models\User|null $owners
 * @property-read \App\Models\Radacct|null $radAcctData
 * @property-read \App\Models\UserMAC|null $usermac
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscriber query()
 * @mixin \Eloquent
 */
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
