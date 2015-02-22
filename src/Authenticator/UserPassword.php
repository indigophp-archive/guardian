<?php

/*
 * This file is part of the Indigo Guardian package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Guardian\Authenticator;

use BeatSwitch\Lock\Callers\Caller;
use Assert\Assertion;

/**
 * Authenticate using a username-password pair
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class UserPassword extends HasherAware
{
    /**
     * {@inheritdoc}
     */
    public function authenticate(array $subject, Caller $caller)
    {
        Assertion::choicesNotEmpty($subject, ['password']);
        Assertion::isInstanceOf(
            $caller,
            'Indigo\Guardian\Caller\User',
            sprintf('The caller was expected to be an instance of "%s"', 'Indigo\Guardian\Caller\User')
        );

        return $this->hasher->verify($subject['password'], $caller->getPassword());
    }
}
