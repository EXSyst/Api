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

use EXSyst\Component\Api\Annotation\AbstractParameter;
use EXSyst\Component\Api\Exception;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ParameterValidator
{
    /**
     * @var RequestStack
     */
    private $requestStack;
    /**
     * @var ValidatorInterface
     */
    private $validator;

    public function __construct(RequestStack $requestStack, ValidatorInterface $validator)
    {
        $this->requestStack = $requestStack;
        $this->validator = $validator;
    }

    /**
     * @param AbstractParameter $parameter
     *
     * @throws Exception\RuntimeException if there is no Request in the RequestStack
     *
     * @return ConstraintViolationListInterface
     */
    public function validate(AbstractParameter $parameter)
    {
        $request = $this->requestStack->getCurrentRequest();
        if ($request === null) {
            throw new Exception\RuntimeException('There is no current request.');
        }

        if (!$parameter->exists($request)) {
            $violations = [];
            if (!$parameter->isOptional()) {
                $message = sprintf('Parameter "%s" must be defined.', $parameter->getName());

                $violations[] = new ConstraintViolation(
                    $message,
                    $message,
                    [],
                    null,
                    $parameter->getName(),
                    null
                );
            }

            return new ConstraintViolationList($violations);
        }

        return $this->validator->validate(
            $parameter->getValue($request),
            $parameter->getConstraints()
        );
    }

    /**
     * @param AbstractParameter[] $parameters
     *
     * @return ConstraintViolationList[]
     */
    public function validateParameters(array $parameters)
    {
        $errors = [];
        foreach ($parameters as $parameter) {
            $errors[$parameter->getName()] = $this->validate($parameter);
        }

        return $errors;
    }
}
