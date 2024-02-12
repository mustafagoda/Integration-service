<?php

namespace Database\Seeders\tenant;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $role = Role::factory()->create([
            'slug' => 'supper-admin',
            'name' => 'Supper admin'
        ]);

       $role->permissions()->sync(Permission::all(['id']));
    }
}
