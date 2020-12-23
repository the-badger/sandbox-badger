<?php

declare(strict_types=1);

/*
 * This file is part of the Badger package
 *
 * (c) Olivier Soulet & Anael Chardan
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Badger\Gamification\Application\Read\GetABadge;

use Badger\Gamification\Domain\Badge\BadgeDoesNotExistException;
use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\SharedSpace\Bus\Query\QueryHandler;
use Badger\SharedSpace\Bus\Query\ReadModel;

final class GetABadgeHandler implements QueryHandler
{
    private BadgeRepository $badgeRepository;

    public function __construct(BadgeRepository $badgeRepository)
    {
        $this->badgeRepository = $badgeRepository;
    }

    public function __invoke(GetABadge $getABadge): ReadModel
    {
        $badge = $this->badgeRepository->get(BadgeId::fromUuidString($getABadge->badgeId));

        if ($badge->isEmpty()) {
            throw new BadgeDoesNotExistException(BadgeId::fromUuidString($getABadge->badgeId));
        }

        return new BadgeReadModel($badge->badge());
    }
}
