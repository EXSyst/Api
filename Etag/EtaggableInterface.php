<?php

namespace EXSyst\Component\Rest\Etag;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
interface EtaggableInterface
{
    /**
     * @param int $strategy
     *
     * @return Etag|string
     */
    public function getEtag($strategy);
}
