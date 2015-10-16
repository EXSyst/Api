<?php

/*
 * This file is part of the Api package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Api\Tests\Parameter;

use Doctrine\Common\Annotations\AnnotationReader;
use EXSyst\Component\Api\Annotation;
use EXSyst\Component\Api\Parameter\ParameterReader;
use EXSyst\Component\Api\Tests\Fixtures\ControllerWithParameters;
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

    public function testRead()
    {
        $method = new \ReflectionMethod(ControllerWithParameters::class, 'myFunction');

        $this->assertEquals([
            new Annotation\FileParameter(['name'    => 'foo', 'constraints' => [new Constraints\NotNull()], 'optional' => false]),
            new Annotation\QueryParameter(['name'   => 'bar', 'constraints' => [new Constraints\Valid(), new Constraints\NotBlank()]]),
            new Annotation\RequestParameter(['name' => 'bar', 'constraints' => [new Constraints\Date()]]),
        ], $this->reader->read($method));
    }
}
