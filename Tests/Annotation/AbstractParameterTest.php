<?php

/*
 * This file is part of the Api package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Api\Tests\Annotation;

use EXSyst\Component\Api\Annotation\AbstractParameter;
use Symfony\Component\Validator\Constraints;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class AbstractParameterTest extends \PHPUnit_Framework_TestCase
{
    public function testDefaultValues()
    {
        $param = $this->createParameter(['name' => 'foo']);
        $this->assertEquals([], $param->getConstraints());
        $this->assertTrue($param->isOptional());
        $this->assertTrue($param->getOptional());
    }

    public function testNameSetter()
    {
        $param = $this->createParameter(['value' => 'fooName', 'name' => 'bar']);
        $this->assertEquals('fooName', $param->getName());

        $param = $this->createParameter(['name' => 'fooBar']);
        $this->assertEquals('fooBar', $param->getName());
    }

    /**
     * @expectedException EXSyst\Component\Api\Exception\InvalidArgumentException
     * @expectedExceptionMessage must be a string
     */
    public function testCreationWithoutName()
    {
        $this->createParameter([]);
    }

    /**
     * @expectedException EXSyst\Component\Api\Exception\InvalidArgumentException
     * @expectedExceptionMessage must be a string
     */
    public function testInvalidNameSetting()
    {
        $this->createParameter(['name' => new \stdClass()]);
    }

    /**
     * @expectedException EXSyst\Component\Api\Exception\InvalidArgumentException
     * @expectedExceptionMessage Parameter constraints
     */
    public function testNotArrayConstraintsSetting()
    {
        $this->createParameter(['value' => 'foo', 'constraints' => 'bar']);
    }

    /**
     * @expectedException EXSyst\Component\Api\Exception\InvalidArgumentException
     * @expectedExceptionMessage Parameter constraints
     */
    public function testInvalidConstraintsSetting()
    {
        $this->createParameter([
            'value'       => 'foo',
            'constraints' => [new Constraints\NotNull(), new self(), new Constraints\Valid()],
        ]);
    }

    public function testConstraintsSetting()
    {
        $constraints = [new Constraints\NotNull(), new Constraints\Valid()];
        $param = $this->createParameter(['name' => 'foo', 'constraints' => $constraints]);
        $this->assertEquals($constraints, $param->getConstraints());
    }

    public function testOptionalSetting()
    {
        $param = $this->createParameter(['name' => 'foo', 'optional' => 'thisistrue']);
        $this->assertTrue($param->isOptional());
        $this->assertTrue($param->getOptional());

        $param = $this->createParameter(['name' => 'foo', 'optional' => false]);
        $this->assertFalse($param->isOptional());
        $this->assertFalse($param->getOptional());
    }

    private function createParameter(array $options)
    {
        return $this->getMockForAbstractClass(AbstractParameter::class, [$options]);
    }
}
