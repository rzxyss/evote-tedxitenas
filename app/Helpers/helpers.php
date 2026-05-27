<?php

use App\CheckingPermission;

if (!function_exists('checkingPermission')) {
    function checkingPermission($permissions = [], $message = 'Unauthorized access')
    {
        new CheckingPermission($permissions, $message);
    }
}
