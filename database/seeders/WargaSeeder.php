<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::updateOrCreate(
            ['email' => 'warga@gmail.com'],
            [
                'name' => 'Warga Test',
                'password' => \Illuminate\Support\Facades\Hash::make('warga123'),
                'role' => 'user',
            ]
        );
    }
}
