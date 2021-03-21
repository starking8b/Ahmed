<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\State
 *
 * @method static \Illuminate\Database\Eloquent\Builder|State newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|State query()
 * @mixin \Eloquent
 */
class State extends Model
{
    //protected $table = 'countries';

    public $timestamps = false;

    public function countries()
    {
        return $this->hasOne('App\Models\Country', 'id', 'country_id');
    }
}
