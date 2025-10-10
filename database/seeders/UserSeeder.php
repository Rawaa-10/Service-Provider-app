<?php

namespace Database\Seeders;

use App\Enums\RoleUserEnum;
use Hash;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            RoleUserEnum::Admin, RoleUserEnum::Client, RoleUserEnum::Provider
        ];

        foreach ($roles as $role) {
        User::create([
            "name" => $role, 
            "email" => $role . "@gmail.com",
            "password" => Hash::make("Password@123"),
            "role" => $role 
        ]);
    }
        // foreach ($users as $user) {
        //     User::create([
        //         "name" => $user , 
        //         "email" => "$user@gmail.com" , 
        //         "password"=> Hash::make("Password@123"),
        //         "role" => $user
        //     ]);
        // }
    }
}
