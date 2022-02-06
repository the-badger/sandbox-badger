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

namespace Badger\Gamification\Application\Write\ClaimABadge;

use Badger\Gamification\Domain\Badge\BadgeDoesNotExistException;
use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\MemberBadges\MaybeMember\MemberOption;
use Badger\Gamification\Domain\MemberBadges\MemberBadges;
use Badger\Gamification\Domain\MemberBadges\MemberId;
use Badger\Gamification\Domain\MemberBadges\MemberBadgesRepository;
use Badger\SharedSpace\Bus\Command\CommandHandler;

final class ClaimABadgeHandler implements CommandHandler
{
    private MemberBadgesRepository $memberBadgesRepository;
    private BadgeRepository $badgeRepository;

    public function __construct(MemberBadgesRepository $memberBadgesRepository, BadgeRepository $badgeRepository)
    {
        $this->memberBadgesRepository = $memberBadgesRepository;
        $this->badgeRepository = $badgeRepository;
    }

    public function __invoke(ClaimABadge $claimABadge): void
    {
        $memberId = MemberId::fromUuidString($claimABadge->memberId);
        $memberBadgesOption = $this->memberBadgesRepository->get($memberId);

        //TODO: validate that the user exists before
        if ($memberBadgesOption->isEmpty()) {
            $memberBadges = new MemberBadges($memberId);
            $memberBadgesOption = MemberOption::fromValue($memberBadges);
        }

        $memberBadges = $memberBadgesOption->member();

        $badgeId = BadgeId::fromUuidString($claimABadge->badgeId);
        $badgeOption = $this->badgeRepository->get($badgeId);

        if ($badgeOption->isEmpty()) {
            throw new BadgeDoesNotExistException($badgeId);
        }

        $memberBadges->claimABadge($badgeId);

        $this->memberBadgesRepository->save($memberBadges);
    }
}
