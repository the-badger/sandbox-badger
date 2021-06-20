<?php

namespace Specification\Badger\Gamification\Application\Write\RefuseABadge;

use Badger\Gamification\Application\Write\RefuseABadge\RefuseABadge;
use Badger\Gamification\Application\Write\RefuseABadge\RefuseABadgeHandler;
use Badger\Gamification\Domain\Badge\Badge;
use Badger\Gamification\Domain\Badge\BadgeDescription;
use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\Badge\BadgeTitle;
use Badger\Gamification\Domain\Badge\MaybeBadge\BadgeOption;
use Badger\Gamification\Domain\Member\MaybeMember\MemberOption;
use Badger\Gamification\Domain\Member\Member;
use Badger\Gamification\Domain\Member\MemberId;
use Badger\Gamification\Domain\Member\MemberName;
use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\SharedSpace\Bus\Command\CommandHandler;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class RefuseABadgeHandlerSpec extends ObjectBehavior
{
    public function let(MemberRepository $memberRepository, BadgeRepository $badgeRepository)
    {
        $this->beConstructedWith($memberRepository, $badgeRepository);
    }

    public function it_is_initializable()
    {
        $this->shouldBeAnInstanceOf(RefuseABadgeHandler::class);
        $this->shouldImplement(CommandHandler::class);
    }

    public function it_accepts_a_badge($memberRepository, $badgeRepository)
    {
        $memberId = Uuid::uuid5(Uuid::NAMESPACE_DNS, 'michel');
        $badgeId = Uuid::uuid5(Uuid::NAMESPACE_DNS, 'my_name_is_michel');
        $refuseABadge = new RefuseABadge();
        $refuseABadge->badgeId = (string) $badgeId;
        $refuseABadge->memberId = (string) $memberId;

        $memberId = new MemberId($memberId);
        $badgeId = new BadgeId($badgeId);
        $badgeTitle = BadgeTitle::fromString('Michel Sardou');
        $badgeDescription = BadgeDescription::fromString('You unlocked the very rare Michel Sardou badge!');
        $memberName = MemberName::fromString('michel');

        $badgerMember = new Member($memberId, $memberName);
        $memberOption = MemberOption::some($badgerMember);
        $memberRepository->get($memberId)->willReturn($memberOption);

        $badge = new Badge($badgeId, $badgeTitle, $badgeDescription);
        $badgeOption = BadgeOption::some($badge);
        $badgeRepository->get($badgeId)->willReturn($badgeOption);
        $badgerMember->claimABadge($badgeId);

        $memberRepository->save($badgerMember)->shouldBeCalled();

        $this->__invoke($refuseABadge);
    }
}
