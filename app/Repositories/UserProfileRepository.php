<?php
namespace App\Repositories;

use App\Models\User;


class UserProfileRepository
{
    protected $model;

    public function __construct(User $user)
    {
        $this->model = $user;
    }
    public function save(User $user): bool
    {
        return $user->save();
    }
}