<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Recuperar todos os perfis e permissões
        $adminProfile = Profile::where('name', 'Admin')->first();
        $editorProfile = Profile::where('name', 'Editor')->first();
        $viewerProfile = Profile::where('name', 'Viewer')->first();

        $allPermissions = Permission::all();
        $indexPermissions = Permission::where('name', 'like', '%.index')->get();
        $nonDestroyPermissions = Permission::where('name', 'not like', '%.destroy')->get();

        // Atrelar todas as permissões ao perfil de Admin
        $adminProfile->permissions()->sync($allPermissions->pluck('id'));

        // Atrelar permissões (exceto destroy) ao perfil de Editor
        $editorProfile->permissions()->sync($nonDestroyPermissions->pluck('id'));

        // Atrelar apenas permissões de index ao perfil de Viewer
        $viewerProfile->permissions()->sync($indexPermissions->pluck('id'));

        // Atrelar o usuário admin ao perfil de Admin
        $adminUser = User::where('email', 'admin@example.com')->first();
        $adminUser->profiles()->sync([$adminProfile->id]);
    }
}
