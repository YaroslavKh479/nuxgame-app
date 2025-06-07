<?php

namespace app\Infrastructure\Persistence\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property int $balance
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Authenticatable
{

    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'phone',
        'balance',
    ];

}
