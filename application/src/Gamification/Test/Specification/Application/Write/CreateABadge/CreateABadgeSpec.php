<?php

namespace Specification\Badger\Gamification\Application\Write\CreateABadge;

use Badger\Gamification\Application\Write\CreateABadge\CreateABadge;
use Innmind\BlackBox\PHPUnit\BlackBox;
use Innmind\BlackBox\Set\Strings;
use PhpSpec\ObjectBehavior;

class CreateABadgeSpec extends ObjectBehavior
{
    use BlackBox;

    function it_is_initializable()
    {
        $this->shouldHaveType(CreateABadge::class);
    }

    function it_needs_to_be_instanciated()
    {
        $this->forAll(Strings::any(), Strings::any())->take(1)->then(
            function (string $title, string $description) {
                $this->title = $title;
                $this->description = $description;
            }
        );
    }
}
