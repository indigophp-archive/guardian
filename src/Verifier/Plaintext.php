<?php

/*
 * This file is part of the Indigo Guardian package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Guardian\Verifier;

use Indigo\Guardian\Verifier;

class Plaintext implements Verifier
{
    /**
     * {@inheritdoc}
     */
    public function verify($plain, $hashed)
    {
        return $plain === $hashed;
    }
}
