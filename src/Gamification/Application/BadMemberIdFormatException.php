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

final class BadMemberIdFormatException extends \InvalidArgumentException
{
    public function __construct(string $memberId)
    {
        $this->message = "The member id should be an UUID, {$memberId} given";
    }
}