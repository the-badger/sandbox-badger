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

namespace Badger\Gamification\Infrastructure\UserInterface\Web\Read;

use Badger\Gamification\Application\Read\ListBadges\ListAllBadges;
use Badger\SharedSpace\Bus\Query\QueryBus;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;

final class GetBadgesListController
{
    private QueryBus $bus;

    public function __construct(QueryBus $bus)
    {
        $this->bus = $bus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $query = new ListAllBadges();

        try {
            $badges = $this->bus->fetch($query);
        } catch (HandlerFailedException $e) {
            return new JsonResponse($e->getMessage());
        }

        return new JsonResponse($badges->getValue(), Response::HTTP_ACCEPTED);
    }
}
