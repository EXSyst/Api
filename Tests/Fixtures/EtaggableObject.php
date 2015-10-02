<?php

namespace EXSyst\Component\Rest\Tests\Fixtures;

use EXSyst\Component\Rest\Etag\EtaggableInterface;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class EtaggableObject implements EtaggableInterface
{
    private $etag;

    public function __construct($etag) {
        $this->etag = $etag;
    }

    public function getEtag($strategy) {
        return $this->etag;
    }
}
