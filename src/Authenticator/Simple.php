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

use Indigo\Guardian\Verifier;
use Indigo\Guardian\Exception\UserNotFound;
use Assert\Assertion;

class Simple extends VerifierAware
{
    /**
     * @var array
     */
    protected $users;

    /**
     * @param array    $users
     * @param Verifier $verifier
     */
    public function __construct($users, Verifier $verifier)
    {
        $this->users = $users;

        parent::__construct($verifier);
    }

    /**
     * {@inheritdoc}
     */
    public function authenticate(array $subject)
    {
        Assertion::choicesNotEmpty($subject, ['username', 'password']);

        if (!isset($this->users[$subject['username']])) {
            throw new UserNotFound($subject['username']);
        }

        return $this->verifier->verify($subject['password'], $this->users[$subject['username']]);
    }
}
