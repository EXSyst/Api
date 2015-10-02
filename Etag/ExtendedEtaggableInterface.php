<?php

namespace EXSyst\Component\Rest\Etag;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
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
