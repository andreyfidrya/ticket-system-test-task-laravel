<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Иван Иванов',
            'email' => 'ivan@example.com',
            'password' => Hash::make('ivan12345'),
        ]);

        User::create([
            'name' => 'Петр Петров',
            'email' => 'petr@example.com',
            'password' => Hash::make('petr54321'),
        ]);

        User::create([
            'name' => 'Сидор Сидоров',
            'email' => 'sidor@example.com',
            'password' => Hash::make('sidor2024'),
        ]);
    }
}
