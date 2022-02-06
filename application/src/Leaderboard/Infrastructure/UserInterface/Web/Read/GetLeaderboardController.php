<?php

/*
 * This file is part of the Badger package
 *
 * (c) Olivier Soulet & Anael Chardan
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Badger\Leaderboard\Infrastructure\UserInterface\Web\Read;

use Badger\Leaderboard\Application\Read\GetLeaderboard\GetLeaderboard;
use Badger\SharedSpace\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

final class GetLeaderboardController
{
    private QueryBus $bus;

    public function __construct(QueryBus $bus)
    {
        $this->bus = $bus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $query = new GetLeaderboard();

        try {
            $leaderboard = $this->bus->fetch($query);
        } catch (HandlerFailedException $e) {
            return new JsonResponse($e->getMessage());
        }

        return new JsonResponse($leaderboard->getValue(), Response::HTTP_ACCEPTED);
    }
}
