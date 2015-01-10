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
use Assert\Assertion;

class Password implements Verifier
{
    /**
     * @var string|null
     */
    protected $algo;

    /**
     * @param string|null $algo
     */
    public function __construct($algo = null)
    {
        Assertion::nullOrChoice($algo, hash_algos());

        $this->algo = $algo;
    }

    /**
     * {@inheritdoc}
     */
    public function verify($plain, $hashed)
    {
        if (is_null($this->algo)) {
            return password_verify($plain, $hashed);
        }

        return hash_equals(hash($this->algo, $plain), $hashed);
    }
}
