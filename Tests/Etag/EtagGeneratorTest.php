<?php

namespace EXSyst\Component\Rest\Tests\Etag;

use EXSyst\Component\Rest\Etag\EtagGenerator;
use EXSyst\Component\Rest\Tests\Fixtures\EtaggableObject;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class EtagGeneratorTest extends \PHPUnit_Framework_TestCase
{
    private $generator;

    public function setUp()
    {
        $this->generator = new EtagGenerator();
    }

    public function testConstants()
    {
        $this->assertEquals('/', EtagGenerator::VALUE_SEPARATOR);
    }

    public function testGenerationWithAScalarValue()
    {
        $this->assertEquals(md5(10), $this->generator->generate(10));
        $this->assertEquals(md5('foo'), $this->generator->generate('foo'));
    }

    public function testGenerationWithAnArray()
    {
        $this->assertEquals(
            md5(
                md5('barfoo').'/'.md5('bar').'//'
            ),
            $this->generator->generate([
                'barfoo' => 'bar',
            ])
        );
    }

    public function testGenerationWithAnEtaggableObject()
    {
        $etag = 'thisetagisastring';
        $object = new EtaggableObject($etag);

        $this->assertEquals(md5($etag), $this->generator->generate($object));
    }

    public function testGenerationWithAnUnsupportedObject()
    {
        $this->assertFalse($this->generator->generate(new \stdClass()));
    }
}
