<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(
            [
                // 初始用戶
                AdminSeeder::class,
                // 使用者狀態
                UserStatusSeeder::class
            ]
        );
    }
}
