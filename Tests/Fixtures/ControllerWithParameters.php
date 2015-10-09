<?php

/*
 * This file is part of the Rest package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Rest\Tests\Fixtures;

use EXSyst\Component\Rest\Annotation\FileParameter;
use EXSyst\Component\Rest\Annotation\QueryParameter;
use EXSyst\Component\Rest\Annotation\RequestParameter;
use Symfony\Component\Validator\Constraints;

class ControllerWithParameters
{
    /**
     * @FileParameter(name="foo", constraints={@Constraints\NotNull()}, optional=false)
     * @Constraints\NotNull
     * @Constraints\Valid
     * @QueryParameter(name="bar", constraints={@Constraints\Valid(), @Constraints\NotBlank()})
     * @RequestParameter(name="bar", constraints={@Constraints\Date()})
     */
    public function myFunction()
    {
    }
}
