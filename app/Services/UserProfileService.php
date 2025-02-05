<?php
namespace App\Services;

use App\Http\Requests\UserProfileUpdate;
use App\Repositories\UserProfileRepository;
class UserProfileService
{
    protected $UserprofileRepository;

    public function __construct(UserProfileRepository $UserprofileRepository)
    {
        $this->UserprofileRepository = $UserprofileRepository;
    }
    public function update(UserProfileUpdate $request): bool
    {
        $request->user()->fill($request->validated());
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }
        return $this->UserprofileRepository->save(user: $request->user());
    }
}