<?php

namespace App\Infrastructure\Common\Cache;

enum CacheKey : string
{

    case TOKEN_GAME_HISTORY = 'token:%s:game:history';

    public function makeKey(...$args): string
    {
        return sprintf($this->value, ...$args);
    }
}
