<?php

namespace EXSyst\Component\Rest\Tests\Parameter;

use Doctrine\Common\Annotations\AnnotationReader;
use EXSyst\Component\Rest\Annotation;
use EXSyst\Component\Rest\Parameter\ParameterReader;
use EXSyst\Component\Rest\Tests\Fixtures\ControllerWithParameters;
use Symfony\Component\Validator\Constraints;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class ParameterReaderTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $annotationReader = new AnnotationReader();
        $this->reader = new ParameterReader($annotationReader);
    }

    /**
     * @expectedException EXSyst\Component\Rest\Exception\InvalidArgumentException
     * @expectedExceptionMessage setMethod()
     */
    public function testReadWithoutMethod()
    {
        $this->reader->read();
    }

    public function testRead()
    {
        $method = new \ReflectionMethod(ControllerWithParameters::class, 'myFunction');

        $this->reader->setMethod($method);
        $this->assertEquals([
            new Annotation\FileParameter(['name'    => 'foo', 'constraints' => [new Constraints\NotNull()], 'optional' => false]),
            new Annotation\QueryParameter(['name'   => 'bar', 'constraints' => [new Constraints\Valid(), new Constraints\NotBlank()]]),
            new Annotation\RequestParameter(['name' => 'bar', 'constraints' => [new Constraints\Date()]]),
        ], $this->reader->read());
    }
}
