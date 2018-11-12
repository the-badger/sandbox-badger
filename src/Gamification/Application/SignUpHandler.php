<?php
/**
 * Created by IntelliJ IDEA.
 * User: nanou
 * Date: 11/12/18
 * Time: 9:15 PM
 */

namespace Badger\Gamification\Application;

use Badger\SharedSpace\Bus\CommandHandler;

class SignUpHandler implements CommandHandler
{
    public function __construct()
    {
    }

    public function __invoke(SignUp $signUp): void
    {
    }
}
