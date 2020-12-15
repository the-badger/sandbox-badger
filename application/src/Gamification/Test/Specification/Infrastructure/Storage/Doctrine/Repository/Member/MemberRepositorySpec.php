<?php

namespace Specification\Badger\Gamification\Infrastructure\Storage\Doctrine\Repository\Member;

use Badger\Gamification\Domain\Member\MemberRepository as MemberRepositoryInterface;
use Badger\Gamification\Infrastructure\Storage\Doctrine\Repository\Member\MemberRepository;
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
        $this->shouldHaveType(MemberRepository::class);
    }

    function it_should_implement()
    {
        $this->shouldImplement(MemberRepositoryInterface::class);
    }
}
