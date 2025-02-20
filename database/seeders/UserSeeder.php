<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\PasswordService;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $passwordService = new PasswordService();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => $passwordService->make('password'),
        ]);
    }
}