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

use Badger\Gamification\Application\Read\ListBadges\ListAllEarnedBadgesForAUser;
use Badger\Gamification\Application\Write\AcceptABadge\AcceptABadge;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\Badge\BadgeTitle;
use Badger\Gamification\Domain\Member\Member;
use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\SharedSpace\Bus\Command\CommandBus;
use Badger\SharedSpace\Bus\Query\QueryBus;
use Behat\Behat\Context\Context;
use Webmozart\Assert\Assert;

final class AcceptABadgeContext implements Context
{
    private CommandBus $commandBus;
    private MemberRepository $memberRepository;
    private Store $store;
    private BadgeRepository $badgeRepository;
    private QueryBus $queryBus;

    public function __construct(Store $store, CommandBus $commandBus, MemberRepository $memberRepository, BadgeRepository $badgeRepository, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->memberRepository = $memberRepository;
        $this->store = $store;
        $this->badgeRepository = $badgeRepository;
        $this->queryBus = $queryBus;
    }

    /**
     * @When I accept the badge :badgeTitle
     */
    public function iAcceptTheBadge(string $badgeTitle): void
    {
        $memberOption = $this->memberRepository->findByName($this->store->getMemberName());

        if ($memberOption->isEmpty()) {
            throw new \LogicException('The member does not exist');
        }

        /** @var Member $member */
        $member = $memberOption->member();
        $badgeOption = $this->badgeRepository->getBadgeByTitle(BadgeTitle::fromString($badgeTitle));

        if ($badgeOption->isEmpty()) {
            throw new \LogicException('The badge does not exist');
        }

        $badgeId = (string) $badgeOption->badge()->id();

        $acceptABadge = new AcceptABadge();
        $acceptABadge->memberId = (string) $member->id();
        $acceptABadge->badgeId = $badgeId;

        $this->commandBus->dispatch($acceptABadge);
    }

    /**
     * @Then I should see :numberOfEarnedBadge earned badge
     */
    public function iShouldSeeEarnedBadge(int $numberOfEarnedBadge): void
    {
        $memberOption = $this->memberRepository->findByName($this->store->getMemberName());
        $member = $memberOption->member();

        $earnedBadgeForMember = new ListAllEarnedBadgesForAUser();
        $earnedBadgeForMember->memberId = (string) $member->id();

        $result = $this->queryBus->fetch($earnedBadgeForMember);
        Assert::eq($numberOfEarnedBadge, count($result->getValue()));
    }
}
