<?php

namespace Specification\Badger\Gamification\Application\Write\ClaimABadge;

use Badger\Gamification\Application\Write\ClaimABadge\ClaimABadge;
use Badger\Gamification\Application\Write\ClaimABadge\ClaimABadgeHandler;
use Badger\Gamification\Domain\Badge\Badge;
use Badger\Gamification\Domain\Badge\BadgeDescription;
use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\BadgeScore;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\Badge\BadgeTitle;
use Badger\Gamification\Domain\Badge\MaybeBadge\BadgeOption;
use Badger\Gamification\Domain\MemberBadges\MaybeMember\MemberOption;
use Badger\Gamification\Domain\MemberBadges\MemberBadges;
use Badger\Gamification\Domain\MemberBadges\MemberId;
use Badger\Gamification\Domain\MemberBadges\MemberName;
use Badger\Gamification\Domain\MemberBadges\MemberBadgesRepository;
use Badger\SharedSpace\Bus\Command\CommandHandler;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class ClaimABadgeHandlerSpec extends ObjectBehavior
{
    public function let(MemberBadgesRepository $memberRepository, BadgeRepository $badgeRepository)
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
        $claimABadgeCommand = new ClaimABadge();
        $claimABadgeCommand->badgeId = (string) $badgeId;
        $claimABadgeCommand->memberId = (string) $memberId;

        $memberId = new MemberId($memberId);
        $badgeId = new BadgeId($badgeId);
        $badgeTitle = BadgeTitle::fromString('Michel Sardou');
        $badgeScore = BadgeScore::fromInt(50);
        $badgeDescription = BadgeDescription::fromString('You unlocked the very rare Michel Sardou badge!');
        $memberName = MemberName::fromString('michel');

        $badgerMember = new MemberBadges($memberId, $memberName);
        $memberOption = MemberOption::some($badgerMember);
        $memberRepository->get($memberId)->willReturn($memberOption);

        $badge = new Badge($badgeId, $badgeTitle, $badgeDescription, $badgeScore);
        $badgeOption = BadgeOption::some($badge);
        $badgeRepository->get($badgeId)->willReturn($badgeOption);

        $memberRepository->save($badgerMember)->shouldBeCalled();

        $this->__invoke($claimABadgeCommand);
    }
}
