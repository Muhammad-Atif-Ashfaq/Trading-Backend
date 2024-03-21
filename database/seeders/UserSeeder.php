<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        // create permissions
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'publish']);
        Permission::create(['name' => 'unpublish']);

        // create roles and assign created permissions
        $role = Role::create(['name' => Role::ADMIN]);
        $role->givePermissionTo([Permission::all()]);


        $role = Role::create(['name' => Role::BRAND]);
        $role->givePermissionTo(Permission::all());


        $user1 = new User;
        $user1->name = 'Admin';
        $user1->email = 'admin@gmail.com';
        $user1->password = Hash::make('password');
        $user1->original_password = 'password';
        $user1->email_verified_at = now();
        $user1->save();
        $user1->assignRole(Role::ADMIN);

        $user2 = new User;
        $user2->name = 'brand';
        $user2->email = 'brand@gmail.com';
        $user2->password = Hash::make('password');
        $user2->original_password = 'password';
        $user2->email_verified_at = now();
        $user2->save();
        $user2->assignRole(Role::BRAND);


    }
}
