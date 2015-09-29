<?php

namespace EXSyst\Component\Rest\Tests\Exception;

use EXSyst\Component\Rest\Exception\ExceptionInterface;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
abstract class AbstractExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \EXSyst\Component\Rest\Exception\ExceptionInterface
     */
    protected $exception;

    public function setUp()
    {
        throw new \LogicException('You must define setUp().');
    }

    public function testInterface()
    {
        $this->assertInstanceOf(ExceptionInterface::class, $this->exception);
    }
}
