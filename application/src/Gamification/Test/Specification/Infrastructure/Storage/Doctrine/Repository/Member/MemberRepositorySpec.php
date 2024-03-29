<?php

namespace Specification\Badger\Gamification\Infrastructure\Storage\Doctrine\Repository\Member;

use Badger\Gamification\Domain\MemberBadges\MemberBadgesRepository as MemberRepositoryInterface;
use Badger\Gamification\Infrastructure\Storage\Doctrine\Repository\MemberBadges\MemberBadgesRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpSpec\ObjectBehavior;

class MemberRepositorySpec extends ObjectBehavior
{
    public function let(EntityManagerInterface $entityManager)
    {
        $this->beConstructedWith($entityManager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(MemberBadgesRepository::class);
    }

    function it_should_implement()
    {
        $this->shouldImplement(MemberRepositoryInterface::class);
    }
}
