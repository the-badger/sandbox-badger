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
use Badger\Gamification\Domain\Badge\BadgeTitle;
use Badger\Gamification\Domain\Badge\MaybeBadge\BadgeOption;
use Badger\Gamification\Infrastructure\Storage\InMemory\Badge\InMemoryBadgeRepository;
use PhpSpec\ObjectBehavior;
use Phunkie\Types\None;
use Ramsey\Uuid\Uuid;

class InMemoryBadgeRepositorySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(InMemoryBadgeRepository::class);
    }

    public function it_saves_a_badge()
    {
        $this->save($this->badge())->shouldReturn(null);
    }

    public function it_gets_a_badge()
    {
        $badge = $this->badge();
        $this->save($badge)->shouldReturn(null);
        $this->get($badge->id())->shouldBeABadgeOptionLike(new BadgeOption(\Some($badge)));
    }

    public function it_gets_a_badge_by_its_title()
    {
        $badge = $this->badge();
        $this->save($badge)->shouldReturn(null);
        $this->getBadgeByTitle($badge->title())->shouldBeABadgeOptionLike(new BadgeOption(\Some($badge)));
    }

    public function it_counts_badges()
    {
        $badge = $this->badge();
        $this->save($badge)->shouldReturn(null);
        $this->count()->shouldReturn(1);
    }

    private function badge(): Badge
    {
        return new Badge(new BadgeId(Uuid::uuid5(Uuid::NAMESPACE_DNS, 'badger_id')), new BadgeTitle('A Badge title'));
    }


    function getMatchers(): array
    {
        return [
            'beABadgeOptionLike' => function (BadgeOption $subject, BadgeOption $value) {
                if ($subject instanceof None) {
                    return $value instanceof None;
                }

                return $subject->option()->get() === $value->option()->get();
            }
        ];
    }
}
