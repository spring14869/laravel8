<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->user->create([
            'u_account' => 'admin',
            'u_password' => Hash::make('123456'),
            'u_name' => 'Admin',
            'u_status' => 1,
            'u_remark' => 'default user'
        ]);
    }
}
