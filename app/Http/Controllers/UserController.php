<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateUpdate;
use App\Services\UserService;


class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    public function index()
    {
        $users = $this->userService->getPaginate();
        return view(view: 'users.index', data: compact(var_name: 'users'));
    }
    public function create()
    {
        return view(view: 'users.create');
    }
    public function edit(int $id)
    {
        $user  = $this->userService->findById(id: $id);
        return view(view: 'users.edit', data: compact(var_name: 'user'));
    }
    public function store(UserCreateUpdate $request)
    {
        try {
            $this->userService->create(data: $request->all());
            return redirect()->route(route: 'users.index')->with('success', value: 'Perfil criado com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
    public function update(UserCreateUpdate $request,int $id)
    {
        try {
            $this->userService->update(id: $id, data: $request->all());
            return redirect()->route(route: 'users.index')->with(key: 'success', value: 'Perfil atualizado com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage())->withInput();
        }
    }
    public function destroy(int $id)
    {
        try {
            $this->userService->delete(id: $id);
            return redirect()->route(route: 'users.index')->with(key: 'success', value: 'Perfil excluído com sucesso!');
        } catch (\Exception $e) {
            return back()->with(key: 'error', value: $e->getMessage());
        }
    }
}
