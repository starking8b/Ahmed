<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\UserMAC
 *
 * @method static \Illuminate\Database\Eloquent\Builder|UserMAC newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMAC newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserMAC query()
 * @mixin \Eloquent
 */
class UserMAC extends Model
{
    protected $table = 'isp_user_macs';

    public $timestamps = false;
}
