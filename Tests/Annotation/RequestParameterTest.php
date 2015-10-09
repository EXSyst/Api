<?php

/*
 * This file is part of the Rest package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Component\Rest\Tests\Annotation;

use EXSyst\Component\Rest\Annotation\RequestParameter;

/**
 * @author Ener-Getick <egetick@gmail.com>
 */
class RequestParameterTest extends BaseParameterTest
{
    public function getParameterClass()
    {
        return RequestParameter::class;
    }

    public function getRequestBag()
    {
        return 'request';
    }
}
