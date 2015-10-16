<?php

/*
 * This file is part of the Api package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Api\Tests\Fixtures;

use EXSyst\Component\Api\Etag\EtaggableInterface;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class EtaggableObject implements EtaggableInterface
{
    private $etag;

    public function __construct($etag)
    {
        $this->etag = $etag;
    }

    public function getEtag($strategy)
    {
        return $this->etag;
    }
}
