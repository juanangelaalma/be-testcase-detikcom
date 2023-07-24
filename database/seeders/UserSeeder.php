<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name'  => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $admin->assignRole(Role::findByName('admin'));

        $firstUser = User::create([
            'name'  => 'First user',
            'email' => 'first.user@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $firstUser->assignRole(Role::findByName('user'));

        $secondUser = User::create([
            'name'  => 'Second user',
            'email' => 'second.user@gmail.com',
            'password' => bcrypt('12345678'),
        ]);

        $secondUser->assignRole(Role::findByName('user'));
    }
}
