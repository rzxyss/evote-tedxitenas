<?php

namespace App;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class CheckingPermission
{
    /**
     * Check if user has specified permissions
     * 
     * @param array|string $permissions
     * @param string $message
     * @throws AuthorizationException
     */
    public function __construct($permissions = [], $message = 'Unauthorized access')
    {
        // Jika parameter pertama adalah string, ubah ke array
        if (is_string($permissions)) {
            $permissions = [$permissions];
        }

        // Jika tidak ada permission yang diberikan, langsung allowed
        if (empty($permissions)) {
            return;
        }

        // Check if user authenticated
        if (!Auth::check()) {
            throw new AuthorizationException($message);
        }

        $user = Auth::user();
        $hasPermission = false;

        // Check jika user memiliki salah satu permission
        foreach ($permissions as $permission) {
            if ($user->hasPermissionTo($permission)) {
                $hasPermission = true;
                break;
            }
        }

        if (!$hasPermission) {
            throw new AuthorizationException($message);
        }
    }
}
