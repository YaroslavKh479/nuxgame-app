<?php

namespace App\Http\Controllers\Game;

use App\Application\Commands\Game\PlayGame\PlayGameCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Game\PlayGameRequest;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    public function play(PlayGameRequest $request): JsonResponse
    {
        return $this->response(fn() => $this->commandBus(new PlayGameCommand(...$request->validated())));
    }

}
