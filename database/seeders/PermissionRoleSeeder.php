<?php

namespace Database\Seeders;

use App\Models\User;
use Exception;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    private $permissions = [
        [
            'id' => 271,
            'name' => 'view-any Permission',
            'guard_name' => 'web',
        ],
        [
            'id' => 272,
            'name' => 'view-any Role',
            'guard_name' => 'web',
        ],
        [
            'id' => 273,
            'name' => 'view Permission',
            'guard_name' => 'web',
        ],
        [
            'id' => 274,
            'name' => 'view Role',
            'guard_name' => 'web',
        ],
        [
            'id' => 275,
            'name' => 'create Permission',
            'guard_name' => 'web',
        ],
        [
            'id' => 276,
            'name' => 'create Role',
            'guard_name' => 'web',
        ],
        [
            'id' => 277,
            'name' => 'update Permission',
            'guard_name' => 'web',
        ],
        [
            'id' => 278,
            'name' => 'update Role',
            'guard_name' => 'web',
        ],
        [
            'id' => 279,
            'name' => 'delete Permission',
            'guard_name' => 'web',
        ],
        [
            'id' => 280,
            'name' => 'delete Role',
            'guard_name' => 'web',
        ],
        [
            'id' => 281,
            'name' => 'restore Permission',
            'guard_name' => 'web',
        ],
        [
            'id' => 282,
            'name' => 'restore Role',
            'guard_name' => 'web',
        ],
        [
            'id' => 283,
            'name' => 'force-delete Permission',
            'guard_name' => 'web',
        ],
        [
            'id' => 284,
            'name' => 'force-delete Role',
            'guard_name' => 'web',
        ],
        [
            'id' => 285,
            'name' => 'replicate Permission',
            'guard_name' => 'web',
        ],
        [
            'id' => 286,
            'name' => 'replicate Role',
            'guard_name' => 'web',
        ],
        [
            'id' => 287,
            'name' => 'reorder Permission',
            'guard_name' => 'web',
        ],
        [
            'id' => 288,
            'name' => 'reorder Role',
            'guard_name' => 'web',
        ],
        [
            'id' => 289,
            'name' => 'view-any Activity',
            'guard_name' => 'web',
        ],
        [
            'id' => 290,
            'name' => 'view Activity',
            'guard_name' => 'web',
        ],
        [
            'id' => 291,
            'name' => 'view Permission',
            'guard_name' => 'api',
        ],
        [
            'id' => 292,
            'name' => 'view Role',
            'guard_name' => 'api',
        ],
        [
            'id' => 293,
            'name' => 'create Permission',
            'guard_name' => 'api',
        ],
        [
            'id' => 294,
            'name' => 'create Role',
            'guard_name' => 'api',
        ],
        [
            'id' => 295,
            'name' => 'update Permission',
            'guard_name' => 'api',
        ],
        [
            'id' => 296,
            'name' => 'update Role',
            'guard_name' => 'api',
        ],
        [
            'id' => 297,
            'name' => 'delete Permission',
            'guard_name' => 'api',
        ],
        [
            'id' => 298,
            'name' => 'delete Role',
            'guard_name' => 'api',
        ],
        [
            'id' => 299,
            'name' => 'restore Permission',
            'guard_name' => 'api',
        ],
        [
            'id' => 300,
            'name' => 'restore Role',
            'guard_name' => 'api',
        ],
        [
            'id' => 301,
            'name' => 'force-delete Permission',
            'guard_name' => 'api',
        ],
        [
            'id' => 302,
            'name' => 'force-delete Role',
            'guard_name' => 'api',
        ],
        [
            'id' => 303,
            'name' => 'replicate Permission',
            'guard_name' => 'api',
        ],
        [
            'id' => 304,
            'name' => 'replicate Role',
            'guard_name' => 'api',
        ],
        [
            'id' => 305,
            'name' => 'reorder Permission',
            'guard_name' => 'api',
        ],
        [
            'id' => 306,
            'name' => 'reorder Role',
            'guard_name' => 'api',
        ],
        [
            'id' => 307,
            'name' => 'view-any Permission',
            'guard_name' => 'api',
        ],
        [
            'id' => 308,
            'name' => 'view-any Role',
            'guard_name' => 'api',
        ],
        [
            'id' => 309,
            'name' => 'view-any Activity',
            'guard_name' => 'api',
        ],
        [
            'id' => 310,
            'name' => 'view Activity',
            'guard_name' => 'api',
        ],
    ];

    private $roles = [
        [
            'id' => 1,
            'name' => 'Super Admin',
            'guard_name' => 'web',
        ],
        [
            'id' => 2,
            'name' => 'User',
            'guard_name' => 'web'
        ],
        [
            'id' => 3,
            'name' => 'Super Admin API',
            'guard_name' => 'api'
        ],
        [
            'id' => 4,
            'name' => 'User API',
            'guard_name' => 'api'
        ],
    ];

    public function run(): void
    {
        $adminWebPermissions = range(253, 269, 2) + range(262, 290);
        $adminApiPermissions = range(254, 270, 2) + range(282, 310);
        $userWebPermissions = range(1, 251, 2);
        $userApiPermissions = range(2, 252, 2);

        foreach ($this->permissions as $permission) {
            Permission::query()->updateOrCreate([
                'id' => $permission['id'],
            ], $permission);
        }
        foreach ($this->roles as $role) {
            Role::query()->updateOrCreate([
                'id' => $role['id'],
            ], $role);
        }
        foreach ($adminWebPermissions as $adminWebPermission) {
            /** @var Role $role */
            Role::query()->where('id', 1)
                ->first()
                ->givePermissionTo($adminWebPermission);
        }
        foreach ($adminApiPermissions as $adminApiPermission) {
            /** @var Role $role */
            Role::query()->where('id', 3)
                ->first()
                ->givePermissionTo($adminApiPermission);

        }
        foreach ($userWebPermissions as $userWebPermission) {
            Role::query()->where('id', 2)
                ->first()
                ->givePermissionTo($userWebPermission);
        }
        foreach ($userApiPermissions as $userApiPermission) {
            Role::query()->where('id', 4)
                ->first()
                ->givePermissionTo($userApiPermission);
        }

Artisan::call('optimize:clear');
}
}
