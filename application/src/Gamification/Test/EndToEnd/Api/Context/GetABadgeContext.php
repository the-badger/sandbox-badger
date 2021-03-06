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

final class GetABadgeContext implements Context
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
     * @Then I should see the badge :badgeTitle
     */
    public function iShouldSeeBadge(string $badgeTitle): void
    {
        $content = ['badgeId' => $badgeTitle];

        $response = $this->apiTestHelper->jsonGet($content, 'get_a_badge', ['badgeId' => $this->store->get($badgeTitle)]);

        $badge = \Safe\json_decode((string) $response->getContent(), true);

        Assert::eq($response->getStatusCode(), Response::HTTP_ACCEPTED);
        Assert::eq($badge['title'], $badgeTitle);
    }
}
