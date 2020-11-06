<?php

namespace Specification\Badger\Gamification\Infrastructure\Storage\Doctrine\Repository\Badge;

use Badger\Gamification\Domain\Badge\BadgeRepository as BadgeRepositoryInterface;
use Badger\Gamification\Infrastructure\Storage\Doctrine\Repository\Badge\BadgeRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpSpec\ObjectBehavior;

class BadgeRepositorySpec extends ObjectBehavior
{
    public function let(EntityManagerInterface $entityManager)
    {
        $this->beConstructedWith($entityManager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BadgeRepository::class);
    }

    function it_should_implement()
    {
        $this->shouldImplement(BadgeRepositoryInterface::class);
    }
}
