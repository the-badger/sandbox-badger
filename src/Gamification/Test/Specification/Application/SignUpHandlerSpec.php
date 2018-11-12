<?php

namespace Specification\Badger\Gamification\Application;

use Badger\Gamification\Application\SignUpHandler;
use Badger\SharedSpace\Bus\CommandHandler;
use PhpSpec\ObjectBehavior;

class SignUpHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldBeAnInstanceOf(SignUpHandler::class);
        $this->shouldImplement(CommandHandler::class);
    }
}
