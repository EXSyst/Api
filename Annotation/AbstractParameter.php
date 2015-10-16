<?php

/*
 * This file is part of the Api package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Api\Annotation;

use EXSyst\Component\Api\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraint;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
abstract class AbstractParameter
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var Constraint[]
     */
    private $constraints = [];
    /**
     * @var bool
     */
    private $optional = true;

    /**
     * @param array $data
     *
     * @throws Exception\InvalidArgumentException
     */
    public function __construct(array $data)
    {
        if (isset($data['value'])) {
            $data['name'] = $data['value'];
            unset($data['value']);
        }
        if (!isset($data['name']) || !is_scalar($data['name'])) {
            throw new Exception\InvalidArgumentException('Parameter name must be a string.');
        }
        $this->name = $data['name'];

        if (isset($data['constraints'])) {
            $this->setConstraints($data['constraints']);
        }
        if (isset($data['optional'])) {
            $this->optional = !!$data['optional'];
        }
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return Constraint[]
     */
    public function getConstraints()
    {
        return $this->constraints;
    }

    /**
     * @return bool
     */
    public function isOptional()
    {
        return $this->optional;
    }

    /**
     * @return bool
     */
    public function getOptional()
    {
        return $this->optional;
    }

    /**
     * @param Constraint[]
     *
     * @throws Exception\InvalidArgumentException
     *
     * @return $this
     */
    private function setConstraints($constraints)
    {
        if (!is_array($constraints)) {
            throw new Exception\InvalidArgumentException('Parameter constraints must be an array of Symfony\Component\Validator\Constraint.');
        }
        foreach ($constraints as $constraint) {
            if (!($constraint instanceof Constraint)) {
                throw new Exception\InvalidArgumentException('Parameter constraints must be an array of Symfony\Component\Validator\Constraint.');
            }
        }
        $this->constraints = $constraints;

        return $this;
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    abstract public function exists(Request $request);

    /**
     * @param Request $request
     *
     * @return mixed
     */
    abstract public function getValue(Request $request);
}
