<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create books',
            'edit books',
            'delete books',
            'view books',
            'edit roles',
            'create roles',
            'delete roles',
            'delete users',
            'edit users',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
        // Создание ролей
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo('view books');

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());
    }
}
