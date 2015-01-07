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

/**
 * Verifies a password
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Verifier
{
    /**
     * Verifies that a plaintext password matches a hashed one
     *
     * @param string $plain
     * @param string $hashed
     *
     * @return boolean
     */
    public function verify($plain, $hashed);
}
