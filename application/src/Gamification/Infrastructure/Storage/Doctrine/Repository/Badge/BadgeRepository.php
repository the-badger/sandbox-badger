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

namespace Badger\Gamification\Infrastructure\Storage\Doctrine\Repository\Badge;

use Badger\Gamification\Domain\Badge\Badge;
use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\BadgeRepository as BadgeRepositoryInterface;
use Badger\Gamification\Domain\Badge\BadgeTitle;
use Badger\Gamification\Domain\Badge\MaybeBadge\BadgeOption;
use Doctrine\ORM\EntityManagerInterface;

final class BadgeRepository implements BadgeRepositoryInterface
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Badge $bade): void
    {
        $this->entityManager->persist($bade);
    }

    public function get(BadgeId $id): BadgeOption
    {
        $badge = $this->entityManager->getRepository(Badge::class)->find($id->__toString());

        if (null === $badge) {
            return BadgeOption::none();
        }

        return BadgeOption::some($badge);
    }

    public function getBadgeByTitle(BadgeTitle $badgeTitle): BadgeOption
    {
        $badge = $this->entityManager->getRepository(Badge::class)->findOneBy(['badgeTitle' => $badgeTitle->__toString()]);

        if (null === $badge) {
            return BadgeOption::none();
        }

        return BadgeOption::some($badge);
    }

    public function count(): int
    {
        return count($this->entityManager->getRepository(Badge::class)->findAll());
    }
}
