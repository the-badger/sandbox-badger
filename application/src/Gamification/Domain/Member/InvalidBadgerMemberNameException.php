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

namespace Badger\Gamification\Domain\Member;

final class InvalidBadgerMemberNameException extends \InvalidArgumentException
{
    public function __construct(int $currentLength)
    {
        parent::__construct(sprintf(
            'The Badger User Name should contain between 2 and 255 characters, currently %s',
            $currentLength
        ));
    }
}
