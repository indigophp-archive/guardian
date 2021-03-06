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

use Indigo\Guardian\Identifier;
use Indigo\Guardian\Caller\HasLoginToken;
use Indigo\Guardian\Exception\IdentificationFailed;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface LoginTokenIdentifier extends Identifier
{
    /**
     * {@inheritdoc}
     *
     * @return HasLoginToken
     */
    public function identify(array $subject);

    /**
     * Identifies a logged in Caller
     *
     * @param integer|string $loginToken
     *
     * @return HasLoginToken
     *
     * @throws IdentificationFailed If the caller cannot be found by login token
     */
    public function identifyByLoginToken($loginToken);
}
