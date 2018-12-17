<?php

declare(strict_types=1);

/*
 * This file is part of the Badger package
 *
 * (c) Olivier Soulet & Anael Chardan
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Specification\Badger\Gamification\Infrastructure\Storage\InMemory\Badge;

use Badger\Gamification\Domain\Badge\Badge;
use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\MaybeBadge\BadgeOption;
use Badger\Gamification\Infrastructure\Storage\InMemory\Badge\InMemoryBadgeRepository;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class InMemoryBadgeRepositorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(InMemoryBadgeRepository::class);
    }

    public function it_saves_a_badge()
    {
        $this->save(new Badge(new BadgeId(Uuid::uuid5(Uuid::NAMESPACE_DNS, 'badger_id'))))->shouldReturn(null);
    }

    public function it_gets_a_badge()
    {
        $badgeId = new BadgeId(Uuid::uuid5(Uuid::NAMESPACE_DNS, 'badger_id'));
        $badge = new Badge($badgeId);
        $this->save($badge)->shouldReturn(null);
        $this->get($badgeId)->shouldBeABadgeOptionLike(new BadgeOption(\Some($badge)));
    }

    function getMatchers(): array
    {
        return [
            'beABadgeOptionLike' => function (BadgeOption $subject, BadgeOption $value) {
                return $subject->option()->get() === $value->option()->get();
            }
        ];
    }
}
