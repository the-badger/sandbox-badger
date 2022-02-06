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

namespace Badger\Member\Infrastructure\UserInterface\Web\Write;

use Badger\Member\Application\Write\AcceptABadge\AcceptABadge;
use Badger\SharedSpace\Bus\Command\CommandBus;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use Safe\Exceptions\JsonException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\ValidationFailedException;

final class AcceptABadgeController
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

        $command = new AcceptABadge();
        $command->badgeId = array_key_exists('badgeId', $requestContent) ? $requestContent['badgeId'] : '';
        $command->memberId = array_key_exists('memberId', $requestContent) ? $requestContent['memberId'] : '';

        try {
            $this->bus->dispatch($command);
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

        return new JsonResponse([], Response::HTTP_ACCEPTED);
    }
}
