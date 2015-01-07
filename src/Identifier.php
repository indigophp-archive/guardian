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

/**
 * Identifies a caller
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Identifier
{
    /**
     * Identifies a subject as a caller
     *
     * @param array $subject
     *
     * @return Caller
     */
    public function identify(array $subject);
}
