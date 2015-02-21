<?php

/*
 * This file is part of the Indigo Guardian package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Guardian\Hasher;

use Indigo\Guardian\Hasher;

class Plaintext implements Hasher
{
    /**
     * {@inheritdoc}
     */
    public function hash($plain)
    {
        return $plain;
    }

    /**
     * {@inheritdoc}
     */
    public function verify($plain, $hashed)
    {
        return $plain === $hashed;
    }
}
