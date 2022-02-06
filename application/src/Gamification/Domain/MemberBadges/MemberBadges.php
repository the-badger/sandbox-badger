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

namespace Badger\Gamification\Domain\MemberBadges;

use Badger\Gamification\Domain\Badge\BadgeId;
use Phunkie\Types\ImmSet;

class MemberBadges
{
    public MemberId $id;
    public ImmSet $claimedBadges;
    public ImmSet $earnedBadges;
    public MemberScore $memberScore;

    public function __construct(MemberId $id)
    {
        $this->id = $id;
        $this->claimedBadges = new ImmSet();
        $this->earnedBadges = new ImmSet();
        $this->memberScore = MemberScore::fromInt(0);
    }

    public function claimABadge(BadgeId $badgeId): void
    {
        if ($this->earnedBadges->contains($badgeId)) {
            throw new BadgeAlreadyEarnedException($badgeId);
        }

        $this->claimedBadges = $this->claimedBadges->plus($badgeId);
    }

    public function earnABadge(BadgeId $badgeId): void
    {
        if ($this->earnedBadges->contains($badgeId)) {
            throw new BadgeAlreadyAcceptedException($badgeId);
        }

        $this->earnedBadges = $this->earnedBadges->plus($badgeId);
    }

    public function getClaimedBadges(): array
    {
        return $this->claimedBadges->toArray();
    }

    public function getEarnedBadges(): array
    {
        return $this->earnedBadges->toArray();
    }

    public function setMemberScore(MemberScore $score): void
    {
        $this->memberScore = $score;
    }

    public function getMemberScore(): MemberScore
    {
        return $this->memberScore;
    }

    public function id(): MemberId
    {
        return $this->id;
    }
}
