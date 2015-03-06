<?php

/*
 * This file is part of the Indigo Guardian package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Guardian\Identifier;

use Indigo\Guardian\Caller\User\Simple as SimpleUser;
use Assert\Assertion;

/**
 * Identifies callers from memory
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class InMemory implements LoginTokenIdentifier
{
    /**
     * @var array
     */
    protected $users;

    /**
     * Username cache for easier search
     *
     * @var array
     */
    protected $userKeys;

    /**
     * @param array $users
     */
    public function __construct(array $users)
    {
        Assertion::allChoicesNotEmpty($users, ['username', 'password']);

        $this->users = $users;
        $this->userKeys = array_column($users, 'username');
    }

    /**
     * {@inheritdoc}
     */
    public function identify(array $subject)
    {
        Assertion::notEmptyKey($subject, 'username');

        // TODO: user not found exception
        Assertion::inArray($subject['username'], $this->userKeys);

        $id = array_search($subject['username'], $this->userKeys);

        return new SimpleUser($id, $this->users[$id]);
    }

    /**
     * {@inheritdoc}
     */
    public function identifyByLoginToken($loginToken)
    {
        if (isset($this->users[$loginToken])) {
            return new SimpleUser($loginToken, $this->users[$loginToken]);
        }
    }
}
