<?php

namespace Database\Seeders;

use App\Models\User;
use App\Services\PasswordService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public PasswordService $passwordService;
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => $this->passwordService->make('password'),
        ]);
    }
}
