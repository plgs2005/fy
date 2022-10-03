<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $role = Role::create(['name' => 'Admin']);

        $role = Role::create(['name' => 'Brand']);

        $role = Role::create(['name' => 'Influencer']);
        //$role->givePermissionTo(Permission::all());
    }
}
