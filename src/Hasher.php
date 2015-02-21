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
 * Hashes and verifies a password
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Hasher
{
    /**
     * Hashes a plaintext password
     *
     * @param string $plain
     *
     * @return string
     */
    public function hash($plain);

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
