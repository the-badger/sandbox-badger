<?php

declare(strict_types=1);

namespace Badger\Gamification\Infrastructure\UserInterface\Web\Write;

use Badger\Gamification\Application\Write\CreateABadge\CreateABadge;
use Badger\SharedSpace\Bus\Command\CommandBus;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateABadgeController
{
    private CommandBus $bus;

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $command = new CreateABadge();
        $command->badgeId = Uuid::uuid4()->toString();
        $command->title = $request->get('badgeTitle');
        $command->description = $request->get('badgeDescription');

        $uuid = $this->bus->dispatch($command);

        return new JsonResponse(['badge_identifier' => $uuid->toString()], Response::HTTP_ACCEPTED);
    }
}
