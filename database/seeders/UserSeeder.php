<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Tạo 10 người dùng với vai trò 'user' và mật khẩu '12345678'
        User::factory()->count(10)->create();
    }
}
