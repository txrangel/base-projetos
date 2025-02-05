<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileCreateUpdate;
use App\Services\PermissionService;
use App\Services\ProfileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    public function index(): View
    {
        $perfis = $this->profileService->getPaginate();
        return view(view: 'profiles.index', data: compact(var_name: 'perfis'));
    }
    public function create(): View
    {
        return view(view: 'profiles.create');
    }
    public function edit(int $id): View
    {
        $profile  = $this->profileService->findById(id: $id);
        return view(view: 'profiles.edit', data: compact(var_name: 'profile'));
    }
    public function store(ProfileCreateUpdate $request): RedirectResponse
    {
        try {
            $this->profileService->create(data: $request->all());
            return Redirect::route(route: 'profiles.index')->with(key: 'success', value: 'Perfil criado com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
    public function update(ProfileCreateUpdate $request,int $id): RedirectResponse
    {
        try {
            $this->profileService->update(id: $id, data: $request->all());
            return Redirect::route(route: 'profiles.index')->with(key: 'success', value: 'Perfil atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->profileService->delete(id: $id);
            return Redirect::route(route: 'profiles.index')->with(key: 'success', value: 'Perfil excluído com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage());
        }
    }
    public function editPermissions(int $id,PermissionService $permissionService): View
    {
        $profile         = $this->profileService->findById(id: $id);
        $permissions    = $permissionService->getAllPermissions();
        return view(view: 'profiles.permissions.edit', data: compact(var_name: ['profile', 'permissions']));
    }

    public function updatePermissions(Request $request, int $id): RedirectResponse
    {
        try {
            $permissionIds = $request->input('permissions', []);
            $profile         = $this->profileService->findById(id: $id);
            $this->profileService->syncPermissions($profile, $permissionIds);
            return redirect()->route('profiles.index')->with('success', 'Permissões do profile alteradas com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage());
        }
    }
}
