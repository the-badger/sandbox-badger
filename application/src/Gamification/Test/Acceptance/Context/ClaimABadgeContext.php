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

use Badger\Gamification\Application\Read\ListBadges\ListAllClaimedBadgesForAUser;
use Badger\Gamification\Application\Write\ClaimABadge\ClaimABadge;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\Badge\BadgeTitle;
use Badger\Gamification\Domain\MemberBadges\MemberBadges;
use Badger\Gamification\Domain\MemberBadges\MemberBadgesRepository;
use Badger\SharedSpace\Bus\Command\CommandBus;
use Badger\SharedSpace\Bus\Query\QueryBus;
use Behat\Behat\Context\Context;
use Webmozart\Assert\Assert;

final class ClaimABadgeContext implements Context
{
    private CommandBus $commandBus;
    private MemberBadgesRepository $memberRepository;
    private Store $store;
    private BadgeRepository $badgeRepository;
    private QueryBus $queryBus;

    public function __construct(Store $store, CommandBus $commandBus, MemberBadgesRepository $memberRepository, BadgeRepository $badgeRepository, QueryBus $queryBus)
    {
        $this->commandBus = $commandBus;
        $this->memberRepository = $memberRepository;
        $this->store = $store;
        $this->badgeRepository = $badgeRepository;
        $this->queryBus = $queryBus;
    }

    /**
     * @When I claim the badge :badgeTitle
     */
    public function iClaimTheBadge(string $badgeTitle): void
    {
        $memberOption = $this->memberRepository->findByName($this->store->getMemberName());

        if ($memberOption->isEmpty()) {
            throw new \LogicException('The member does not exist');
        }

        /** @var MemberBadges $member */
        $member = $memberOption->member();
        $badgeOption = $this->badgeRepository->getBadgeByTitle(BadgeTitle::fromString($badgeTitle));

        if ($badgeOption->isEmpty()) {
            throw new \LogicException('The badge does not exist');
        }

        $badgeId = (string) $badgeOption->badge()->id();

        $claimABadge = new ClaimABadge();
        $claimABadge->memberId = (string) $member->id();
        $claimABadge->badgeId = $badgeId;

        $this->commandBus->dispatch($claimABadge);
    }

    /**
     * @Then I should see :numberOfClaimedBadge claimed badge
     */
    public function iShouldSeeClaimedBadge(int $numberOfClaimedBadge): void
    {
        $memberOption = $this->memberRepository->findByName($this->store->getMemberName());
        $member = $memberOption->member();

        $claimedBadgeForMember = new ListAllClaimedBadgesForAUser();
        $claimedBadgeForMember->memberId = (string) $member->id();

        $result = $this->queryBus->fetch($claimedBadgeForMember);
        Assert::eq($numberOfClaimedBadge, count($result->getValue()));
    }
}
