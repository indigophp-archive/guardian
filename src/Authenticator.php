<?php

/*
 * This file is part of the Indigo Guardian package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Guardian;

use BeatSwitch\Lock\Callers\Caller;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Authenticator
{
    /**
     * Authenticates a subject against a Caller
     *
     * @param array  $subject
     * @param Caller $caller
     *
     * @return boolean
     */
    public function authenticate(array $subject, Caller $caller);
}
