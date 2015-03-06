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
use Assert\Assertion;

class Hash implements Hasher
{
    /**
     * @var string
     */
    protected $algo;

    /**
     * @param string $algo
     */
    public function __construct($algo)
    {
        Assertion::choice($algo, hash_algos());

        $this->algo = $algo;
    }

    /**
     * {@inheritdoc}
     */
    public function hash($plain)
    {
        return hash($this->algo, $plain);
    }

    /**
     * {@inheritdoc}
     */
    public function verify($plain, $hashed)
    {
        return hash_equals($this->hash($plain), $hashed);
    }
}
