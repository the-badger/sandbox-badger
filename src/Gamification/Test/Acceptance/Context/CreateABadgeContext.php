<?php

/*
 * This file is part of the Badger package
 *
 * (c) Olivier Soulet & Anael Chardan
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Badger\Gamification\Test\Acceptance\Context;

use Badger\Gamification\Application\CreateABadge;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\SharedSpace\Bus\CommandBus;
use Behat\Behat\Context\Context;
use Webmozart\Assert\Assert;

class CreateABadgeContext implements Context
{
    /**
     * @var CommandBus
     */
    private $commandBus;
    /**
     * @var BadgeRepository
     */
    private $badgeRepository;

    public function __construct(
        CommandBus $commandBus,
        BadgeRepository $badgeRepository
    ) {
        $this->commandBus = $commandBus;
        $this->badgeRepository = $badgeRepository;
    }

    /**
     * @Given a badge :badgeTitle :description
     * @When I create a badge :badgeTitle :description
     */
    public function iCreateABadge(string $badgeTitle, string $description)
    {
        $createBadge = new CreateABadge();
        $createBadge->title = $badgeTitle;
        $createBadge->description = $description;

        $this->commandBus->dispatch($createBadge);
    }

    /**
     * @Then I should see :amount badge
     */
    public function iShouldSeeBadge(int $amount)
    {
        Assert::eq($this->badgeRepository->count(), $amount);
    }
}
