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
