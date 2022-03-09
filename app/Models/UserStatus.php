<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStatus extends Model
{
    use HasFactory;

    protected $table = 'user_status';

    protected $primaryKey = 'us_id';

    public $timestamps = false;

    protected $fillable = [
        'us_no',
        'us_name',
    ];


    /**
     * 關聯至user.u_status
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'u_status');
    }
}
