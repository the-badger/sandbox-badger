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

namespace Badger\Member\Infrastructure\Storage\Doctrine\Repository\Member;

use Badger\Member\Domain\Member\MaybeMember\MemberOption;
use Badger\Member\Domain\Member\Member;
use Badger\Member\Domain\Member\MemberId;
use Badger\Member\Domain\Member\MemberName;
use Badger\Member\Domain\Member\MemberRepository as MemberRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final class MemberRepository implements MemberRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Member $member): void
    {
        $this->entityManager->persist($member);
    }

    public function get(MemberId $id): MemberOption
    {
        $member = $this->entityManager->getRepository(Member::class)->find($id->__toString());

        if (null === $member) {
            return MemberOption::none();
        }

        return MemberOption::some($member);
    }

    public function findByName(MemberName $memberName): MemberOption
    {
        $member = $this->entityManager->getRepository(Member::class)->findOneBy(['memberName' => $memberName->__toString()]);

        if (null === $member) {
            return MemberOption::none();
        }

        return MemberOption::some($member);
    }
}
