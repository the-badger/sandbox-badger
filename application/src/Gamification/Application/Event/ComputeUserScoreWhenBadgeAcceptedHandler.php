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

namespace Badger\Gamification\Application\Event;

use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\MemberBadges\MemberId;
use Badger\Gamification\Domain\MemberBadges\MemberBadgesRepository;
use Badger\Gamification\Domain\Score\UserScoreComputation;
use Badger\SharedSpace\Bus\Event\EventHandler;

final class ComputeUserScoreWhenBadgeAcceptedHandler implements EventHandler
{
    private MemberBadgesRepository $memberBadgesRepository;
    private BadgeRepository $badgeRepository;
    private UserScoreComputation $userScoreComputation;

    public function __construct(MemberBadgesRepository $memberBadgesRepository, BadgeRepository $badgeRepository, UserScoreComputation $userScoreComputation)
    {
        $this->memberBadgesRepository = $memberBadgesRepository;
        $this->badgeRepository = $badgeRepository;
        $this->userScoreComputation = $userScoreComputation;
    }

    public function __invoke(BadgeAccepted $badgeAccepted)
    {
        $member = $this->memberBadgesRepository->get(MemberId::fromUuidString($badgeAccepted->memberId));
        $badge = $this->badgeRepository->get(BadgeId::fromUuidString($badgeAccepted->badgeId));

        $score = $this->userScoreComputation->compute($member->member(), $badge->badge());

        $member = $member->member();
        $member->memberScore = $score;

        $this->memberBadgesRepository->save($member);
    }
}
