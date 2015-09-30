<?php

namespace EXSyst\Component\Rest\Etag;

interface EtaggableInterface
{
    /**
     * @param int $strategy
     *
     * @return Etag|string
     */
    public function getEtag($strategy);
}
