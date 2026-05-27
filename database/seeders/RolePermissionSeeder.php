<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolePermissionSeeder extends Seeder
{
    /**
     * Seed roles and permissions.
     */
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $guard = config('auth.defaults.guard', 'web');

        $permissions = [
            'permission_view',
            'permission_create',
            'permission_update',
            'permission_delete',
            'role_view',
            'role_create',
            'role_update',
            'role_delete',
            'account_view',
            'account_create',
            'account_update',
            'account_delete',
            'candidate_view',
            'candidate_create',
            'candidate_update',
            'candidate_delete',
            'vote_view',
            'vote_create',
            'vote_update',
            'vote_delete',
            'user_view',
            'user_create',
            'user_update',
            'user_delete',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, $guard);
        }

        $roles = [
            'superadmin' => $permissions,
            'committee' => [
                'candidate_view',
                'candidate_create',
                'candidate_update',
                'vote_view',
                'vote_create',
                'user_view',
                'user_create',
                'user_update',
                'user_delete',
            ],
            'voter' => [
                'vote_view',
                'vote_create',
            ],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::findOrCreate($roleName, $guard);
            $role->syncPermissions($rolePermissions);
        }
    }
}
