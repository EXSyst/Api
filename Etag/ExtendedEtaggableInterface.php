<?php

/*
 * This file is part of the Api package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Api\Etag;

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
