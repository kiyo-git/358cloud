<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_users = [
            [
                'name'     => Str::random(10),
                'email'    => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'role'     => 1,
            ],
            [
                'name'     => Str::random(10),
                'email'    => Str::random(10).'@gmail.com',
                'password' => Hash::make('password'),
                'role'     => 2,
            ],
            [
                'name'     => Str::random(10),
                'email'    => '*@gmail.com',
                'password' => Hash::make('password'),
                'role'     => 1,
            ],
        ];
        
        DB::table('admin_users')->insert($admin_users);
    }
}
