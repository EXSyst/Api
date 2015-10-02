<?php

namespace EXSyst\Component\Rest\Parameter;

use Doctrine\Common\Annotations\Reader;
use EXSyst\Component\Rest\Annotation\AbstractParameter;
use EXSyst\Component\Rest\Exception;

class ParameterReader
{
    /**
     * @var Reader
     */
    private $annotationReader;
    /**
     * @var \ReflectionMethod
     */
    private $reflectionMethod;

    /**
     * @param Reader $annotationReader
     */
    public function __construct(Reader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    /**
     * @param \ReflectionMethod
     *
     * @return $this
     */
    public function setMethod(\ReflectionMethod $reflectionMethod)
    {
        $this->reflectionMethod = $reflectionMethod;

        return $this;
    }

    /**
     * @throws Exception\InvalidArgumentException
     *
     * @return AbstractParameter[]
     */
    public function read()
    {
        if ($this->reflectionMethod === null) {
            throw new Exception\InvalidArgumentException('You must define the method you want to read by calling Parameter::setMethod().');
        }

        return $this->getMethodParameters($this->reflectionMethod);
    }

    /**
     * @param \ReflectionClass $method
     *
     * @return AbstractParameter[]
     */
    private function getMethodParameters(\ReflectionMethod $method)
    {
        $parameters = [];
        foreach ($this->annotationReader->getMethodAnnotations($method) as $annotation) {
            if ($annotation instanceof AbstractParameter) {
                $parameters[] = $annotation;
            }
        }

        return $parameters;
    }
}
