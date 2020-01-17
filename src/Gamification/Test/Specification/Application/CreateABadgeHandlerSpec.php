<?php

namespace Specification\Badger\Gamification\Application;

use Badger\Gamification\Application\CreateABadge;
use Badger\Gamification\Application\CreateABadgeHandler;
use Badger\Gamification\Domain\Badge\Badge;
use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\Badge\BadgeTitle;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;

class CreateABadgeHandlerSpec extends ObjectBehavior
{
    public function let(BadgeRepository $badgeRepository)
    {
        $this->beConstructedWith($badgeRepository);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(CreateABadgeHandler::class);
    }

    function it_should_create_a_badge(BadgeRepository $badgeRepository)
    {
        $command = new CreateABadge();
        $command->badgeId = Uuid::uuid4()->toString();
        $command->title = 'badgeTitle';
        $command->description = 'an awesome badge';

        $badge = new Badge(new BadgeId(Uuid::fromString($command->badgeId)), new BadgeTitle($command->title));

        $badgeRepository->save($badge)->shouldBeCalled();

        $this->__invoke($command);
    }
}

