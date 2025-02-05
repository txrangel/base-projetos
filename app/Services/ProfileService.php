<?php
namespace App\Services;

use App\Models\Profile;
use App\Repositories\ProfileRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProfileService
{
    protected $profileRepository;

    public function __construct(profileRepository $profileRepository)
    {
        $this->profileRepository = $profileRepository;
    }
    public function getAllProfiles()
    {
        return $this->profileRepository->all();
    }
    public function getPaginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->profileRepository->paginate(perPage: $perPage);
    }
    public function findById(int $id): Profile
    {
        return $this->profileRepository->findById(id: $id);
    }
    public function create(array $data): Profile
    {
        try {
            return $this->profileRepository->create(data: $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function update(int $id, array $data): Profile
    {
        try {
            return $this->profileRepository->update(id: $id, data: $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function delete(int $id): bool
    {
        try {
            return $this->profileRepository->delete(id: $id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function syncPermissions(Profile $profile, array $permissionIds): array
    {
        return $profile->permissions()->sync(ids: $permissionIds);
    }
}