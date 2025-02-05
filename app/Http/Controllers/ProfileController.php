<?php

namespace App\Http\Controllers;

use App\Services\ProfileService;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected $profileService;

    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }
    public function index()
    {
        $perfis = $this->profileService->getPaginate();
        return view(view: 'profiles.index', data: compact(var_name: 'perfis'));
    }
    public function create()
    {
        return view(view: 'profiles.create');
    }
    public function edit(int $id)
    {
        $perfil  = $this->profileService->findById(id: $id);
        return view(view: 'profiles.edit', data: compact(var_name: 'perfil'));
    }
    public function store(Request $request)
    {
        try {
            $this->profileService->create(data: $request->all());
            return redirect()->route(route: 'profiles.index')->with('success', value: 'Perfil criado com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
    public function update(Request $request,int $id)
    {
        try {
            $this->profileService->update(id: $id, data: $request->all());
            return redirect()->route(route: 'profiles.index')->with(key: 'success', value: 'Perfil atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
    public function destroy(int $id)
    {
        try {
            $this->profileService->delete(id: $id);
            return redirect()->route(route: 'profiles.index')->with(key: 'success', value: 'Perfil excluído com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage());
        }
    }
}
