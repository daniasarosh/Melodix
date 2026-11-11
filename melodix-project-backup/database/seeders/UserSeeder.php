<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

// Owner: Member 1 (blue). Sample logins: admin / Admin@123  and  demo / User@123
class UserSeeder extends Seeder
{
    public function run(): void
    {
        if (DB::table('users')->exists()) {
            return;
        }

        DB::table('users')->insert([
            ['username' => 'admin', 'name' => 'Melodix Admin', 'address' => 'Karachi, Pakistan', 'phone' => '03001112222',
             'email' => 'admin@melodix.local', 'password' => Hash::make('Admin@123'), 'role' => 'admin',
             'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['username' => 'demo', 'name' => 'Demo User', 'address' => 'Karachi, Pakistan', 'phone' => '03001234567',
             'email' => 'demo@melodix.local', 'password' => Hash::make('User@123'), 'role' => 'user',
             'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
