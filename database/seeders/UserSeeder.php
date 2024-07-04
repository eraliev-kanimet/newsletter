<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    protected string $password;

    public function __construct()
    {
        $this->password = Hash::make('password');
    }

    public function run(): void
    {
        $this->admin();

        if (User::count() == 1) {
            for ($i = 0; $i < 10; $i++) {
                $email = fake()->unique()->email;

                User::firstOrCreate([
                    'email' => $email,
                ], [
                    'is_active' => rand(0, 1),
                    'name' => fake()->name,
                    'password' => $this->password,
                    'roles' => [2],
                ]);
            }
        }
    }

    protected function admin(): void
    {
        User::firstOrCreate([
            'email' => 'admin@admin.com',
        ], [
            'email' => 'admin@admin.com',
            'name' => fake()->name,
            'password' => $this->password,
            'roles' => [1],
        ]);
    }
}
