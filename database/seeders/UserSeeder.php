<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $default_users = [
            [
                'login' => 'admin',
                'password' => 'SDFSQEnH',
            ],
            [
                'login' => 'manager1',
                'password' => 'GFNAnk4w',
            ],
            [
                'login' => 'manager2',
                'password' => 'M6wSZ2Lr',
            ],
        ];

        foreach ($default_users as $user) {
            $user = new User([
                'login' => $user['login'],
                'password' => Hash::make($user['password'])
            ]);
            $user->save();
        }
    }
}
