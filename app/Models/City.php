<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\City
 *
 * @property-read \App\Models\State|null $states
 * @method static \Illuminate\Database\Eloquent\Builder|City newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|City query()
 * @mixin \Eloquent
 */
class City extends Model
{
    //protected $table = 'countries';

    public $timestamps = false;

    public function states()
    {
        return $this->hasOne('App\Models\State', 'id', 'state_id');
    }
}
