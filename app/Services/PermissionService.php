<?php
namespace App\Services;

use App\Models\Permission;
use App\Repositories\PermissionRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class PermissionService
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }
    public function getAllPermissions()
    {
        return $this->permissionRepository->all();
    }
    public function getPaginate(int $perPage = 10): LengthAwarePaginator
    {
        return $this->permissionRepository->paginate(perPage: $perPage);
    }
    public function findById(int $id): Permission
    {
        return $this->permissionRepository->findById(id: $id);
    }
    public function create(array $data): Permission
    {
        try {
            return $this->permissionRepository->create(data: $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function update(int $id, array $data): Permission
    {
        try {
            return $this->permissionRepository->update(id: $id, data: $data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function delete(int $id): bool
    {
        try {
            return $this->permissionRepository->delete(id: $id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}