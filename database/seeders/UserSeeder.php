<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Command : php artisan db:seed --class=UserSeeder
     * @return void
     */
    public function run()
    {
        // 使用工廠模式產生10比測試資料
        User::factory()->count(10)->create();
    }
}
