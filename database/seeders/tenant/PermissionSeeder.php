<?php

namespace Database\Seeders\tenant;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use ReflectionException;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * @throws ReflectionException
     */
    public function run(): void
    {
        foreach (get_permissions_with_groups('Tenant') as $groupKey => $permissions){
            foreach ($permissions as $permission){
                Permission::factory()->create([
                    'slug' => $permission,
                    'name' => trans('messages.'.$groupKey.'.'.$permission),
                    'permission_group' => $groupKey
                ]);
            }
        }
    }
}
