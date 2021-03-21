<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Thana
 *
 * @property-read \App\Models\City|null $cities
 * @method static \Illuminate\Database\Eloquent\Builder|Thana newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Thana newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Thana query()
 * @mixin \Eloquent
 */
class Thana extends Model
{
    //protected $table = 'countries';

    public $timestamps = false;

    public function cities()
    {
        return $this->hasOne('App\Models\City', 'id', 'city_id');
    }
}
