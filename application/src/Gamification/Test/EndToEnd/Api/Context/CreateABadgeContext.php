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

namespace Badger\Gamification\Test\EndToEnd\Api\Context;

use Badger\Gamification\Domain\Badge\Badge;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\SharedSpace\Tool\Behat\ApiTestHelper;
use Badger\SharedSpace\Tool\Behat\Store;
use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

final class CreateABadgeContext implements Context
{
    private ApiTestHelper $apiTestHelper;
    private BadgeRepository $badgeRepository;
    private Store $store;

    public function __construct(
        ApiTestHelper $apiTestHelper,
        BadgeRepository $badgeRepository,
        Store $store
    ) {
        $this->apiTestHelper = $apiTestHelper;
        $this->badgeRepository = $badgeRepository;
        $this->store = $store;
    }

    /**
     * @Given a badge :badgeTitle :badgeDescription
     * @When I create a badge :badgeTitle :description
     *
     * @throws \Safe\Exceptions\JsonException
     */
    public function iCreateABadge(string $badgeTitle, string $badgeDescription): void
    {
        $content = ['badgeTitle' => $badgeTitle, 'badgeDescription' => $badgeDescription];

        $response = $this->apiTestHelper->jsonPost($content, 'create_badge');

        $identifier = \Safe\json_decode((string) $response->getContent(), true)['badge_identifier'];

        $this->store->set($badgeTitle, $identifier);

        Assert::eq($response->getStatusCode(), Response::HTTP_ACCEPTED);
    }

    /**
     * @Then I should see :amount badge
     */
    public function iShouldSeeBadge(int $amount): void
    {
        Assert::eq($this->badgeRepository->count(), $amount);
    }
}
