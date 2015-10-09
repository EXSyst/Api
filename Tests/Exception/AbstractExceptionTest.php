<?php

/*
 * This file is part of the Rest package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Rest\Tests\Exception;

use EXSyst\Component\Rest\Exception\ExceptionInterface;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
abstract class AbstractExceptionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \EXSyst\Component\IO\Exception\ExceptionInterface
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
