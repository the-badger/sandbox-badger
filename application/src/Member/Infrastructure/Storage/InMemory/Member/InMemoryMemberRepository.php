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

namespace Badger\Member\Infrastructure\Storage\InMemory\Member;

use Badger\Member\Domain\Member\MaybeMember\MemberOption;
use Badger\Member\Domain\Member\Member;
use Badger\Member\Domain\Member\MemberId;
use Badger\Member\Domain\Member\MemberName;
use Badger\Member\Domain\Member\MemberRepository;

final class InMemoryMemberRepository implements MemberRepository
{
    /** @var array<Member> */
    private array $members = [];

    public function save(Member $member): void
    {
        $this->members[$member->id()->__toString()] = $member;
    }

    public function get(MemberId $memberId): MemberOption
    {
        return MemberOption::fromValue($this->members[(string) $memberId]);
    }

    public function findByName(MemberName $memberName): MemberOption
    {
        $result = array_filter($this->members, function (Member $member) use ($memberName) {
            return $member->name()->equals($memberName);
        });

        if (0 === count($result)) {
            return MemberOption::none();
        }

        $resultKey = array_key_first($result);

        $member = $this->members[$resultKey];

        return MemberOption::some($member);
    }
}
