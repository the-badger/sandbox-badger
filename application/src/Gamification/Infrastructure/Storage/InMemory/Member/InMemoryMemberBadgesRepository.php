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

namespace Badger\Gamification\Infrastructure\Storage\InMemory\Member;

use Badger\Gamification\Domain\MemberBadges\MaybeMember\MemberOption;
use Badger\Gamification\Domain\MemberBadges\MemberBadges;
use Badger\Gamification\Domain\MemberBadges\MemberId;
use Badger\Gamification\Domain\MemberBadges\MemberBadgesRepository;

final class InMemoryMemberBadgesRepository implements MemberBadgesRepository
{
    private array $members = [];

    public function save(MemberBadges $member): void
    {
        $this->members[$member->id()->__toString()] = $member;
    }

    public function get(MemberId $memberId): MemberOption
    {
        return MemberOption::fromValue($this->members[(string) $memberId]);
    }
}
