<?php

namespace Specification\Badger\Gamification\Application;

use Badger\Gamification\Application\CreateABadge;
use Innmind\BlackBox\PHPUnit\BlackBox;
use Innmind\BlackBox\Set\Strings;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CreateABadgeSpec extends ObjectBehavior
{
    use BlackBox;

    function it_is_initializable()
    {
        $this->shouldHaveType(CreateABadge::class);
    }

    function it_needs_to_be_instanciated()
    {
        $this->forAll(Strings::any(),Strings::any(), Strings::any())->take(1)->then(
            function (string $badgeId, string $title, string $description) {
                $this->badgeId = $badgeId;
                $this->title = $title;
                $this->description = $description;
            }
        );
    }
}
