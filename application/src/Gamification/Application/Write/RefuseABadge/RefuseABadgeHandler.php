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

namespace Badger\Gamification\Application\Write\RefuseABadge;

use Badger\Gamification\Domain\Badge\BadgeDoesNotExistException;
use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\BadgeNotInClaimedListException;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\Member\MemberId;
use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\Gamification\Domain\Member\UnexistingMemberException;
use Badger\SharedSpace\Bus\Command\CommandHandler;

final class RefuseABadgeHandler implements CommandHandler
{
    private MemberRepository $memberRepository;
    private BadgeRepository $badgeRepository;

    public function __construct(MemberRepository $memberRepository, BadgeRepository $badgeRepository)
    {
        $this->memberRepository = $memberRepository;
        $this->badgeRepository = $badgeRepository;
    }

    public function __invoke(RefuseABadge $refuseABadge): void
    {
        $memberId = MemberId::fromUuidString($refuseABadge->memberId);
        $memberOption = $this->memberRepository->get($memberId);

        if ($memberOption->isEmpty()) {
            throw new UnexistingMemberException($memberId);
        }

        $badgeId = BadgeId::fromUuidString($refuseABadge->badgeId);
        $badgeOption = $this->badgeRepository->get($badgeId);

        if ($badgeOption->isEmpty()) {
            throw new BadgeDoesNotExistException($badgeId);
        }

        $member = $memberOption->member();

        if (!$member->claimedBadges->contains($badgeId)) {
            throw new BadgeNotInClaimedListException($badgeId);
        }

        $member->claimedBadges = $member->claimedBadges->minus($badgeId);

        $this->memberRepository->save($member);
    }
}
