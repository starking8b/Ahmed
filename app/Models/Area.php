<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Area
 *
 * @property-read \App\Models\Thana|null $thanas
 * @method static \Illuminate\Database\Eloquent\Builder|Area newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Area newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Area query()
 * @mixin \Eloquent
 */
class Area extends Model
{


    public function thanas()
    {
        return $this->hasOne('App\Models\Thana', 'id', 'thana_id');
    }

    public $timestamps = false;
}
