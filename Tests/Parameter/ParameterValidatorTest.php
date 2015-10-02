<?php

namespace EXSyst\Component\Rest\Tests\Parameter;

use EXSyst\Component\Rest\Annotation\AbstractParameter;
use EXSyst\Component\Rest\Parameter\ParameterValidator;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraints;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class ParameterValidatorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->request = new Request();
        $this->requestStack = new RequestStack();
        $this->requestStack->push($this->request);
        $this->validator = $this->getMock(ValidatorInterface::class);
        $this->paramValidator = new ParameterValidator($this->requestStack, $this->validator);
    }

    /**
     * @expectedException EXSyst\Component\Rest\Exception\RuntimeException
     * @expectedExceptionMessage no current request
     */
    public function testEmptyRequestStack()
    {
        $this->requestStack->pop();
        $this->paramValidator->validate($this->createParameter(['name' => 'foo']));
    }

    public function testValidation()
    {
        $parameter = $this->createParameter([
            'name' => 'foo',
            'constraints' => $constraints = [
                new Constraints\NotNull(),
                new Constraints\Valid(),
            ],
        ]);
        $parameter->expects($this->once())
            ->method('exists')
            ->with($this->request)
            ->willReturn(true);
        $parameter->expects($this->once())
            ->method('getValue')
            ->with($this->request)
            ->willReturn($value = 'myValue');

        $this->validator->expects($this->once())
            ->method('validate')
            ->with($value, $constraints)
            ->willReturn($errors = ['errors']);

        $this->assertEquals($errors, $this->paramValidator->validate($parameter));
    }

    public function testValidationWithOptionalParameter()
    {
        $parameter = $this->createParameter(['name' => 'foo']);
        $this->assertEquals(new ConstraintViolationList([]), $this->paramValidator->validate($parameter));
    }

    public function testValidationWithRequiredParameter()
    {
        $parameter = $this->createParameter(['name' => 'foo', 'optional' => false]);
        $this->assertEquals(new ConstraintViolationList([
            new ConstraintViolation(
                'Parameter "foo" must be defined.',
                'Parameter "foo" must be defined.',
                [],
                null,
                'foo',
                null
            ),
        ]), $this->paramValidator->validate($parameter));
    }

    private function createParameter(array $options)
    {
        return $this->getMock(
            AbstractParameter::class,
            array('exists', 'getValue'),
            array(
                $options,
            )
        );
    }
}
