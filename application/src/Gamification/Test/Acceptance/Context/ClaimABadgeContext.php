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

use Badger\Gamification\Application\Write\ClaimABadge\ClaimABadge;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\Badge\BadgeTitle;
use Badger\Gamification\Domain\Member\Member;
use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\SharedSpace\Bus\Command\CommandBus;
use Behat\Behat\Context\Context;

final class ClaimABadgeContext implements Context
{
    private CommandBus $commandBus;
    private MemberRepository $memberRepository;
    private Store $store;
    private BadgeRepository $badgeRepository;

    public function __construct(Store $store, CommandBus $commandBus, MemberRepository $memberRepository, BadgeRepository $badgeRepository)
    {
        $this->commandBus = $commandBus;
        $this->memberRepository = $memberRepository;
        $this->store = $store;
        $this->badgeRepository = $badgeRepository;
    }

    /**
     * @Then I should be able to claim the badge :badgeTitle
     */
    public function iShouldBeAbleToClaimTheBadge(string $badgeTitle): void
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

        $claimABadge = new ClaimABadge();
        $claimABadge->memberId = (string) $member->id();
        $claimABadge->badgeId = $badgeId;

        $this->commandBus->dispatch($claimABadge);
    }
}
