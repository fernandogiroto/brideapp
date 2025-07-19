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
    public function run()
    {
        User::create([
            'name' => 'Test',
            'surname' => 'User',
            'email' => 'test@test.com',
            'username' => 'testuser',
            'password' => Hash::make('123456789'),
        ]);
    }
}
