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

use Badger\Gamification\Application\Write\CreateABadge\CreateABadge;
use Badger\SharedSpace\Bus\Command\CommandBus;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Safe\Exceptions\JsonException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\ValidationFailedException;

final class CreateABadgeController
{
    private CommandBus $bus;

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $requestContent = \Safe\json_decode($request->getContent(), true);
        } catch (JsonException $e) {
            $requestContent = '';
        }

        $command = new CreateABadge();
        $command->title = array_key_exists('badgeTitle', $requestContent) ? $requestContent['badgeTitle'] : '';
        $command->description = array_key_exists('badgeTitle', $requestContent) ? $requestContent['badgeDescription'] : '';


        try {
            $uuid = $this->bus->dispatch($command);
        } catch (HandlerFailedException $e) {
            return new JsonResponse($e->getMessage());
        } catch (ValidationFailedException $e) {
            $errorMessages = [];
            foreach ($e->getViolations() as $violation) {
                $errorMessages[] = $violation->getMessage();
            }
            return new JsonResponse($errorMessages);
        } catch (UniqueConstraintViolationException $e) {
            return new JsonResponse('Already exists');
        }

        return new JsonResponse(['badge_identifier' => $uuid], Response::HTTP_ACCEPTED);
    }
}
