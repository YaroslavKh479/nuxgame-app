<?php

namespace App\Http\Controllers\Game;

use App\Application\Commands\Game\Play\PlayCommand;
use App\Application\Queries\History\HistoryCommand;
use App\Http\Controllers\Controller;
use App\Http\Requests\Game\HistoryRequest;
use App\Http\Requests\Game\PlayGameRequest;
use Illuminate\Http\JsonResponse;

class GameController extends Controller
{
    public function play(PlayGameRequest $request): JsonResponse
    {
        return $this->response(fn() => $this->commandBus(new PlayCommand(...$request->validated())));
    }

    public function history(HistoryRequest $request): JsonResponse
    {
        return $this->response(fn() => $this->commandBus(new HistoryCommand(...$request->validated())));
    }

}
