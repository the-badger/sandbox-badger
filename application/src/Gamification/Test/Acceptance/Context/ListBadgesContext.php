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

use Badger\Gamification\Application\Read\ListBadges\ListAllBadges;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\SharedSpace\Bus\Query\QueryBus;
use Behat\Behat\Context\Context;
use Webmozart\Assert\Assert;

final class ListBadgesContext implements Context
{
    private QueryBus $queryBus;
    private MemberRepository $memberRepository;
    private Store $store;
    private BadgeRepository $badgeRepository;

    public function __construct(Store $store, QueryBus $queryBus, MemberRepository $memberRepository, BadgeRepository $badgeRepository)
    {
        $this->queryBus = $queryBus;
        $this->memberRepository = $memberRepository;
        $this->store = $store;
        $this->badgeRepository = $badgeRepository;
    }

    /**
     * @Then I should be able to list all badges
     */
    public function iShouldBeAbleToListAllBadges(): void
    {
        $listAllBadges = new ListAllBadges();

        $badges = $this->queryBus->fetch($listAllBadges);

        /* @phpstan-ignore-next-line */
        Assert::eq(count($badges->badges), 2);
    }
}
