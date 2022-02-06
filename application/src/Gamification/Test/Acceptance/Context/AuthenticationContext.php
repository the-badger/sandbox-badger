<?php

declare(strict_types=1);

namespace Badger\Gamification\Test\Acceptance\Context;

use Badger\Gamification\Application\Write\SignUp\SignUp;
use Badger\Gamification\Domain\MemberBadges\MemberName;
use Badger\SharedSpace\Bus\Command\CommandBus;
use Behat\Behat\Context\Context;

final class AuthenticationContext implements Context
{
    private Store $store;
    private CommandBus $commandBus;

    public function __construct(Store $store, CommandBus $commandBus)
    {
        $this->store = $store;
        $this->commandBus = $commandBus;
    }

    /**
     * @Given a badger :role :badgerMember
     */
    public function aBadgeMember(string $role, string $badgeMember): void
    {
        $signUpCommand = new SignUp();
        $signUpCommand->badgerUserName = $badgeMember;
        $this->commandBus->dispatch($signUpCommand);
        $this->store->setBadgerMemberName(MemberName::fromString($badgeMember));
    }
}
