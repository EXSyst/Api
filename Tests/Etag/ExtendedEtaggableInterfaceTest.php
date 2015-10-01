<?php

namespace EXSyst\Component\Rest\Tests\Etag;

use EXSyst\Component\Rest\Etag\EtaggableInterface;
use EXSyst\Component\Rest\Etag\ExtendedEtaggableInterface;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class ExtendedEtaggableInterfaceTest extends \PHPUnit_Framework_TestCase
{
    public function testInterface() {
        $etag = $this->getMock(ExtendedEtaggableInterface::class);
        $this->assertInstanceof(EtaggableInterface::class, $etag);
    }
}
