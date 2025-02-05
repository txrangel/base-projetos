<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionCreateUpdate;
use App\Services\PermissionService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }
    public function index(): View
    {
        $permissions = $this->permissionService->getPaginate();
        return view(view: 'permissions.index', data: compact(var_name: 'permissions'));
    }
    public function create(): View
    {
        return view(view: 'permissions.create');
    }
    public function edit(int $id): View
    {
        $permissao  = $this->permissionService->findById(id: $id);
        return view(view: 'permissions.edit', data: compact(var_name: 'permissao'));
    }
    public function store(PermissionCreateUpdate $request): RedirectResponse
    {
        try {
            $this->permissionService->create(data: $request->all());
            return Redirect::route(route: 'permissions.index')->with(key: 'success', value: 'Permissão criada com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
    public function update(PermissionCreateUpdate $request,int $id): RedirectResponse
    {
        try {
            $this->permissionService->update(id: $id, data: $request->all());
            return Redirect::route(route: 'permissions.index')->with(key: 'success', value: 'Permissão atualizada com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->permissionService->delete(id: $id);
            return Redirect::route(route: 'permissions.index')->with(key: 'success', value: 'Permissão excluída com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage());
        }
    }
}