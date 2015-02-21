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

class Password implements Hasher
{
    /**
     * @var integer
     */
    protected $algo;

    /**
     * @var array
     */
    protected $options;

    /**
     * @param integer $algo
     */
    public function __construct($algo = PASSWORD_DEFAULT, array $options = [])
    {
        Assertion::integer($algo);

        $this->algo = $algo;
        $this->options = $options;
    }

    /**
     * {@inheritdoc}
     */
    public function hash($plain)
    {
        return password_hash($plain, $this->algo, $this->options);
    }

    /**
     * {@inheritdoc}
     */
    public function verify($plain, $hashed)
    {
        return password_verify($plain, $hashed);
    }
}
