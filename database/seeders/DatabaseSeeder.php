<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Administrador',
            'email' => 'admin@barbearia.com',
            'password' => Hash::make('admin1234'),
            'role' => 'admin',
        ]);
        \App\Models\User::create([
            'name' => 'Cliente',
            'telefone' => '11987654321',
            'password' => Hash::make('cliente1234'),
            'role' => 'cliente',
        ]);
        \App\Models\User::create([
            'name' => 'Barbeiro Daniel',
            'email' => 'barbeiro@barbearia.com',
            'password' => Hash::make('barbeiro1234'),
            'role' => 'barbeiro',
        ]);
    }
}
