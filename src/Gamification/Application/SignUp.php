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

namespace Badger\Gamification\Application;

use Badger\SharedSpace\Bus\Command;
use Webmozart\Assert\Assert;

final class SignUp implements Command
{
    /** @var string */
    private $badgerUserName;

    public function __construct(string $badgerUserName)
    {
        try {
            Assert::lengthBetween($badgerUserName, 2, 255);
        } catch (\InvalidArgumentException $exception) {
            throw new InvalidBadgerMemberNameException(strlen($badgerUserName));
        }

        $this->badgerUserName = $badgerUserName;
    }
}
