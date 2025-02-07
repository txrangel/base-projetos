<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Verifica se o usuário pode visualizar a lista de usuários.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('user.index');
    }

    /**
     * Verifica se o usuário pode visualizar um usuário específico.
     */
    public function view(User $user, User $model): bool
    {
        return $user->hasPermission('user.view');
    }

    /**
     * Verifica se o usuário pode criar um novo usuário.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission('user.create');
    }

    /**
     * Verifica se o usuário pode editar um usuário existente.
     */
    public function update(User $user, User $model): bool
    {
        return $user->hasPermission('user.edit');
    }
        /**
     * Verifica se o usuário pode editar a senha de um usuário.
     */
    public function updatePassword(User $user, User $model): bool
    {
        return $user->hasPermission('user.edit.password');
    }
    /**
     * Verifica se o usuário pode excluir um usuário.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->hasPermission('user.destroy');
    }

    /**
     * Verifica se o usuário pode gerenciar os perfis de um usuário.
     */
    public function manageProfiles(User $user, User $model): bool
    {
        return $user->hasPermission('user.profiles.edit');
    }
}