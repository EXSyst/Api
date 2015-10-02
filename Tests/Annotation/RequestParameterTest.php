<?php

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
