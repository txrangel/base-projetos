<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Permission;

class PermissionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('permission.index');
    }

    public function view(User $user, Permission $permission): bool
    {
        return $user->hasPermission('permission.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('permission.create');
    }

    public function update(User $user, Permission $permission): bool
    {
        return $user->hasPermission('permission.edit');
    }

    public function delete(User $user, Permission $permission): bool
    {
        return $user->hasPermission('permission.destroy');
    }
}