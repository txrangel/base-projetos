<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Profile;

class ProfilePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->hasPermission('profile.index');
    }

    public function view(User $user, Profile $profile): bool
    {
        return $user->hasPermission('profile.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermission('profile.create');
    }

    public function update(User $user, Profile $profile): bool
    {
        return $user->hasPermission('profile.edit');
    }

    public function delete(User $user, Profile $profile): bool
    {
        return $user->hasPermission('profile.destroy');
    }

    public function managePermissions(User $user, Profile $profile): bool
    {
        return $user->hasPermission('profile.permissions.edit');
    }
}