<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Permission::create(['name' => 'profile.index']);
        Permission::create(['name' => 'profile.create']);
        Permission::create(['name' => 'profile.store']);
        Permission::create(['name' => 'profile.edit']);
        Permission::create(['name' => 'profile.update']);
        Permission::create(['name' => 'profile.destroy']);
        Permission::create(['name' => 'permission.index']);
        Permission::create(['name' => 'permission.create']);
        Permission::create(['name' => 'permission.store']);
        Permission::create(['name' => 'permission.edit']);
        Permission::create(['name' => 'permission.update']);
        Permission::create(['name' => 'permission.destroy']);
    }
}
