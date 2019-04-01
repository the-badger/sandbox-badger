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

use Badger\Gamification\Domain\Member\MaybeMember\MemberOption;
use Badger\Gamification\Domain\Member\Member;
use Badger\Gamification\Domain\Member\MemberId;
use Badger\Gamification\Domain\Member\MemberRepository;
use Phunkie\Types\ImmMap;
use Phunkie\Types\ImmSet;
use Ramsey\Uuid\Uuid;

final class InMemoryMemberRepository implements MemberRepository
{
    private $members = [];

    public function save(Member $member): void
    {
        $this->members[$member->id()->__toString()] = $member;
    }

    public function get(MemberId $memberId): MemberOption
    {
        return new MemberOption(\Option($this->members[$memberId->__toString()]));
    }

    public function findByName(string $name): MemberOption
    {
        $result = array_filter($this->members, function (Member $member) use ($name) {
            return ($member->name() === $name);
        });

        return new MemberOption(\Option($result[0] ?? null));
    }

    public function nextIdentity(): MemberId
    {
        return new MemberId(Uuid::uuid4());
    }
}
