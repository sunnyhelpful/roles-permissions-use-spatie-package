<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'                    => 'User',
            'email'                   => 'admin@gmail.com',
            'email_verified_at'       => now(),
            'created_at'              => now(),
            'updated_at'              => now(),
            'password'                => Hash::make('Admin@1234') // <---- Remember this
        ]);
    }
}
