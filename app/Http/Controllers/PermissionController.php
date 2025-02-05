<?php

namespace App\Http\Controllers;

use App\Services\PermissionService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    protected $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }
    public function index()
    {
        $permissions = $this->permissionService->getAllPermissions();
        return view('permissions.index', compact('permissions'));
    }
    public function create()
    {
        return view(view: 'permissions.create');
    }
    public function edit(int $id)
    {
        $permissao  = $this->permissionService->findById(id: $id);
        return view(view: 'permissions.edit', data: compact(var_name: 'permissao'));
    }
    public function store(Request $request)
    {
        try {
            $this->permissionService->create(data: $request->all());
            return redirect()->route(route: 'permissions.index')->with('success', value: 'Permissão criada com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
    public function update(Request $request,int $id)
    {
        try {
            $this->permissionService->update(id: $id, data: $request->all());
            return redirect()->route(route: 'permissions.index')->with(key: 'success', value: 'Permissão atualizada com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
    public function destroy(int $id)
    {
        try {
            $this->permissionService->delete(id: $id);
            return redirect()->route(route: 'permissions.index')->with(key: 'success', value: 'Permissão excluída com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage());
        }
    }
}