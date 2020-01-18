<?php

declare(strict_types=1);

namespace Badger\Gamification\Test\Acceptance\Context;

use Badger\Gamification\Application\SignUp;
use Badger\SharedSpace\Bus\CommandBus;
use Behat\Behat\Context\Context;

final class AuthentificationContext implements Context
{
    /**
     * @var Store
     */
    private $store;
    /**
     * @var CommandBus
     */
    private $commandBus;

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
        $signUpCommand = new SignUp($badgeMember);
        $this->commandBus->dispatch($signUpCommand);
        $this->store->set(Store::BADGER_MEMBER_NAME, $badgeMember);
    }
}
