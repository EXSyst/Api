<?php

/*
 * This file is part of the Rest package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Rest\Tests\Etag;

use EXSyst\Component\Rest\Etag\EtaggableInterface;
use EXSyst\Component\Rest\Etag\ExtendedEtaggableInterface;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class ExtendedEtaggableInterfaceTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface()
    {
        $etag = $this->getMock(ExtendedEtaggableInterface::class);
        $this->assertInstanceof(EtaggableInterface::class, $etag);
    }
}
