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
        Role::create(['name' => 'user']);
        Role::create(['name' => 'admin']);

        Permission::create(['name' => 'create book']);
        Permission::create(['name' => 'read book']);
        Permission::create(['name' => 'update book']);
        Permission::create(['name' => 'delete book']);

        $userRole = Role::findByName('user');
        $userRole->syncPermissions(['create book', 'read book', 'update book', 'delete book']);

        $adminRole = Role::findByName('admin');
        $adminRole->syncPermissions(['create book', 'read book', 'update book', 'delete book']);
    }
}
