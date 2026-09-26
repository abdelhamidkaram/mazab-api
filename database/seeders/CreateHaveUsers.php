<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreateHaveUsers extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->count(10000)->sequence(fn($q) => [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => bcrypt('123456'),
            'role' => match($q->index % 3) {
                0 => UserRole::SuperAdmin->value,
                1 => UserRole::Admin->value,
                default => UserRole::User->value,
            },
            'status' => match($q->index % 2) {
                0 => UserStatus::Active->value,
                default => UserStatus::Inactive->value,
            },
        ])->create();
    }
}
