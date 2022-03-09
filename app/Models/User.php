<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    const ENABLED = 1;
    const DISABLED = 0;

    use HasFactory;
    use SoftDeletes;

    protected $table = 'users';

    protected $primaryKey = 'u_id';

    protected $fillable = [
        'u_account',
        'u_password',
        'u_email',
        'u_name',
        'u_image',
        'u_remark',
        'u_status',
    ];

    public function getDefaultValue()
    {
        return [
            'u_id' => 0,
            'u_account' => '',
            'u_password' => '',
            'u_email' => '',
            'u_name' => '',
            'u_image' => '',
            'u_remark' => '',
            'u_status' => static::ENABLED
        ];
    }

    /**
     * 關聯至 user_status 使用with簡化查詢
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function status()
    {
        return $this->hasOne(UserStatus::class, 'us_no', 'u_status');
    }
}
