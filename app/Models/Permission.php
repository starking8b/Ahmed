<?php

namespace App\Models;

class Permission extends \Spatie\Permission\Models\Permission
{
   
    /**
     * Default Permissions of the Application.
     */
    public static function defaultPermissions()
    {
        return [
            'view_backend',
            'edit_settings',
            'view_logs'
        ];
    }
}
