<?php

namespace Specification\Badger\Gamification\Application\Write\CreateABadge;

use Badger\Gamification\Application\Write\CreateABadge\CreateABadge;
use Badger\Gamification\Application\Write\CreateABadge\CreateABadgeHandler;
use Badger\Gamification\Domain\Badge\Badge;
use Badger\Gamification\Domain\Badge\BadgeDescription;
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
        $command->title = 'badgeTitle';
        $command->description = 'An awesome badge!';

        $badgeRepository->save(Argument::type(Badge::class))->shouldBeCalled();

        $this->__invoke($command);
    }
}

