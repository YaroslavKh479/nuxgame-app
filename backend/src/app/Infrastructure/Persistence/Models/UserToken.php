<?php

namespace app\Infrastructure\Persistence\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property string $token
 * @property Carbon $expires_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class UserToken extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'token',
        'expires_at',
    ];


    // Relations

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
