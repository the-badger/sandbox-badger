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

namespace Badger\Gamification\Infrastructure\UserInterface\Web\Write;

use Badger\Gamification\Application\Write\ClaimABadge\ClaimABadge;
use Badger\SharedSpace\Bus\Command\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ClaimABadgeController
{
    private CommandBus $bus;

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $command = new ClaimABadge();
        $command->badgeId = Uuid::uuid4()->toString();
        $command->badgeId = $request->get('badgeId');
        $command->memberId = $request->get('memberId');

        $this->bus->dispatch($command);

        return new JsonResponse([], Response::HTTP_ACCEPTED);
    }
}
