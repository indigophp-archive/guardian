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

use Indigo\Guardian\Authenticator;
use Indigo\Guardian\Hasher;

abstract class HasherAware implements Authenticator
{
    /**
     * @var Hasher
     */
    protected $hasher;

    /**
     * @param Hasher $hasher
     */
    public function __construct(Hasher $hasher)
    {
        $this->hasher = $hasher;
    }
}
