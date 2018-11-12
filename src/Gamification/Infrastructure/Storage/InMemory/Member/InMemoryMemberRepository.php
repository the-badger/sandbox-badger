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

use Badger\Gamification\Domain\Member\Member;
use Badger\Gamification\Domain\Member\MemberId;
use Badger\Gamification\Domain\Member\MemberRepository;
use Ramsey\Uuid\Uuid;

final class InMemoryMemberRepository implements MemberRepository
{
    private $members = [];

    public function save(Member $member): void
    {
        $this->members[$member->id()] = $member;
    }

    public function nextIdentity(): MemberId
    {
        return new MemberId(Uuid::uuid4());
    }
}
