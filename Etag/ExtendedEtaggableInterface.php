<?php

namespace EXSyst\Component\Rest\Etag;

interface ExtendedEtaggableInterface extends EtaggableInterface
{
    /**
     * @return bool
     */
    public function supportsStrongEtag();

    /**
     * @return bool
     */
    public function prefersWeakEtag();
}
