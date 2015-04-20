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

use Indigo\Guardian\Caller;
use Indigo\Guardian\Exception\IdentificationFailed;
use Indigo\Guardian\Identifier;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class RequestAuth
{
    /**
     * @var Identifier
     */
    protected $identifier;

    /**
     * @var Authenticator
     */
    protected $authenticator;

    /**
     * @param Identifier     $identifier
     * @param Authenticatior $authenticator
     */
    public function __construct(Identifier $identifier, Authenticator $authenticator)
    {
        $this->identifier = $identifier;
        $this->authenticator = $authenticator;
    }

    /**
     * Authenticates a subject
     *
     * @param array $subject
     */
    public function authenticate(array $subject)
    {
        $caller = $this->identifier->identify($subject);

        return $this->authenticator->authenticate($subject, $caller);
    }

    /**
     * Authenticates a subject and returns the associated caller
     *
     * @param array $subject
     *
     * @return Caller
     */
    public function authenticateAndReturn(array $subject)
    {
        $caller = $this->identifier->identify($subject);

        if ($this->authenticator->authenticate($subject, $caller)) {
            return $caller;
        }
    }
}
