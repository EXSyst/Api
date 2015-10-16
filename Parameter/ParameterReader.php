<?php

/*
 * This file is part of the Api package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Api\Parameter;

use Doctrine\Common\Annotations\Reader;
use EXSyst\Component\Api\Annotation\AbstractParameter;

class ParameterReader
{
    /**
     * @var Reader
     */
    private $annotationReader;

    /**
     * @param Reader $annotationReader
     */
    public function __construct(Reader $annotationReader)
    {
        $this->annotationReader = $annotationReader;
    }

    /**
     * @param \ReflectionMethod $reflectionMethod
     *
     * @return AbstractParameter[]
     */
    public function read(\ReflectionMethod $reflectionMethod)
    {
        $parameters = [];
        foreach ($this->annotationReader->getMethodAnnotations($reflectionMethod) as $annotation) {
            if ($annotation instanceof AbstractParameter) {
                $parameters[] = $annotation;
            }
        }

        return $parameters;
    }
}
