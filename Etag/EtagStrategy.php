<?php

/*
 * This file is part of the Rest package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Rest\Etag;

/**
 * @author Exter-n <exter-n@exter-n.fr>
 */
final class EtagStrategy
{
    const PREFER_STRONG = 0;
    const DONT_CARE = 1;
    const PREFER_WEAK = 2;

    private function __construct()
    {
    }
}
