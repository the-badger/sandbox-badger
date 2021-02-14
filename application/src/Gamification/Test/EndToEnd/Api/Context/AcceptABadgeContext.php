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

use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\SharedSpace\Tool\Behat\ApiTestHelper;
use Badger\SharedSpace\Tool\Behat\Store;
use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Response;
use Webmozart\Assert\Assert;

final class AcceptABadgeContext implements Context
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
     * @When I accept the badge :badgeTitle
     *
     * @throws \Safe\Exceptions\JsonException
     */
    public function iAcceptTheBadge(string $badgeTitle): void
    {
        $content = ['badgeId' => $this->store->get($badgeTitle), 'memberId' => '285bc91b-8416-4159-bf7a-b00144298f72'];

        $response = $this->apiTestHelper->jsonPost($content, 'accept_a_badge');

        Assert::eq($response->getStatusCode(), Response::HTTP_ACCEPTED);
    }

    /**
     * @Then I should see :numberOfEarnedBadge earned badge
     */
    public function iShouldSeeEarnedBadge(int $numberOfEarnedBadge): void
    {
        $content = ['memberId' => '285bc91b-8416-4159-bf7a-b00144298f72'];

        $response = $this->apiTestHelper->jsonGet([], 'list_all_earned_badges_for_a_user', $content);

        Assert::eq($response->getStatusCode(), Response::HTTP_ACCEPTED);
    }
}
