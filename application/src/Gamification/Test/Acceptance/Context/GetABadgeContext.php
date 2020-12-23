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

namespace Badger\Gamification\Test\Acceptance\Context;

use Badger\Gamification\Application\Read\GetABadge\GetABadge;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\Badge\BadgeTitle;
use Badger\SharedSpace\Bus\Query\QueryBus;
use Behat\Behat\Context\Context;
use Webmozart\Assert\Assert;

class GetABadgeContext implements Context
{
    private QueryBus $queryBus;
    private BadgeRepository $badgeRepository;

    public function __construct(
        QueryBus $queryBus,
        BadgeRepository $badgeRepository
    ) {
        $this->queryBus = $queryBus;
        $this->badgeRepository = $badgeRepository;
    }

    /**
     * @Then I should see the badge :badgeTitle
     */
    public function iShouldSeeBadge(string $badgeTitle): void
    {
        $badgeOption = $this->badgeRepository->getBadgeByTitle(BadgeTitle::fromString($badgeTitle));

        if ($badgeOption->isEmpty()) {
            throw new \LogicException('The badge does not exist');
        }

        $badgeId = (string) $badgeOption->badge()->id();

        $getABadge = new GetABadge();
        $getABadge->badgeId = $badgeId;

        $badge = $this->queryBus->fetch($getABadge);

        /* @phpstan-ignore-next-line */
        Assert::eq($badge->title, $badgeTitle);
    }
}
