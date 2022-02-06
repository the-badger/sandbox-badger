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
use Badger\Gamification\Domain\MemberBadges\MemberId;
use Badger\Gamification\Domain\MemberBadges\MemberBadgesRepository;
use Badger\Gamification\Domain\MemberBadges\NoMemberBadgesException;
use Badger\SharedSpace\Bus\Query\QueryHandler;
use Badger\SharedSpace\Bus\Query\ReadModel;

final class ListAllClaimedBadgesForAUserHandler implements QueryHandler
{
    private MemberBadgesRepository $memberBadgesRepository;
    private BadgeRepository $badgeRepository;

    public function __construct(MemberBadgesRepository $memberBadgesRepository, BadgeRepository $badgeRepository)
    {
        $this->memberBadgesRepository = $memberBadgesRepository;
        $this->badgeRepository = $badgeRepository;
    }

    public function __invoke(ListAllClaimedBadgesForAUser $listAllClaimedBadgesForAUser): ReadModel
    {
        $memberOption = $this->memberBadgesRepository->get(MemberId::fromUuidString($listAllClaimedBadgesForAUser->memberId));

        if ($memberOption->isEmpty()) {
            throw new NoMemberBadgesException(MemberId::fromUuidString($listAllClaimedBadgesForAUser->memberId));
        }

        $earnedBadgeIds = $memberOption->member()->getClaimedBadges();

        $claimedBadges = [];
        foreach ($earnedBadgeIds as $badgeId) {
            $claimedBadges[] = $this->badgeRepository->get($badgeId)->badge(); //TODO: check if badge exists before (could have been deleted in between)
        }

        return new MemberClaimedBadgesReadModel($claimedBadges);
    }
}
