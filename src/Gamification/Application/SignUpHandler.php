<?php

namespace Badger\Gamification\Application;

use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\SharedSpace\Bus\CommandHandler;

final class SignUpHandler implements CommandHandler
{
    public function __construct(MemberRepository $memberRepository)
    {
    }

    public function __invoke(SignUp $signUp): void
    {
    }
}
