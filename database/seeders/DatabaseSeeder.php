<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Administrador del Sistema',
            'email' => 'admin@sistema.com',
            'password' => \Illuminate\Support\Facades\Hash::make('admin123'),
            'role' => 'admin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Prof. Juan Pérez',
            'email' => 'juan@sistema.com',
            'password' => \Illuminate\Support\Facades\Hash::make('docente123'),
            'role' => 'teacher',
        ]);
    }
}
