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

namespace Badger\Gamification\Domain\Member;

use Badger\Gamification\Domain\Badge\BadgeId;
use Phunkie\Types\ImmSet;

class Member
{
    public MemberId $id;
    public MemberName $memberName;
    public ImmSet $claimedBadges;

    public function __construct(MemberId $id, MemberName $memberName)
    {
        $this->id = $id;
        $this->memberName = $memberName;
        $this->claimedBadges = new ImmSet();
    }

    public function claimABadge(BadgeId $badgeId): void
    {
        $this->claimedBadges = $this->claimedBadges->plus($badgeId);
    }

    public function getClaimedBadges(): array
    {
        return $this->claimedBadges->toArray();
    }

    public function id(): MemberId
    {
        return $this->id;
    }

    public function name(): MemberName
    {
        return $this->memberName;
    }
}
