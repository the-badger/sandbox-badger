<?php

namespace Specification\Badger\Gamification\Application;

use Badger\Gamification\Application\ClaimABadge;
use Badger\Gamification\Application\ClaimABadgeHandler;
use Badger\Gamification\Domain\Badge\Badge;
use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\Badge\BadgeTitle;
use Badger\Gamification\Domain\Badge\MaybeBadge\BadgeOption;
use Badger\Gamification\Domain\Member\MaybeMember\MemberOption;
use Badger\Gamification\Domain\Member\Member;
use Badger\Gamification\Domain\Member\MemberId;
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

        $memberId = new MemberId($memberId);
        $badgeId = new BadgeId($badgeId);
        $badgeTitle = new BadgeTitle('Michel Sardou');

        $badgerMember = new Member($memberId, 'michel');
        $memberOption = new MemberOption(\Option($badgerMember));
        $memberRepository->get($memberId)->willReturn($memberOption);

        $badge = new Badge($badgeId, $badgeTitle);
        $badgeOption = new BadgeOption(\Option($badge));
        $badgeRepository->get($badgeId)->willReturn($badgeOption);

        $memberRepository->save($badgerMember->claimABadge($badgeId))->shouldBeCalled();

        $this->__invoke($claimABadgeCommand);
    }
}
