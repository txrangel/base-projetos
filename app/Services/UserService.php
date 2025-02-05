<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    public function getAllProfiles()
    {
        return $this->userRepository->all();
    }
    public function getPaginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->userRepository->paginate(perPage: $perPage);
    }
    public function findById(int $id): User
    {
        return $this->userRepository->findById(id: $id);
    }
    public function create(array $data): User
    {
        try {
            $randomPassword = Str::random(10);
            $data['password'] = Hash::make($randomPassword);
            return $this->userRepository->create(data: $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function update(int $id, array $data): User
    {
        try {
            return $this->userRepository->update(id: $id, data: $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function delete(int $id): bool
    {
        try {
            return $this->userRepository->delete(id: $id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}