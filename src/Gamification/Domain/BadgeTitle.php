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

namespace Badger\Gamification\Domain;

use Webmozart\Assert\Assert;

final class BadgeTitle
{
    private $title;

    public function __construct(string $title)
    {
        try {
            Assert::stringNotEmpty($title);
            $this->title = $title;
        } catch (\InvalidArgumentException $e) {
            throw new EmptyBadgeTitleException();
        }
    }
}
