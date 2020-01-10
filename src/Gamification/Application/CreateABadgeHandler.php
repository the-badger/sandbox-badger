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

namespace Badger\Gamification\Application;

use Badger\Gamification\Domain\Badge\Badge;
use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Ramsey\Uuid\Uuid;

final class CreateABadgeHandler
{
    /**
     * @var BadgeRepository
     */
    private $badgeRepository;

    public function __construct(BadgeRepository $badgeRepository)
    {
        $this->badgeRepository = $badgeRepository;
    }

    public function __invoke(CreateABadge $createABadge)
    {
        $badgeId = new BadgeId(Uuid::fromString($createABadge->badgeId));
        $this->badgeRepository->save(new Badge($badgeId));
    }
}
