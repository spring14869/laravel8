<?php

namespace Database\Seeders;

use App\Models\UserStatus;
use Illuminate\Database\Seeder;

class UserStatusSeeder extends Seeder
{
    private $statusAry = [
        0 => 'disabled',
        1 => 'enabled'
    ];

    private $userStatus;

    public function __construct(UserStatus $userStatus)
    {
        $this->userStatus = $userStatus;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->userStatus->truncate(); //清除舊設定

        foreach ($this->statusAry as $status => $name) {
            $this->userStatus->create(
                [
                    'us_no' => $status,
                    'us_name' => $name
                ]
            );
        }
    }
}
