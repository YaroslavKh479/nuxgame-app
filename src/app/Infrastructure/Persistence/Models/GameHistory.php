<?php

namespace App\Infrastructure\Persistence\Models;

use App\Domain\GameHistory\Enums\GameResult;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_token_id
 * @property int $generated_number
 * @property GameResult $result
 * @property float $prize
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class GameHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_token_id',
        'generated_number',
        'result',
        'prize'
    ];

    protected $casts = [
        'result' => GameResult::class,
    ];

    // Relations

    public function user_token(): BelongsTo
    {
        return $this->belongsTo(UserToken::class);
    }
}
