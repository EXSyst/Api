<?php

namespace EXSyst\Component\Rest\Tests\Annotation;

use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
abstract class BaseParameterTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->request = new Request();
        $this->bag = $this->getMock(ParameterBag::class, []);
        $this->request->{ $this->getRequestBag() } = $this->bag;
    }

    public function testExists()
    {
        $class = $this->getParameterClass();
        $param = new $class(['name' => 'foo']);

        $this->bag->expects($this->at(0))
            ->method('has')
            ->with('foo')
            ->willReturn(false);
        $this->bag->expects($this->at(1))
            ->method('has')
            ->with('foo')
            ->willReturn(true);

        $this->assertFalse($param->exists($this->request));
        $this->assertTrue($param->exists($this->request));
    }

    public function testGetValue()
    {
        $class = $this->getParameterClass();
        $param = new $class(['name' => 'foo']);

        $this->bag->expects($this->once())
            ->method('get')
            ->with('foo')
            ->willReturn('fooValue');

        $this->assertEquals('fooValue', $param->getValue($this->request));
    }

    abstract public function getParameterClass();

    abstract public function getRequestBag();
}
