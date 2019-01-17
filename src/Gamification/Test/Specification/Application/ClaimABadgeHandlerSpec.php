<?php

namespace Specification\Badger\Gamification\Application;

use Badger\Gamification\Application\ClaimABadge;
use Badger\Gamification\Application\ClaimABadgeHandler;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\SharedSpace\Bus\CommandHandler;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class ClaimABadgeHandlerSpec extends ObjectBehavior
{
    public function let(MemberRepository $memberRepository, BadgeRepository $badgeRepository)
    {
        $this->beConstructedWith($memberRepository, $badgeRepository);
    }

    public function it_is_initializable()
    {
        $this->shouldBeAnInstanceOf(ClaimABadgeHandler::class);
        $this->shouldImplement(CommandHandler::class);
    }

    public function it_claims_a_badge($memberRepository, $badgeRepository)
    {
        $memberId = Uuid::uuid5(Uuid::NAMESPACE_DNS, 'michel');
        $badgeId = Uuid::uuid5(Uuid::NAMESPACE_DNS, 'my_name_is_michel');
        $claimABadgeCommand = new ClaimABadge($memberId, $badgeId);

        $this->__invoke($claimABadgeCommand);
    }
}
