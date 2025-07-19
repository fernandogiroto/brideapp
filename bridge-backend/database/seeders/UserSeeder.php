<?php

namespace Database\Seeders;

<<<<<<< HEAD
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
=======
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
>>>>>>> 35d91532053fad25885f5a73c17ecd73aa797c2e

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
<<<<<<< HEAD
=======
     *
     * @return void
>>>>>>> 35d91532053fad25885f5a73c17ecd73aa797c2e
     */
    public function run()
    {
        User::create([
<<<<<<< HEAD
            'name' => 'Test',
            'surname' => 'User',
            'email' => 'test@test.com',
            'username' => 'testuser',
            'password' => Hash::make('123456789'),
=======
            'name' => 'Admin',
            'surname' => '01',
            'email' => 'admin@example.com',
            'username' => 'admin_01',
            'role_id' => 1,
            'password' => Hash::make(env('ADMIN_PASSWORD')),
>>>>>>> 35d91532053fad25885f5a73c17ecd73aa797c2e
        ]);
    }
}
