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

use Badger\Gamification\Application\ClaimABadge;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\Badge\BadgeTitle;
use Badger\Gamification\Domain\Member\Member;
use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\SharedSpace\Bus\CommandBus;
use Behat\Behat\Context\Context;

final class ClaimABadgeContext implements Context
{
    /** @var CommandBus */
    private $commandBus;

    /** @var MemberRepository */
    private $memberRepository;

    /** @var Store */
    private $store;

    /** @var BadgeRepository */
    private $badgeRepository;

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
    public function iShouldBeAbleToClaimTheBadge($badgeTitle)
    {
        $memberOption = $this->memberRepository->findByName($this->store->get(Store::BADGER_MEMBER_NAME));

        if ($memberOption->option()->isEmpty()) {
            throw new \LogicException('The member does not exist');
        }

        /** @var Member $member */
        $member = $memberOption->option()->get();
        $badgeOption = $this->badgeRepository->getBadgeByTitle(new BadgeTitle($badgeTitle));

        if ($badgeOption()->isEmpty()) {
            throw new \LogicException('The badge does not exist');
        }

        $badgeId = $badgeOption()->get()->id()->__toString();

        $claimABadge = new ClaimABadge($member->id()->__toString(), $badgeId);

        $this->commandBus->dispatch($claimABadge);
    }
}
