<?php

namespace Modules\ISP\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;

class ISP extends Model
{
    protected $table = "isps";
    protected $fillable = [ 'name',
                            'about',
                            'logo',
                            'address',
                            'phone',
                            'mobile',
                            'email',
                            'map_location',
                            'fax',
                            'facebook_url',
                            'linkedin_url',
                            'instagram_url',
                            ];

}
