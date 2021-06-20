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

namespace Badger\Gamification\Application\Write\CreateABadge;

use Badger\Gamification\Domain\Badge\Badge;
use Badger\Gamification\Domain\Badge\BadgeDescription;
use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\BadgePoints;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\Badge\BadgeTitle;
use Badger\SharedSpace\Bus\Command\CommandHandler;
use Ramsey\Uuid\Uuid;

final class CreateABadgeHandler implements CommandHandler
{
    private BadgeRepository $badgeRepository;

    public function __construct(BadgeRepository $badgeRepository)
    {
        $this->badgeRepository = $badgeRepository;
    }

    public function __invoke(CreateABadge $createABadge): string
    {
        $badgeId = new BadgeId(Uuid::uuid4());
        $badgeTitle = BadgeTitle::fromString($createABadge->title);
        $badgeDescription = BadgeDescription::fromString($createABadge->description);
        $badgePoints = BadgePoints::fromInt(50);

        $this->badgeRepository->save(new Badge($badgeId, $badgeTitle, $badgeDescription, $badgePoints));

        return $badgeId->__toString();
    }
}
