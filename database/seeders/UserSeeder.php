<?php

namespace Database\Seeders;

use App\Models\User;
use Faker\Factory;
use Faker\Generator;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    protected Generator $faker;

    protected string $password;

    public function __construct()
    {
        $this->password = Hash::make('password');

        $this->faker = Factory::create();
    }

    public function run(): void
    {
        $this->admin();

        foreach (range(1, 12) as $month) {
            $rand = rand(5, 10);

            for ($i = 0; $i < $rand; $i++) {
                $email = $this->faker->unique()->email;

                $at = now()->subMonths(12 - $month)->startOfMonth();

                User::firstOrCreate([
                    'email' => $email,
                ], [
                    'is_active' => rand(0, 1),
                    'name' => $this->faker->name,
                    'password' => $this->password,
                    'roles' => [2],
                    'created_at' => $at,
                    'updated_at' => $at,
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
            'name' => $this->faker->name,
            'password' => $this->password,
            'roles' => [1],
        ]);
    }
}
