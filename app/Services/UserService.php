<?php
namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendPasswordMail;

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
            $randomPassword     = Str::random(length: 10);
            $data['password']   = Hash::make(value: $randomPassword);
            $user               = $this->userRepository->create(data: $data);
            Mail::to(users: $user->email)->send(mailable: new SendPasswordMail(password: $randomPassword));

            return $user;
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
    public function syncProfiles(User $user, array $profileIds): array
    {
        return $user->profiles()->sync(ids: $profileIds);
    }
}