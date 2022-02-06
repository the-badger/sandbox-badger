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

namespace Badger\Gamification\Infrastructure\Storage\Doctrine\Repository\MemberBadges;

use Badger\Gamification\Domain\MemberBadges\MaybeMember\MemberOption;
use Badger\Gamification\Domain\MemberBadges\MemberBadges;
use Badger\Gamification\Domain\MemberBadges\MemberId;
use Badger\Gamification\Domain\MemberBadges\MemberBadgesRepository as MemberRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;

final class MemberBadgesRepository implements MemberRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(MemberBadges $member): void
    {
        $this->entityManager->persist($member);
    }

    public function get(MemberId $memberId): MemberOption
    {
        $member = $this->entityManager->getRepository(MemberBadges::class)->findOneBy(["id" => $memberId->__toString()]);

        if (null === $member) {
            return MemberOption::none();
        }

        return MemberOption::some($member);
    }
}
