<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'view companies',
            'create companies',
            'edit companies',
            'delete companies',

            'view chats',
            'join chats',
            'reply chats',
            'close chats',

            'manage agents',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'super_admin']);
        $companyAdmin = Role::firstOrCreate(['name' => 'company_admin']);
        $agent = Role::firstOrCreate(['name' => 'agent']);

        $superAdmin->givePermissionTo(Permission::all());

        $companyAdmin->givePermissionTo([
            'view chats',
            'join chats',
            'reply chats',
            'close chats',
            'manage agents',
        ]);

        $agent->givePermissionTo([
            'view chats',
            'join chats',
            'reply chats',
        ]);
    }
}