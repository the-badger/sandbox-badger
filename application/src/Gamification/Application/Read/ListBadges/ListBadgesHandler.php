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

namespace Badger\Gamification\Application\Read\ListBadges;

use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\SharedSpace\Bus\Command\CommandHandler;

final class ListBadgesHandler implements CommandHandler
{
    private BadgeRepository $badgeRepository;

    public function __construct(BadgeRepository $badgeRepository)
    {
        $this->badgeRepository = $badgeRepository;
    }

    public function __invoke(ListBadges $listBadges): BadgesReadModel
    {
        return new BadgesReadModel($this->badgeRepository->all());
    }
}
